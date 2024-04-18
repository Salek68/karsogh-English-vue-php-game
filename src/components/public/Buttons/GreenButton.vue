// Slot green button component // slot value is text of button
<template>
  <div>
    <button><slot></slot></button>
  </div>
</template>
<script>
export default {
  name: "GreenButton",
};
</script>
<style scoped>
div{
  font-size: calc(16px + 0.4vw);
  line-height: 48px; /* 200% */

}
button {
  border-radius: 10px;
  background: #00ae8a;
  box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
  border: none;
  padding: 0.5% 2%;
  width: 100%;
  /*  */
  color: #fff;
  text-align: center;
  font-family: "Graphik Arabic";
  font-style: normal;
  font-weight: 700;
  letter-spacing: -0.36px;
  text-transform: capitalize;
}
button:hover{
  background: var(--dark-green-color);
}
</style>
