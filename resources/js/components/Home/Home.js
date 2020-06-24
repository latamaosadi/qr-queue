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
      });
    },
    loadCurrentQueue() {
      axios.get("/api/queue/current").then(response => {
        if (!response.data) {
          return;
        }
        this.customer = response.data;
        this.step =
          this.customer.queue_status === "handled" ? "handling" : "calling";
      });
    },
    processQueue() {
      this.loading = true;
      axios
        .post("/api/queue/process")
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
  }
};
