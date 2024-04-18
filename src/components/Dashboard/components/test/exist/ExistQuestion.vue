<template>
  <!-- <div  class="col-8 me-5 rounded-4 mt-4 justify-content-center border border-success p-3"> -->
  <question
    class="m-2"
    v-for="(item, key) in questions"
    :key="key"
    :title="item['text']"
  />
</template>

<script>
import jsCookie from "js-cookie";
import questionVue from "../../main/question.vue";
import { sendRequest } from "@/script/private/API-Request";
export default {
  name: "ExistQuestion",
  components: {
    question: questionVue,
  },
  created() {
    this.showQuestionInQuiz();
  },
  methods: {
    async showQuestionInQuiz() {
      // showQuestionInQuiz
      const apiUrl = "http://localhost/api/api.php";
      const data = {
        type: "showQuestionInQuiz",
        sid: jsCookie.get("userToken"),
        quiz_id: this.$route.params.id,
      };
      let response = await sendRequest(apiUrl, data);
      response = await response.text();
      response = JSON.parse(response);
      this.questions = response["data"];
      console.log(response);
    },
  },
  watch: {
    eventTouched() {
      this.showQuestionInQuiz();
    },
  },
  data() {
    return {
      questions: Array,
    };
  },
  props: {
    eventTouched: Number,
  },
};
</script>

<style></style>
