<template>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
  <div class="background-container row align-items-stretch justify-content-center m-0">
    <div class="svg-container col-sm-6 col-8 me-sm-3 me-lg-6 justify-content-center">
      <img class="" src="../assets/Picture/human.svg" alt="Not found" />
    </div>
    <div class="content row col-lg-10 col-m-12 justify-content-center text-center m-0">
      <title1-view class="title col-5 fw-bold">صفحه پیدا نشد!</title1-view>
      <p class="paragraph col-10 col-sm-12">
        با عرض پوزش ، ما نتوانستیم صفحه ای را که به دنبال آن هستید پیدا کنیم.
      </p>
      <Button1View value="بازگشت به صفحه اصلی" class="backButton col-md-6 col-lg-8"></Button1View>
    </div>
  </div>
</template>

<script>
import Title1View from "../components/public/Texts/GreenBigTitle.vue";
import Button1View from "../components/public/Buttons/Button1View.vue";
export default {
  components: {
    Title1View: Title1View,
    Button1View: Button1View,
  },
};
</script>

<style scoped>

.background-container {
  width: 100vw;
  height: 100vh;
  background: url("../assets/Picture/Group404.svg") center/cover no-repeat;
}

.svg-container img {
  width: 100%;
  max-height: 50vh;
}

.svg-container {
  height: fit-content;
}

.title {
  font-size: 50px;
}

.paragraph {
  color: #20293c;
  font-size: 24px;
}

.content {
  margin-bottom: 3rem !important;
}

</style>