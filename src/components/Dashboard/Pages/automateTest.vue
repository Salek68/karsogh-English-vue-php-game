<template>
  <div class="col-12 col-md-8 p-5 mt-4 justify-content-center">
    <div class="row mt-5 justify-content-center align-items-center">
      <div class="row justify-content-center align-items-center">
        <label for="" class="lbl" style="text-align: center">تعداد سوالات :</label>
        <input
          class="name col-lg-6"
          v-model="questionCount"
          name="name"
          type="number"
          style="margin: 5% 0%"
        />
      </div>
      <GreenButton @click="startWizard()">مرحله بعد</GreenButton>
    </div>
  </div>
</template>

<script>
import GreenButtonVue from "@/components/public/Buttons/GreenButton.vue";
import jsCookie from "js-cookie";
import { sendRequest } from "@/script/private/API-Request";

export default {
  components: {
    GreenButton: GreenButtonVue,
  },
  data() {
    return {
      questionCount: Number,
    };
  },
  methods: {
    async startWizard() {
      const apiUrl = "http://localhost/api/api.php";
      const datasFromCookie = await JSON.parse(await jsCookie.get("tempNewQuiz"));
      const data = {
        type: "quizWizard",
        sid: await jsCookie.get("userToken"),
        quiz_id: this.$route.params.id,
        fasl_id: datasFromCookie["fasl"],
        classified: false,
        difficulty: datasFromCookie["level"],
        question_count: this.questionCount,
      };
      console.log(data);
      let response = await sendRequest(apiUrl, data);
      response = await response.text();
      response = JSON.parse(response);
      console.log(response);
      this.$router.push({ name: 'addTest3', params: { id: this.$route.params.id } })
    },
  },
};
</script>

<style scoped></style>
