import SignaturePad from "signature_pad";

const canvas = document.getElementById("signature-pad");
const writePadBtn = document.getElementById("write-pad-btn");
const signatureSection = document.getElementById("signature-section");

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

writePadBtn.addEventListener("click", (e) => {
    e.preventDefault();
    signatureSection.classList.remove("hidden");
    setTimeout(() => {
        if (!window.signaturePad) {
            window.signaturePad = new SignaturePad(canvas, {
                backgroundColor: "#efefef",
                penColor: "black",
            });
        }

        resizeCanvas();
    }, 200); // モーダル描画待ち
});

// モーダルを開く
document.getElementById("close-signature").addEventListener("click", () => {
    document.getElementById("signature-section").classList.add("hidden");
});

// 保存処理
let isSubmitting = false;
document.getElementById("save-svg").addEventListener("click", (e) => {
    if (isSubmitting) return; // 二重クリック防止

    if (signaturePad.isEmpty()) {
        return alert("記入してください");
    }

    isSubmitting = true;
    e.target.disabled = true;

    const svgData = signaturePad.toDataURL("image/svg+xml");

    fetch("/message/image", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({ image: svgData }),
    })
        .then((response) => {
            const res = response.json();
            if (response.status !== 200) {
                return alert("エラー：" + res.message);
            }
            return res;
        })
        .then((data) => {

            isSubmitting = false;
            e.target.disabled = false;
            document.getElementById("signature-section").classList.add("hidden");
        });
});

document.getElementById("clear").addEventListener("click", () => {
    signaturePad.clear();
});

document.getElementById("undo").addEventListener("click", () => {
    const data = signaturePad.toData();
    if (data) {
        data.pop(); // remove the last dot or line
        signaturePad.fromData(data);
    }
});
