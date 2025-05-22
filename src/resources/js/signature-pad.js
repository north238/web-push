import SignaturePad from "signature_pad";

const canvas = document.getElementById("signature-pad");
const writePadBtn = document.getElementById("write-pad-btn");

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

document.addEventListener("open-modal", (e) => {
    if (e.detail === "signature-pad-modal") {
        setTimeout(() => {
            resizeCanvas();
            if (!window.signaturePad) {
                window.signaturePad = new SignaturePad(canvas, {
                    backgroundColor: "#efefef",
                    penColor: "black"
                });
            }
        }, 200); // モーダル描画待ち
    }
});

document.getElementById("save-svg").addEventListener("click", () => {
    if (signaturePad.isEmpty()) {
        return alert("記入してください");
    }

    const svgData  = signaturePad.toDataURL("image/svg+xml");

    fetch("/message/image", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: JSON.stringify({ image: svgData })
    })
    .then((response) => {
        const res = response.json();
        if (response.status !== 200) {
            return alert("エラー：" + res.message);
        }
        return res;
    })
    .then(data => {
        console.log("Saved:", data);
        location.reload();
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
