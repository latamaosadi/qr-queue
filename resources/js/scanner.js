let scanner = new Instascan.Scanner({
  video: document.getElementById("preview"),
  mirror: false
});
let defaultCamera;

scanner.addListener("scan", function(content) {
  console.log("content :>> ", content);
  scanner.stop();
  window.axios
    .post("/api/scan", {
      url: content
    })
    .then(result => {
      // console.log("result :>> ", result);
      const queue = result.data.queue;
      document.getElementById("queue-container").innerHTML = queue;
    })
    .catch(err => {
      // console.log("err :>> ", err);
    })
    .then(() => {
      scanner.start(defaultCamera);
    });
});

Instascan.Camera.getCameras()
  .then(function(cameras) {
    // let selectedCam = null;
    // cameras.forEach(camera => {
    //   if (camera.name.indexOf("back") != -1) {
    //     selectedCam = camera;
    //     return false;
    //   }
    // });
    // if (selectedCam) {
    //   scanner.start(selectedCam);
    // }
    defaultCamera = cameras[0];
    scanner.start(defaultCamera);
  })
  .catch(function(e) {
    console.error(e);
  });
