document.addEventListener("DOMContentLoaded", () => {
    const receiveUserText = document.getElementById("receive-user-text");
    const messageText = document.getElementById("message-text");
    const messageSendBtn = document.getElementById("message-send-btn");

    // 初期状態ではボタンを無効化しておく
    messageSendBtn.disabled = true;

    // 入力欄の内容をチェックする関数
    const checkInputs = () => {
        // 両方の入力欄に値があるかチェック
        if (
            receiveUserText.value.trim() !== "" &&
            messageText.value.trim() !== ""
        ) {
            // 両方に入力があればボタンを有効化
            messageSendBtn.disabled = false;
        } else {
            // どちらか一方でも空ならボタンを無効化
            messageSendBtn.disabled = true;
        }
    };

    // 両方の入力欄のイベントリスナーを設定
    receiveUserText.addEventListener("input", checkInputs);
    messageText.addEventListener("input", checkInputs);

    // 初期状態の確認
    checkInputs();
});
