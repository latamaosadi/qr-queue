import axios from "axios";
import moment from "moment";

export default {
  data() {
    return {
      stats: {
        inline: 0,
        done: 0,
        absent: 0
      },
      step: "idle", // idle, calling, handling
      customer: null,
      loading: true,
      interviewStartAt: null,
      interviewInterval: null,
      interviewDuration: null,
      pollTimeout: null
    };
  },
  props: {
    counter: Number
  },
  created() {
    this.loadData();
    this.loadCurrentQueue();
  },
  computed: {
    formatedInterviewDuration() {
      if (!this.interviewDuration) {
        return "00:00:00";
      }
      return `${this.interviewDuration
        .get("hours")
        .toString()
        .padStart(2, "0")}:${this.interviewDuration
        .get("minutes")
        .toString()
        .padStart(2, "0")}:${this.interviewDuration
        .get("seconds")
        .toString()
        .padStart(2, "0")}`;
    }
  },
  methods: {
    startTimer() {
      if (!this.interviewStartAt) {
        return;
      }
      this.interviewInterval = setInterval(() => {
        this.interviewDuration = moment.duration(
          moment().diff(this.interviewStartAt)
        );
      }, 1000);
    },
    clearTimer() {
      if (this.interviewInterval) {
        clearInterval(this.interviewInterval);
      }
      this.interviewDuration = null;
      this.interviewStartAt = null;
    },
    callQueue() {
      this.step = "calling";
      if (this.stats.inline > 0) {
        this.stats.inline--;
      }
    },
    absentQueue() {
      this.stats.absent++;
      this.customer = null;
    },
    completeQueue() {
      this.stats.done++;
      this.customer = null;
    },
    formatNIK(nik) {
      return nik.toString().replace(/\B(?=(\d{4})+(?!\d))/g, " ");
    },
    loadData() {
      this.loading = true;
      axios.get("/api/queue/stats").then(response => {
        this.stats = response.data;
        this.loading = false;
        if (this.pollTimeout) {
          clearTimeout(this.pollTimeout);
        }
        this.pollTimeout = setTimeout(() => {
          this.loadData();
        }, 5000);
      });
    },
    loadCurrentQueue() {
      axios.get(`/api/queue/current/${this.counter}`).then(response => {
        if (!response.data) {
          return;
        }
        this.customer = response.data;
        if (this.customer.interview_start_at) {
          this.interviewStartAt = moment(this.customer.interview_start_at);
          this.startTimer();
        }
        this.step =
          this.customer.queue_status === "handled" ? "handling" : "calling";
      });
    },
    processQueue() {
      this.loading = true;
      axios
        .post(`/api/queue/process/${this.counter}`)
        .then(response => {
          this.customer = response.data;
          this.callQueue();
        })
        .then(() => {
          this.loading = false;
        });
    },
    confirmQueue() {
      this.loading = true;
      axios
        .post(`/api/queue/confirm/${this.customer.id}`)
        .then(response => {
          this.step = "handling";
          this.interviewStartAt = moment(response.data.interview_start_at);
          this.startTimer();
        })
        .then(() => {
          this.loading = false;
        });
    },
    skipQueue(processNew) {
      this.loading = true;
      const data = {};
      if (processNew) data.process_new = true;
      axios
        .post(`/api/queue/skip/${this.customer.id}`, data)
        .then(response => {
          this.absentQueue();
          if (!processNew) {
            this.step = "idle";
            return;
          }
          this.customer = response.data;
          this.callQueue();
        })
        .then(() => {
          this.loading = false;
        });
    },
    finishQueue(processNew) {
      this.loading = true;
      const data = {};
      if (processNew) data.process_new = true;
      this.clearTimer();
      axios
        .post(`/api/queue/finish/${this.customer.id}`, data)
        .then(response => {
          this.completeQueue();
          if (!processNew) {
            this.step = "idle";
            return;
          }
          this.customer = response.data;
          this.callQueue();
        })
        .then(() => {
          this.loading = false;
        });
    },
    refreshQueue() {
      this.loadData();
    }
  },
  beforeDestroy() {
    clearTimeout(this.pollTimeout);
  }
};
