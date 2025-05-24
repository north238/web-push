import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

document.addEventListener("DOMContentLoaded", () => {
    window.Echo.channel("chat").listen(".message.sent", (e) => {
        const data = e.message;

        if (data) {
            location.reload();
        }
    });
});
