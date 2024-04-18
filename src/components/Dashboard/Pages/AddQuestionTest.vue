<template>
  <div class="col-8 row me-5 mt-4 justify-content-center" style="height: min-content">
    <div class="col-12 justify-content-center row">
      <GreenButton
        v-if="addQuestion"
        class="col-lg-5 mt-5"
        @click="
          existQuestion = true;
          newQuestion = true;
          addQuestion = false;
        "
        >افزودن سوال</GreenButton
      >
    </div>
    <div class="col-12 row justify-content-center">
      <GreenButton
        class="col-lg-5 mt-5"
        v-if="existQuestion"
        @click="
          addExistQuestionClicked = true;
          newQuestion = false;
          existQuestion = false;
        "
        >سوالات موجود</GreenButton
      >
      <GreenButton
        class="col-lg-5 mt-5"
        v-if="newQuestion"
        @click="
          addNewQuestion = true;
          newQuestion = false;
          existQuestion = false;
        "
        >سوال جدید</GreenButton
      >
    </div>
    <div class="col-12 row justify-content-center">
      <addQuestion
        @submitted="eventTouched++"
        :show="addNewQuestion"
        @submit-question="
          addNewQuestion = false;
          addQuestion = true;
        "
      />
      <addExistQuestion
        @submitted="eventTouched++"
        :show="addExistQuestionClicked"
        @submit-question="
          addExistQuestionClicked = false;
          addQuestion = true;
        "
      />
      <existQuestion :eventTouched="eventTouched" id="exist" />
    </div>
    <GreenButton
      class="col-lg-3 mt-4 button"
      @click="this.$router.push({ name: 'addTest3', params: { id: $route.params.id } })"
      style="font-size: calc(15px + 0.2vw) !important; line-height: 200%"
      >مرحله بعد</GreenButton
    >
  </div>
</template>

<script>
import GreenButtonVue from "@/components/public/Buttons/GreenButton.vue";
import addQuestionVue from "../components/public/addQuestion.vue";
import ExistQuestionVue from "../components/test/exist/ExistQuestion.vue";
import router from "@/router";
import addExiatQuestionVue from "../components/public/addExiatQuestion.vue";

export default {
  components: {
    GreenButton: GreenButtonVue,
    addQuestion: addQuestionVue,
    existQuestion: ExistQuestionVue,
    addExistQuestion: addExiatQuestionVue,
  },
  methods: {},
  changeToRoute(name) {
    router.push({ name: name });
  },
  data() {
    return {
      addQuestion: true,
      newQuestion: false,
      existQuestion: false,
      addNewQuestion: false,
      addExistQuestionClicked: false,
      eventTouched: 0,
    };
  },
};
</script>

<style></style>
