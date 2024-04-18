<template>
  <input
    :type="type"
    class="graphik_medium"
    :name="name"
    :placeholder="placehold"
  />
</template>

<script>
export default {
  name: "Input1View",
  
  created() {
    this.data1 = null;
  },
  props: {
    placehold: {
      type: String,
      default: "text",
    },
    name: {
      type: String,
      default: "User",
    },
    type: {
      type: String,
      default: "text",
    },
  },
  data() {
    return {
      data1: {
        type: String,
      },
    };
  },
};
</script>

<style scoped>
input::placeholder {
  color: var(--light-blue-color);
  font-size: calc(13px + 0.2vw);
  font-style: normal;
  font-weight: 700;
  line-height: 300%;
  letter-spacing: 0.025rem;
  text-transform: capitalize;
  opacity: 0.6;
}
input {
  color: var(--light-blue-color);
  padding-right: 0.5rem;
  outline: none;
  height: 3.5rem;
  flex-shrink: 0;
  border-radius: 0.625rem;
  background: var(--gray-blue-color);
  box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
  border: none;
}
</style>
