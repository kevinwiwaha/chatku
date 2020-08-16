import BusEvent from "../js/bus";

window.Echo.join("chat-channel").listen("ChatStoredEvent", e => {
    BusEvent.$emit("chat.sent", e.data);
});
