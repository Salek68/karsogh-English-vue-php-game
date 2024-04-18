<template>
  <div
    class="option w-100 m-0 mb-2 row justify-content-md-start justify-content-center align-items-center"
  >
    <div class="col-2 ms-3 ms-md-0 p-md-0">
      <img class="icon rounded" :src="img" alt="" />
    </div>
    <div class="col-9 p-0 pe-2 text-end text">
      <p class="text fs-lg-3 fs-xl-5">{{ text }}</p>
    </div>
  </div>
</template>
<script>
export default {
  name: "optionPanel",
  props: {
    img: {
      type: String,
    },
    text: {
      type: String,
    },
  },
};
</script>
<style scoped>
.text {
  margin-top: 0.3rem;
}

.option {
  transition: all 450ms;
}

.option:hover {
  cursor: pointer;
  background-color: var(--light-green-color);
  border-radius: 1rem;
}

.option:first-child {
  border-top-right-radius: 20px;
  border-top-left-radius: 20px;
}
</style>
