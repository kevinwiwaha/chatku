<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="chatbox">
                    <div v-for="chat in chats" class="chat-item">
                        <h5>
                            <b class="nama">{{ chat.user.name }}</b>
                        </h5>

                        <small class="text-info">{{ chat.created_at }}</small>

                        <p>{{ chat.subject }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="scss">
.chatbox {
    max-height: 450px;
    overflow-y: scroll;
}
.nama {
    text-transform: capitalize;
}
</style>
<script>
import moment from "moment";
import BusEvent from "../bus";
export default {
    data() {
        return {
            chats: []
        };
    },
    mounted() {
        this.getAllChat();
        BusEvent.$on("chat.sent", newChat => {
            this.chats.push(newChat);
            this.scrollToBottom();
        });
    },
    methods: {
        getAllChat() {
            axios.get("/chat/all").then(response => {
                this.chats = response.data.reverse();
                this.scrollToBottom();
            });
        },
        scrollToBottom() {
            setTimeout(function() {
                let chatbox = document.getElementsByClassName("chatbox")[0];
                chatbox.scrollTop = chatbox.scrollHeight;
            }, 1);
        }
    }
};
</script>
