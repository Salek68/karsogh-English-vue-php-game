<template>
  <div class="col-8 p-0 mt-4 justify-content-center align-items-center content">
    <div class="lastSection">
      <p class="title">آزمون های شما :</p>
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
// import SearchAndFilterVue from "../components/test/yours/SearchAndFilter.vue";
import { sendRequest } from "@/script/private/API-Request";
import quizVue from "../components/test/yours/quiz.vue";
import jsCookie from "js-cookie";
import router from "@/router";

export default {
  name: "YourTests",
  components: {
    quiz: quizVue,
    // SearchAndFilter: SearchAndFilterVue,
  },
  created() {
    this.recieveQuizDatas();
  },
  methods: {
    deletequiz(id){
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
      if(quizDatas == null){
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
      }
else{
  this.quizList = quizDatas;
}
    
 
      this.dataIsValid = true;
    },
  },
  data() {
    return {
      quizList: { type: Array },
      dataIsValid: false,
    };
  },
};
</script>
<style scoped>
* {
  overflow: auto;
}
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

.section_quiz_box {
  width: 80% !important ;
}
.content {
  max-height: 85vh;
  overflow-y: scroll;
}
</style>
