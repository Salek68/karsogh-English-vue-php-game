<template>
  <div class="w-100 quiz row">
    <div class="row">
      <div class="row">
        <div class="title">عنوان : {{ title }}</div>
        <!-- <div class="time col-lg-auto">زمان : {{ time }}</div> -->
      </div>
      <!-- <div class="text">توضیح : {{ text }}</div> -->
    </div>
    <div class="row">
      <div class="detail col-lg-auto">نمره : {{ score }}</div>
    </div>

  
  </div>
</template>
<script>
export default {
  name: "quizInPanel",
  props: {
    title: {
      type: String,
    },
    score: {
      type: String,
    },
  
  },
};
</script>
<style scoped>
.describe {
  padding-right: 5%;
}
.quiz {
  border-radius: 20px;
  background: #657d95;
  box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
  padding: 2% 5% 2% 1%;
}
.icon {
  width: 1.7vw;
  padding: 0;
  padding-right: 0.5%;
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
  width: 15%;
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
.time,
.level {
  color: #d9d9d9;
  text-align: center;
  font-family: graphik_medium;
  font-size: calc(15px + 0.08vw);
  font-weight: lighter;
}
.title {
  width: 80%;
}
.time {
  padding-top: 1.5%;
}
.detail {
  /* margin-right: 10%; */
  color: #fff;
  text-align: right;
  font-family: graphik_light;
  font-size: 14px;
  line-height: 48px; /* 300% */
}
</style>
