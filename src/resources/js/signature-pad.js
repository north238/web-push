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
    backgroundColor: "#efefef", // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
    penColor: "black"
});

document.getElementById("save-svg").addEventListener("click", () => {
    if (signaturePad.isEmpty()) {
        return alert("記入してください");
    }

    const svgData  = signaturePad.toDataURL("image/svg+xml");

    fetch("/api/messages/image", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: JSON.stringify({ image: svgData })
    })
    .then(response => response.json())
    .then(data => {
        console.log("Saved:", data);
    });
});

document.getElementById("clear").addEventListener("click", () => {
    signaturePad.clear();
});

document.getElementById("draw").addEventListener("click", () => {
    signaturePad.compositeOperation = "source-over"; // default value
});

document.getElementById("erase").addEventListener("click", () => {
    signaturePad.compositeOperation = "destination-out";
});

document.getElementById("undo").addEventListener("click", () => {
    const data = signaturePad.toData();
    if (data) {
        data.pop(); // remove the last dot or line
        signaturePad.fromData(data);
    }
});
