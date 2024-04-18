<template>
  <div
    class="col-10 me-5 mt-4 justify-content-center border border-success p-3"
    v-if="show"
  
  >

  <div
    style="height: 70vh;overflow-y: auto;overflow-x: hidden;"
  >
    <div class="row mt-5 justify-content-center align-items-center">
      <ExistQuestions
        style="margin-top: 2%;width: 92%;"
        v-for="item in questionDatas"
        :key="item['id']"
        :id="item['id']"
        :selectedQuestions="selectedQuestions"
        :item="item"
        :title="item['text']"
        :score="item['score']"
      />
    </div>
  </div>
      <GreenButton
        class="col-lg-3 mt-4"
        style="font-size: calc(15px + 0.2vw) !important; line-height: 200%"
        @click="
        $emit('submitted');
        $emit('submit-question')
        "
        >اتمام
      </GreenButton>
</div>
</template>

<script>
import GreenButtonVue from "@/components/public/Buttons/GreenButton.vue";
// import { sendRequest } from "@/script/private/API-Request";
// import jsCookie from "js-cookie";
import existQuestionsVue from "../test/existQuestions.vue";
import jsCookie from "js-cookie";
import { sendRequest } from "@/script/private/API-Request";
export default {
  name: "AddQuestion",
  components: {
    GreenButton: GreenButtonVue,
    ExistQuestions: existQuestionsVue,
  },
  created() {
    this.getExistQuestionsInThisQuiz();
    this.getExistQuestions();
  },
  watch: {
    show(newval) {
      if (newval == true) {
        this.getExistQuestionsInThisQuiz();
        this.getExistQuestions();
      }
    },
  },
  methods: {
    async getExistQuestions() {
      const apiUrl = "http://localhost/api/api.php";
      const data = await {
        type: "questionListByFasl",
        sid: jsCookie.get("userToken"),
        fasl_id: await JSON.parse(jsCookie.get("tempNewQuiz"))["fasl"],
      };
      let response = await sendRequest(apiUrl, data);
      let responseBody = await response.text();
      let jsonData = await JSON.parse(responseBody);
      this.questionDatas = jsonData["question_list"];
    },
    async getExistQuestionsInThisQuiz() {
      const apiUrl = "http://localhost/api/api.php";
      const data = await {
        type: "questionIdsByQuiz",
        sid: jsCookie.get("userToken"),
        quiz_id: this.$route.params.id,
      };
      let response = await sendRequest(apiUrl, data);
      let responseBody = await response.text();
      let jsonData = await JSON.parse(responseBody);
      console.log('getExistQuestionsInThisQuiz');
      console.log(jsonData["question_ids"]);
      this.selectedQuestions = jsonData["question_ids"];
    },
  },
  data() {
    return {
      selectedQuestions: null,
      questionDatas: Array,
      existQuestionsInThisQuiz: Array,
    };
  },
  props: {
    show: Boolean,
  },
};
</script>

<style scoped>
label {
  width: max-content;
}
</style>
