<template>
  <button :name="name" :value="value">{{ value }}</button>
</template>

<style scoped>
button {
  color: #6757d9;
  font-size: 1rem;
  background-color: #eeedfb;
  border: 2px solid #6757d9;
  border-radius: 15px;
  padding: 8px 15px;
  margin: 20px 20px 0 0;
  cursor: pointer;
  transition: all 0.2s ease-in;
}

button:hover {
  background-color: #6757d9;
  color: #fff;
}
</style>

<script>
export default {
  name: "studentExamButton",
  props: {
    name: {
      type: String,
      default: "Button",
    },
    value: {
      type: String,
      default: "value",
    },
  },
};
</script>