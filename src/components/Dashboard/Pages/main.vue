<template>
  <div class="col-md-12 col-lg-8 h-100vh justify-content-center">
    <div class="row align-items-center justify-content-around parts">
      <Card title="تا پایان اشتراک" content="11 روز" backgroundColor="#00ae8a" class="col-3" />
      <Card
        title="آزمون های شما"
        :content="YourQuiz + ' آزمون'"
        backgroundColor="#00ae8a"
        class="col-3"
      />
      <Card
        title="آزمون های ثبت شده"
        :content="detail['AllQuizCounts'] + ' عدد'"
        backgroundColor="#00ae8a"
        imageId="1"
        class="col-3"
      />
    </div>
    <div class="lastSection">
      <p class="title">آخرین آزمون ها :</p>
      <quiz
        class="mb-2"
        :v-if="dataIsValid"
        v-for="item in quizList"
        :key="item['id']"
        :class="'m-0 section_quiz_box justify-contect-center'"
        :level="item['level']"
        :title="item['title']"
        :lesson="item['fasl']"
        :topic="item['bookName']"
        @click="deletequiz(item['id'])"
      />
    </div>
  </div>
</template>
<script>
// import questionVue from "../components/main/question.vue";
// import suggestVue from "../components/main/suggest.vue";
import Card from "../components/main/info-card.vue";
import { sendRequest } from "@/script/private/API-Request";
import quizVue from "../components/test/yours/quiz.vue";
import jsCookie from "js-cookie";
import router from "@/router";

export default {
  name: "mainPanel",
  components: {
    // suggest: suggestVue,
    // question: questionVue,
    Card,
    quiz: quizVue,
  },
  created() {
    this.getDetail();
    this.getYourQuiz();
    this.recieveQuizDatas();
  },
  methods: {
    deletequiz(id) {
      const apiUrl = "http://localhost/api/api.php";
      const data = {
        type: "deletequiz",
        quizID: id,
        sid: jsCookie.get("userToken"),
      };
      try {
        sendRequest(apiUrl, data);
        alert("ok");
      } catch (error) {
        alert("false" + error);
      }
    },
    changeToRoute(name) {
      router.push({ name: name });
    },
    async getYourQuiz() {
      const apiUrl = "http://localhost/api/api.php";
      let detail = await sendRequest(apiUrl, {
        type: "listquiz",
        sid: jsCookie.get("userToken"),
        ac: "adbir",
      });
      detail = await detail.text();
      detail = JSON.parse(detail);
      this.YourQuiz = detail[0].length;
      console.log(detail[0]);
    },
    async getDetail() {
      const apiUrl = "http://localhost/api/api.php";
      let detail = await sendRequest(apiUrl, {
        type: "SiteDetail",
        sid: jsCookie.get("userToken"),
      });
      detail = await detail.text();
      console.log(detail);
      detail = JSON.parse(detail);
      console.log(detail);
      this.detail = detail;
    },
    async recieveQuizDatas() {
      const apiUrl = "http://localhost/api/api.php";
      let user = await sendRequest(apiUrl, {
        type: "loginornot",
        sid: jsCookie.get("userToken"),
      });
      user = await user.text();
      user = JSON.parse(user);
      if (user["message"] == false) {
        // TODO break progress
      }
      let userLevel;
      if (["ismodir"] in user["اطلاعات کاربری"][0]) {
        userLevel = "adbir";
        // if (user["اطلاعات کاربری"][0]["ismodir"] == 0) {
        //   userLevel = "adbir";
        // }else{
        //   userLevel = 'modir'
        // }
      } else {
        userLevel = "student";
      }
      const data = {
        type: "listquiz",
        ac: userLevel,
        sid: jsCookie.get("userToken"),
      };
      console.log(data);
      let quizDatas = await sendRequest(apiUrl, data);
      quizDatas = await quizDatas.text();
      quizDatas = JSON.parse(quizDatas)[0];
      if (quizDatas == null) {
        this.quizList = JSON.parse(`[
          {
              "id": "1",
              "title": "نمونه ازمون",
              "description": "نمونه ازمون",
              "bookName": "نمونه ازمون",
              "fasl": "نمونه ازمون",
              "level":"سخت",
              "time": "نمونه ازمون"
          }
      ]`);
      } else {
        this.quizList = quizDatas.slice(-2);
      }

      this.dataIsValid = true;
    },
  },
  data() {
    return {
      quizList: { type: Array },
      dataIsValid: false,
      detail: Array,
      YourQuiz: Number,
    };
  },
};
</script>
<style scoped>
.lastSection {
  margin-top: 10%;
  height: min-content;
}
.parts {
  margin-top: 10vh !important;
}
.title {
  text-align: right !important;
  color: #242e42;
  font-family: graphik_medium;
  font-size: calc(15px + 0.6vw);
}
</style>
