<template>
  <div>
    <p class="graphik_medium">
      <slot></slot>
    </p>
  </div>
</template>

<script>
export default {
  name: "WhiteMediumText",
};
</script>

<style scoped>
p {
  color: var(--white-color);
  font-size: calc(15px + 0.2vw);
  font-style: normal;
  font-weight: 500;
   line-height: 3rem;/* 240% */
  letter-spacing: -0.01875rem;
  text-transform: capitalize;
}
</style>
