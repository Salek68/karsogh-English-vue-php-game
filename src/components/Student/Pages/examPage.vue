<template>
  <div class="main" style="">
    <div class="row">
      <div class="col-lg-12 h-100vh d-flex align-items-center justify-content-center">
        <div id="container col-10 salam">
          <div class="header">
            <div class="sentence">
              <p>Question No:</p>
              <span id="question-number">{{ thisQuiestion + 1 }}</span>
            </div>
          </div>
          <div id="question-box">
            <h3 id="question-text">{{ this.thisQuiestionData["text"] }}</h3>
            <studentAnswerExamButton
              @clickedAns="this.setAnswer"
              :selected="this.selected"
              v-for="item in this.thisQuiestionData['Answers']"
              :key="item['id']"
              :itemid="item['id']"
              :value="item['text']"
            />
          </div>
          <div class="buttons">
            <studentExamButton
              @click="nextQuestion"
              v-if="!this.ended"
              value="بعدی"
            ></studentExamButton>
            <studentExamButton
              @click="submitAnswers"
              v-if="this.ended"
              value="پایان"
            ></studentExamButton>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import studentExamButton from "@/components/Student/components/exam/examButton.vue";
import studentAnswerExamButton from "@/components/Student/components/exam/answerButton.vue";
import { sendRequest } from "@/script/private/API-Request";
import jsCookie from "js-cookie";
import router from "@/router";

export default {
  name: "studentExamPage",
  components: {
    studentExamButton,
    studentAnswerExamButton,
  },
  created() {
    this.getDatas();
  },
  methods: {
    async getDatas() {
      const apiURL = "http://localhost/api/api.php";
      const data = {
        type: "quizData",
        sid: await jsCookie.get("userToken"),
        quiz_id: this.$route.params.id,
      };
      let response = await sendRequest(apiURL, data);
      response = await response.text();
      response = JSON.parse(response);
      if (response["success"]) {
        console.log(response["data"]);
        this.Questions = response["data"];
      }
      // let data =
      this.setQuestion();
    },
    nextQuestion() {
      this.thisQuiestion++;
      if (this.thisQuiestion >= this.Questions.length) {
        this.ended = true;
      } else {
        this.setQuestion();
      }
    },
    setQuestion() {
      this.thisQuiestionData = this.Questions[this.thisQuiestion];
    },
    setAnswer(key) {
      console.log(key);
      this.selected = key;
      this.answers[this.Questions[this.thisQuiestion]["id"]] = this.selected;
      console.log(this.answers);
    },
    async submitAnswers() {
      const apiUrl = "http://localhost/api/api.php";
      console.log("aaaaaaaaaaaaaaaaaaaaa" + JSON.stringify(this.answers));
      console.log(this.answers);
      const data = {
        type: "submitQuiz",
        sid: jsCookie.get("userToken"),
        quiz_id: this.$route.params.id,
        answers:this.answers,
      };
      let response = await sendRequest(apiUrl, data);
      response = await response.text();
      response = JSON.parse(response);
      if (["success"] in response) {
        alert("پاسخ ها ثبت شدند");
        this.changeToRoute("student");
      }
    },
    changeToRoute(name) {
      router.push({ name: name });
    },
  },
  data() {
    return {
      Questions: Array,
      thisQuiestion: 0,
      thisQuiestionData: Array,
      ended: false,
      selected: Number,
      answers: {
        type: Object,
      },
    };
  },
};
</script>

<style scoped>
.main {
  background-color: var(--light-gray-color) !important;
  height: 100vh;
  width: 100vw;
}
.header {
  display: flex;
  justify-content: center;
  direction: ltr;
  margin-top: 4rem;
}
.sentence {
  display: flex;
  align-items: center;
}
.sentence p {
  color: #6757d9;
  font-size: 1.4rem;
  font-weight: 600;
  margin-right: 10px;
  margin-top: 10px;
}
.sentence span {
  display: inline-block;
  background-color: #fff;
  width: 25px;
  height: 25px;
  line-height: 25px;
  text-align: center;
  font-weight: 600;
  font-size: 1.2rem;
  color: #6757d9;
  border-radius: 4px;
}
#question-box {
  display: flex;
  flex-direction: column;
  width: 700px;
}
h3 {
  background-color: #6757d9;
  color: #fff;
  padding: 20px;
  border-radius: 20px;
  margin: 20px 0 20px;
}
.buttons {
  display: flex;
  justify-content: center;
}
</style>
