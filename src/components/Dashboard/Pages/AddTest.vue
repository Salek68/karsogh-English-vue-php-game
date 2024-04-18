<template>
  <div class="col-12 col-md-8 p-5 mt-4 justify-content-center">
    <div class="row mt-5 justify-content-center align-items-center">
      <div class="row justify-content-center align-items-center">
        <label for="" class="lbl">نام آزمون :</label>
        <input class="name col-lg-6" v-model="quizName" name="name" type="text" />
      </div>
      <!-- <div class="mt-3 row justify-content-center align-items-center">
        <label for="" class="lbl">توضیحات آزمون :</label>
        <textarea rows="" cols=""></textarea>
      </div> -->
      <div class="row align-items-center justify-content-between mt-4">
        <div class="col-4 row">
          <label for="topic" class="form-label">کتاب</label>
          <select
            class="form-select"
            @change="
              () => {
                console.log(dars);
                dars != 'Select one' ? topicSelected() : (isBookSelected = false);
              }
            "
            name="topic"
            v-model="dars"
          >
            <option value="Select one" selected>Select one</option>
            <option v-for="item in booksList" :key="item['id']" :value="item['id']">
              {{ item["name"] }}
            </option>
          </select>
        </div>
        <div class="col-4 row">
          <label for="lesson" class="form-label">درس</label>
          <select
            class="form-select"
            :disabled="!isBookSelected"
            v-model="fasl"
            name="lesson"
          >
            <option selected>Select one</option>
            <option v-for="item in darsList" :key="item['id']" :value="item['id']">
              {{ item["name"] }}
            </option>
          </select>
        </div>
        <div class="col-4 row">
          <label for="topic" class="form-label">میزان سختی</label>
          <select class="form-select" name="topic" v-model="level" id="">
            <option selected>Select one</option>
            <option value="1">ساده</option>
            <option value="2">متوسط</option>
            <option value="3">سخت</option>
          </select>
        </div>
      </div>
      <GreenButton
        class="col-lg-3 mt-4 button"
        @click="addQuiz()"
        style="font-size: calc(15px + 0.2vw) !important; line-height: 200%"
        >افزودن سوالات</GreenButton
      >
      <GreenButton
        class="col-lg-3 mt-4 button"
        @click="wizard()"
        style="font-size: calc(15px + 0.2vw) !important; line-height: 200%"
        >ساخت ازمون اتومات</GreenButton
      >
    </div>
  </div>
</template>

<script>
import GreenButtonVue from "@/components/public/Buttons/GreenButton.vue";
import router from "@/router";
import { sendRequest } from "@/script/private/API-Request";
import jsCookie from "js-cookie";
export default {
  name: "newTest",
  components: {
    GreenButton: GreenButtonVue,
  },
  created() {
    this.defineDatas();
  },
  methods: {
    changeToRoute(path) {
      router.push(path);
    },
    async topicSelected() {
      const apiUrl = "http://localhost/api/api.php";
      const data = {
        type: "fasl",
        darsId: this.dars,
      };
      let fasl = await sendRequest(apiUrl, data);
      fasl = await fasl.text();
      fasl = JSON.parse(fasl);
      this.darsList = fasl["mess"];
      this.isBookSelected = true;
    },
    async wizard() {
      const apiUrl = "http://localhost/api/api.php";
      const data = {
        type: "makequiz",
        sid: await jsCookie.get("userToken"),
        fasl: this.fasl,
        name: this.quizName,
        level: this.level,
      };
      console.log(data);
      let response = await sendRequest(apiUrl, data);
      response = await response.text();
      response = JSON.parse(response);
      console.log(response);
      await jsCookie.set(
        "tempNewQuiz",
        JSON.stringify({ level: this.level, fasl: this.fasl }),
        {
          expires: 1,
        }
      );
      this.$router.push({
        name: "wizardTest",
        params: { id: response["mess"]["lastIndex"] },
      });
    },
    async addQuiz() {
      const apiUrl = "http://localhost/api/api.php";
      const data = {
        type: "makequiz",
        sid: await jsCookie.get("userToken"),
        fasl: this.fasl,
        name: this.quizName,
        level: this.level,
      };
      console.log(data);
      let response = await sendRequest(apiUrl, data);
      response = await response.text();
      response = JSON.parse(response);
      console.log(response);
      await jsCookie.set(
        "tempNewQuiz",
        JSON.stringify({ level: this.level, fasl: this.fasl }),
        {
          expires: 1,
        }
      );
      this.$router.push({
        name: "addTest2",
        params: { id: response["mess"]["lastIndex"] },
      });
    },
    async defineDatas() {
      const apiUrl = "http://localhost/api/api.php";
      const data = {
        type: "dars",
      };
      let books = await sendRequest(apiUrl, data);
      books = await books.text();
      books = JSON.parse(books);
      this.booksList = books["mess"];
    },
  },
  data() {
    return {
      level: "Select one",
      fasl: "Select one",
      dars: "Select one",
      quizName: null,
      isBookSelected: false,
      booksList: {
        type: Array,
      },
      darsList: {
        type: Array,
      },
    };
  },
};
</script>

<style scoped>
label {
  text-align: center;
}
.form-label {
  width: max-content;
}
.lbl {
  width: max-content;
  margin-bottom: 1%;
}
select {
  width: max-content;
}
</style>
