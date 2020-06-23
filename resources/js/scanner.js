import moment from "moment";
let scanner = new Instascan.Scanner({
  video: document.getElementById("preview"),
  mirror: false
});
let defaultCamera;
let loading = false;

const scannedSound = new Audio("sounds/scanned.mp3");
const loadingSound = new Audio("sounds/loading.mp3");

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

scanner.addListener("scan", function(content) {
  scanner.stop();
  loading = true;
  loadingSound.play();
  window.axios
    .post("/api/scan", {
      url: content
    })
    .then(result => {
      scannedSound.play();
      const queue = result.data.queue;
      document.getElementById("queue-container").innerHTML = queue;
      // document.getElementById("name-container").innerHTML = name;
    })
    .catch(err => {
      // console.log("err :>> ", err);
    })
    .then(() => {
      loading = false;
      scanner.start(defaultCamera);
    });
});

Instascan.Camera.getCameras()
  .then(function(cameras) {
    defaultCamera = cameras[0];
    scanner.start(defaultCamera);
  })
  .catch(function(e) {
    console.error(e);
  });
