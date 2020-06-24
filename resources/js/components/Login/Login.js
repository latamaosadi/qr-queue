export default {
  data() {
    return {
      // variable array yang akan menampung hasil fetch dari api
      customers: []
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      axios.get("/api/customers").then(response => {
        // mengirim data hasil fetch ke varibale array customers
        this.customers = response.data;
      });
    }
  }
};
