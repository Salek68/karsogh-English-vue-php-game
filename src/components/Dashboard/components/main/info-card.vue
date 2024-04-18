<template>
  <div :style="{ backgroundColor: backgroundColor }" class="card">
    <p>{{ title }} :</p>
    <h2>{{ content }}</h2>
    <img src="../../../../assets/Picture/question.svg" alt="" class="card-image">
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true
    },
    content: {
      type: String,
      required: true
    },
    backgroundColor: {
      type: String,
      default: "#ffffff"
    },
    // imageId: {
    //   type: Number,
    //   required: true,
    //   default: 1
    // }
  },
  computed: {
    // computedImageSrc() {
    //   // مسیر پیش‌فرض
    //   let imagePath = require('../../../../assets/Picture/Exam.svg');

    //   // اگر imageId برابر با 1 یا 2 یا 3 باشد، مسیر مربوط به imageId انتخاب شود
    //   if (this.imageId === 1) {
    //     imagePath = require('../../../../assets/Picture/question.svg');
    //   } else if (this.imageId === 2) {
    //     imagePath = require('../../../../assets/Picture/Exam.svg');
    //   } else if (this.imageId === 3) {
    //     imagePath = require('../../../../assets/Picture/question.svg');
    //   }

    //   return require(imagePath);
    // }
  }
};
</script>

<style scoped>
.card {
  border: 1px solid #ccc;
  padding: 10px;
  margin: 10px;
  border-radius: 2rem;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  position: relative;
}

h2 {
  color: #242e42;
  text-align: center;
  z-index: 2;
}

p {
  color: #f1f1f1;
  margin-bottom: 8px;
  z-index: 2;
}

.card-image {
  width: 11rem;
  position: absolute;
  top: 0;
  left: 0;
  opacity: 30%;
  margin-top: -1.5rem;
  margin-left: -3rem;
}
</style>
