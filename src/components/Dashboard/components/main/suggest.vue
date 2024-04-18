<template>
  <div class="col-3 part"><slot></slot></div>
</template>
<script>
export default {
  name: "suggestInPanel",
};
</script>
<style scoped>
.part {
  border-radius: 20px;
  background: #187d80;
  box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
}
</style>
