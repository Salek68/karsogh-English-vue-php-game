<template>
  <div class="panel p-2">
    <slot class=""> </slot>
  </div>
</template>

<script>
export default {
  name: "rightPanel",
};
</script>

<style scoped>
.panel {
  border-radius: 20px;
  background: #242e42;
}
</style>
