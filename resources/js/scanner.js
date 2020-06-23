let scanner = new Instascan.Scanner({
  video: document.getElementById("preview"),
  mirror: false
});

scanner.addListener("scan", function(content) {});

Instascan.Camera.getCameras()
  .then(function(cameras) {
    let selectedCam = null;
    cameras.forEach(camera => {
      if (camera.name.indexOf("back") != -1) {
        selectedCam = camera;
        return false;
      }
    });
    if (selectedCam) {
      scanner.start(selectedCam);
    }
  })
  .catch(function(e) {
    console.error(e);
  });
