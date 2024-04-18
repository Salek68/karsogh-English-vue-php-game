<template>
  <p class="graphik_bold text-center w-100 h1">
    <slot>

    </slot>
  </p>
</template>

<script>
export default {
    name:"GreenBigTitle"
};
</script>

<style scoped>
p {
    color: var(--light-green-color);
  font-size: calc(27px + 0.8vw);

}
</style>
