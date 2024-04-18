<template>
  <button :name="name" :value="value">{{ value }}</button>
</template>

<script>
export default {
  name: "Button1View",
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

<style scoped>
button {
  display: flex;
  width: 271px;
  height: 77px;
  padding: 24px 10px;
  justify-content: center;
  align-items: center;
  align-content: center;
  gap: 10px;
  flex-shrink: 0;
  flex-wrap: wrap;
  border-radius: 10px;
  background: #187d80;
  box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
  border: none;
  color: #fff;
  font-feature-settings: "clig" off, "liga" off;
  font-family: "graphik_bold";
  font-size: 24px;
  font-style: normal;
  font-weight: 700;
  line-height: 36px; /* 150% */
}
</style>
