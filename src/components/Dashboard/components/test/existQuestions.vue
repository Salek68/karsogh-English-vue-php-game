<template>
  <div class="w-100 question row">
    <div class="row">
      <div class="row col-1">
        <input
          class="col-10"
          type="checkbox"
          @change="addQuestion"
          :value="id"
          v-model="isSelected"
        />
      </div>
      <div class="col-11 row">
        <div class="title">{{ title }}</div>
        <div class="type col-auto">نمره سوال :{{ score }}</div>
      </div>
      <div class="text">{{ text }}</div>
    </div>
    <div class="row">
      <!-- <div class="level col-auto">سطح سختی : {{ level }}</div> -->
    </div>
  </div>
</template>
<script>
import jsCookie from "js-cookie";
import { sendRequest } from "@/script/private/API-Request";
export default {
  name: "questionInPanel",
  async created() {
    // console.log('this.selectedQuestions');
    // console.log(this.selectedQuestions);
    // console.log("this" + this.id + this.title + this.selected);
    // this.isSelected = this.selected;
    await this.checkSelect(this.item, this.selectedQuestions);
  },
  props: {
    title: {
      type: String,
    },
    text: {
      type: String,
    },
    type: {
      type: String,
    },
    level: {
      type: String,
    },
    score: Number,
    id: Number,
    item: [],
    selectedQuestions: [],
  },
  data() {
    return {
      isSelected: Boolean,
    };
  },
  methods: {
    async checkSelect(item, selectedQuestions) {
      let res = false;
      selectedQuestions.forEach((ThisQuestion) => {
        if (item["id"] == ThisQuestion["question_id"]) {
          res = true;
        }
      });
      console.log(res);
      this.isSelected = res;
    },
    async addQuestion(e) {
      const apiUrl = "http://localhost/api/api.php";
      let data = await {
        type: "addExistQuestionToQuiz",
        sid: jsCookie.get("userToken"),
        add: e.target.checked,
        quiz_id: this.$route.params.id,
        question_id: this.id,
      };
      let response = await sendRequest(apiUrl, data);
      let responseBody = await response.text();
      let jsonData = await JSON.parse(responseBody);
      console.log(jsonData);
    },
  },
};
</script>
<style scoped>
.question {
  border-radius: 20px;
  background: #657d95;
  box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
  padding: 2% 5% 2% 1%;
}
.icon {
  width: 2.4vw;
  padding: 0;
  padding-right: 1%;
}
.editBtn {
  color: #001e17;
  text-align: right;
  font-family: graphik_medium;
  font-size: 15px;
  font-style: normal;
  font-weight: 100;
  line-height: 48px; /* 320% */
  text-transform: capitalize;
  width: 80%;
}
.text,
.title {
  color: #fff;
  text-align: right;
  font-family: graphik_medium;
  font-size: 16px;
  font-weight: 10;
  line-height: 48px; /* 300% */
  letter-spacing: -0.24px;
  text-transform: capitalize;
}
.type,
.level {
  color: #d9d9d9;
  text-align: center;
  font-family: graphik_medium;
  font-size: calc(15px + 0.08vw);
  font-weight: lighter;
}
.title {
  width: 83%;
}
.type {
  padding-top: 1.5%;
}
</style>
