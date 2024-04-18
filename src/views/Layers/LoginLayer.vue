<template>
  <div class="grid">
    <div class="main row align-items-center justify-content-center">
      <div class="cont row justify-content-center">
        <slot></slot>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "LayerComponent1",
};
</script>

<style scoped>
.main {
  background-color: var(--dark-clay-color);
  width: 100%;
  height: 100vh;
  --bs-gutter-x: 0;
}
.cont {
  border-radius: 30px;
  width: 70vw;
  background-color: var(--lighten-clay-color);
}
</style>
