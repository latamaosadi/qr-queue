import axios from "axios";

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
      loading: true
    };
  },
  created() {
    this.loadData();
    this.loadCurrentQueue();
  },
  methods: {
    callQueue() {
      this.step = "calling";
      if (this.stats.inline > 0) {
        this.stats.inline--;
      }
    },
    absentQueue() {
      this.stats.absent++;
    },
    completeQueue() {
      this.stats.done++;
    },
    formatNIK(nik) {
      return nik.toString().replace(/\B(?=(\d{4})+(?!\d))/g, " ");
    },
    loadData() {
      axios.get("/api/queue/stats").then(response => {
        this.stats = response.data;
        this.loading = false;
      });
    },
    loadCurrentQueue() {
      axios.get("/api/queue/current").then(response => {
        if (!response.data) {
          return;
        }
        this.step =
          this.customer.queue_status === "handled" ? "handling" : "calling";
        this.customer = response.data;
      });
    },
    processQueue() {
      this.loading = true;
      axios
        .post("/api/queue/process")
        .then(response => {
          this.customer = response.data.customer;
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
        })
        .then(() => {
          this.loading = false;
        });
    },
    skipQueue(processNew) {
      this.loading = true;
      axios
        .post(`/api/queue/skip/${this.customer.id}`)
        .then(response => {
          this.absentQueue();
          if (!processNew) {
            this.step = "idle";
            return;
          }
          this.callQueue();
        })
        .then(() => {
          this.loading = false;
        });
    },
    finishQueue(processNew) {
      this.loading = true;
      axios
        .post(`/api/queue/finish/${this.customer.id}`)
        .then(response => {
          this.completeQueue();
          if (!processNew) {
            this.step = "idle";
            return;
          }
          this.callQueue();
        })
        .then(() => {
          this.loading = false;
        });
    }
  }
};
