<template>
  <div class="col-lg-8 me-5 h-100vh justify-content-center">
    <div class="lastSection" v-if="this.dataSeted">
      <quiz
        v-for="item in quizes"
        :key="item['id']"
        :time="item['time']"
        :title="item['title']"
        :text="item['description']"
        :lesson="item['fasl']"
        :topic="item['bookName']"
        :level="item['level']"
        class="mb-4"
        :admin="false"
        @click="
        
        if (testing){
         alerted();
        }else{
                  this.$router.push({ name: 'studentExamPage', params: { id: item['id'] } })

        }
          
        "
        @mouseover="chek(item['id'])"
      />
    </div>
  </div>
</template>

<script>
import quizVue from "@/components/Student/components/quiz/quiz.vue";
import { sendRequest } from "@/script/private/API-Request";

import jsCookie from "js-cookie";
export default {
  components: {
    quiz: quizVue,
  },
  mounted() {},
  async created() {
    await this.getQuizByApi();
    console.log("aaaaaaaaa" + JSON.stringify(this.quizes));
    console.log(this.quizes);
  },
  data() {
    return {
      quizes: {
        type: Array,
      },
      dataSeted: false,
      testing : false,
    };
  },
  methods: {
    alerted(){
      alert('azmon dade shode');
    },
    async getQuizByApi() {
      const apiUrl = "http://localhost/api/api.php";
      let data = {
        type: "listquiz",
        ac: "student",
        sid: jsCookie.get("userToken"),
        on: "class",
      };
      let quizes = await sendRequest(apiUrl, data);
      quizes = await quizes.text();
      quizes = JSON.parse(quizes);
      if (!quizes) {
        quizes = ["1"];
        
      }
      this.quizes = quizes;
      data = {
        type: "listquiz",
        ac: "student",
        sid: jsCookie.get("userToken"),
        on: "self",
      };
      quizes = await sendRequest(apiUrl, data);
      quizes = await quizes.text();
      quizes = JSON.parse(quizes);
      if (this.quizes[0]) {
        this.dataSeted = true;
        this.quizes = await this.quizes.concat(quizes);
      
      } else if (quizes) {
        this.dataSeted = true;
        this.quizes = quizes;
      } 
        if(this.quizes[0] == null){
               this.quizes = JSON.parse(`[
          {
              "id": "1",
              "title": "نمونه ازمون",
              "description": "نمونه ازمون",
              "bookName": "نمونه ازمون",
              "fasl": "نمونه ازمون",
              "level":"سخت",
              "time": "نمونه ازمون"
          }
      ]`)}
      console.log(this.quizes);
    },
    async chek(idc){
      const apiUrl = "http://localhost/api/api.php";
      let data = {
        type: "quizcheekansewer",
     
        sid: jsCookie.get("userToken"),
       id : idc
      };
      let cheked = await sendRequest(apiUrl, data);
      cheked = await cheked.text();
      cheked = JSON.parse(cheked);
      this.testing = cheked;

    },
  },
};
</script>

<style scoped>
.lastSection {
  margin-top: 10%;
  height: min-content;
}
</style>
