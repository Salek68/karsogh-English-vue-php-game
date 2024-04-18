<template>
  <div
    class="col-8 me-5 mt-4 justify-content-center border border-success p-3"
    v-if="show"
  >
    <div v-if="!addQuestion" class="row mt-5 justify-content-center align-items-center">
      <div class="mt-3 row justify-content-center align-items-center">
        <label for="" class="lbl">متن سوال :</label>
        <textarea v-model="thisQuestion" rows="" cols=""></textarea>
      </div>
      <div class="mt-3 row justify-content-center align-items-center">
        <label class="lbl">نمره سوال :</label>
        <!-- <textarea v-model="thisQuestion" rows="" cols=""></textarea> -->
        <input type="number" v-model="score" id="" />
      </div>
      <!-- <div class="row align-items-center justify-content-center mt-4">
        <div class="col-lg-3 row">
          <label for="topic" class="form-label">کتاب</label>
          <select class="form-select" name="topic" id="">
            <option selected>Select one</option>
            <option value="">علوم</option>
            <option value="">فارسی</option>
            <option value="">ریاضی</option>
          </select>
        </div>
        <div class="col-lg-3 row">
          <label for="lesson" class="form-label">درس</label>
          <select class="form-select" name="lesson" id="">
            <option selected>Select one</option>
            <option value="">1</option>
            <option value="">2</option>
            <option value="">3</option>
          </select>
        </div>
        <div class="col-lg-4 row">
          <label for="topic" class="form-label">میزان سختی</label>
          <select class="form-select" name="topic" id="">
            <option selected>Select one</option>
            <option value="">ساده</option>
            <option value="">متوسط</option>
            <option value="">سخت</option>
          </select>
        </div>
      </div> -->
      <GreenButton
        class="col-lg-3 mt-4"
        style="font-size: calc(15px + 0.2vw) !important; line-height: 200%"
        @click="
          async () => {
            await submitQuestion();
            addQuestion = !addQuestion;
          }
        "
        >افزودن سوال
      </GreenButton>
    </div>
    <div
      v-if="addQuestion"
      class="row justify-content-center align-items-center"
      id="answers"
    >
      <question :level="'سخت'" :text="thisQuestion" :type="'تستی'"></question>
      <div class="row justify-content-center align-items-center m-4">
        <label for="" class="lbl">متن پاسخ :</label>
        <input class="name col-lg-6" name="name" type="text" v-model="answer" />
      </div>
      <div v-for="(item, index) in answers" :key="index">
        <label :for="`answer-${index}`">{{ item }}</label>
        <input
          type="radio"
          :id="`answer-${index}`"
          :name="item"
          :value="item"
          v-model="rightAns"
        />
      </div>
      <GreenButton
        class="m-1"
        style="font-size: calc(15px + 0.2vw) !important; line-height: 200%"
        @click="AddAnswer"
        >افزودن پاسخ</GreenButton
      >
      <GreenButton
        style="font-size: calc(15px + 0.2vw) !important; line-height: 200%"
        @click="
          $emit('submitQuestion');
          submitAnswer(lastIdQuestion);
          addQuestion = false;
          answer = '';
          answers = [];
          rightAns = false;
          thisQuestion = '';
          score = 0;
        "
        >ثبت سوال</GreenButton
      >
    </div>
    <!-- <button @click="submitAnswer(5)">
      test Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, itaque.
      Asperiores, ipsam amet saepe molestias eaque id quis est at qui laborum quos ut
      veniam quo. Error eaque quo consequuntur.
    </button> -->
  </div>
</template>

<script>
import GreenButtonVue from "@/components/public/Buttons/GreenButton.vue";
import questionVue from "../main/question.vue";
import { sendRequest } from "@/script/private/API-Request";
import jsCookie from "js-cookie";
export default {
  name: "AddQuestion",
  components: {
    GreenButton: GreenButtonVue,
    question: questionVue,
  },
  methods: {
    AddAnswer() {
      this.answers.push(this.answer);
      this.answer = "";
      console.log(this.answers);
      console.log(this.rightAns);
    },
    async submitQuestion() {
      const apiUrl = "http://localhost/api/api.php";
      const data = {
        type: "addQuestion",
        sid: jsCookie.get("userToken"),
        text: this.thisQuestion,
        score: this.score,
        level: JSON.parse(jsCookie.get("tempNewQuiz"))["level"],
        quiz_id: this.$route.params.id,
      };
      let response = await sendRequest(apiUrl, data);
      response = await response.text();
      response = JSON.parse(response);
      this.lastIdQuestion = response["lastIdQuestion"];
      console.log(response);
    },
    async submitAnswer(lastIdQuestion) {
      const apiUrl = "http://localhost/api/api.php";
      let temp = this.answers;
      let answerDatas = [];
      if (Array.isArray(temp) && temp.length > 0) {
        console.log(temp);
        console.log(temp[0]);
        temp.forEach((ThisAnswer) => {
          answerDatas.push({
            text: ThisAnswer,
            iscorect: this.rightAns == ThisAnswer ? 1 : 0,
          });
        });
      }
      const data = {
        type: "addAnswer",
        sid: jsCookie.get("userToken"),
        question_id: lastIdQuestion,
        answers: answerDatas,
      };
      console.log(JSON.stringify(data));
      let response = await sendRequest(apiUrl, data);
      response = await response.text();
      response = JSON.parse(response);
      console.log(response);
      this.$emit('submitted')
    },
  },
  data() {
    return {
      addQuestion: false,
      answer: "",
      answers: [],
      rightAns: false,
      thisQuestion: "",
      score: 0,
      lastIdQuestion: null,
    };
  },
  props: {
    show: {
      type: Boolean,
    },
  },
};
</script>

<style scoped>
label {
  width: max-content;
}
</style>
