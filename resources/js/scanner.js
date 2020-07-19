import moment from "moment";

const scannedSound = new Audio("sounds/scanned.mp3");
const loadingSound = new Audio("sounds/loading.mp3");
let loading = false;
let scanned = null;

const notyf = new Notyf({
  duration: 3000,
  position: {
    x: "center",
    y: "bottom"
  },
  types: [
    {
      type: "error",
      className: "text-white text-xl mb-12",
      icon: false
    },
    {
      type: "info",
      className:
        "bg-blue-100 text-blue-400 border border-blue-400 mb-12 text-xl",
      icon: false
    }
  ]
});

function renderClock() {
  document.getElementById("clock").innerHTML = moment().format(
    "D MMMM YYYY, HH:mm:ss"
  );
}

setInterval(renderClock, 1000);

loadingSound.addEventListener(
  "ended",
  function() {
    if (loading) {
      this.currentTime = 0;
      this.play();
    }
  },
  false
);

// Enable scan events for the entire document
onScan.attachTo(document);

const barcodeInput = document.getElementById("scanner-focus");
barcodeInput.focus();

barcodeInput.addEventListener("keydown", e => {
  if ((e.which || e.keyCode) == 9) {
    e.preventDefault();
  }
});

setInterval(() => {
  barcodeInput.focus();
}, 50);

document.addEventListener("scan", function(sScancode, iQuantity) {
  const content = sScancode.detail.scanCode;
  barcodeInput.value = "";
  notyf.dismissAll();
  if (loading) {
    notyf.open({
      type: "info",
      message: "Kartu Anda sedang diproses...."
    });
    return;
  }
  if (scanned === content) {
    // Display an error notification
    notyf.error(
      "Anda sudah mendapatkan nomor antrian, silahkan menuju tempat mengantri untuk menunggu panggilan."
    );
    return;
  }
  scanned = content;
  loading = true;
  loadingSound.play();
  document.getElementById("scanner-info").classList.add("spinner");
  window.axios
    .post("/api/scan", {
      url: content
    })
    .then(result => {
      scannedSound.play();
      notyf.dismissAll();
      const queue = result.data.readable_queue;
      document.getElementById("queue-container").innerHTML = queue;
      document.getElementById("scanner-info").innerHTML = result.data.template;
      setTimeout(() => {
        scanned = null;
      }, 10000);
      setTimeout(() => {
        document.getElementById("scanner-info").innerHTML = "";
      }, 5000);
    })
    .catch(err => {
      notyf.error(err.response.data.error);
      scanned = null;
    })
    .then(() => {
      loading = false;
      document.getElementById("scanner-info").classList.remove("spinner");
    });
});
