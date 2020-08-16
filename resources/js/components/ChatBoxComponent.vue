<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <textarea v-model="body" @keydown="handleInput" name id cols="60" rows="2"></textarea>
      </div>
    </div>
  </div>
</template>
<script>
import moment from "moment";
import BusEvent from "../bus";
export default {
  data() {
    return {
      body: "",
      user: axios.get("/dashboard").then((response) => {
        this.user = response.data.name;
      }),
    };
  },
  props: {
    userName: String,
  },
  methods: {
    handleInput(e) {
      if (e.keyCode == 13 && !e.shiftKey) {
        e.preventDefault();
        this.submit();
      }
    },
    submit() {
      let input = this.body.trim();

      if (input === "") {
        return;
      }

      let newChat = {
        subject: input,
        created_at: moment().hours() + ":" + moment().minute(),
        user: {
          name: this.user,
        },
      };
      axios.post("/chat/store", { subject: input }).then((response) => {
        BusEvent.$emit("chat.sent", newChat);

        this.body = "";
      });
    },
  },
  mounted() {},
};
</script>
