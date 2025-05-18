import SignaturePad from "signature_pad";

const canvas = document.getElementById("signature-pad");

// Adjust canvas coordinate space taking into account pixel ratio,
// to make it look crisp on mobile devices.
// This also causes canvas to be cleared.
function resizeCanvas() {
    // When zoomed out to less than 100%, for some very strange reason,
    // some browsers report devicePixelRatio as less than 1
    // and only part of the canvas is cleared then.
    const ratio = Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();

const signaturePad = new SignaturePad(canvas, {
    backgroundColor: "rgb(255, 255, 255)", // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
    penColor: "white"
});

document.getElementById("save-png").addEventListener("click", function () {
    if (signaturePad.isEmpty()) {
        return alert("Please provide a signature first.");
    }

    const data = signaturePad.toDataURL("image/png");
    console.log(data);
    window.open(data);
});

document.getElementById("save-jpeg").addEventListener("click", function () {
    if (signaturePad.isEmpty()) {
        return alert("Please provide a signature first.");
    }

    const data = signaturePad.toDataURL("image/jpeg");
    console.log(data);
    window.open(data);
});

document.getElementById("save-svg").addEventListener("click", function () {
    if (signaturePad.isEmpty()) {
        return alert("Please provide a signature first.");
    }

    const data = signaturePad.toDataURL("image/svg+xml");
    console.log(data);
    console.log(atob(data.split(",")[1]));
    window.open(data);
});

document.getElementById("clear").addEventListener("click", function () {
    signaturePad.clear();
});

document.getElementById("draw").addEventListener("click", function () {
    signaturePad.compositeOperation = "source-over"; // default value
    console.log(signaturePad);
});

document.getElementById("erase").addEventListener("click", function () {
    signaturePad.compositeOperation = "destination-out";
});

document.getElementById("undo").addEventListener("click", function () {
    const data = signaturePad.toData();
    if (data) {
        data.pop(); // remove the last dot or line
        signaturePad.fromData(data);
    }
});
