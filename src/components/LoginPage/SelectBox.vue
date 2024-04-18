<template>
  <div>
    <select
      name="access"
      @change="
        console.log(access1);
        $emit('changeData', access1);
      "
      v-model="access1"
      id="access"
    >
      <option value="modir">مدیر</option>
      <option value="dabir">معلم</option>
      <option value="honarjo">دانش آموز</option>
    </select>
  </div>
</template>
<script>
export default {
  name: "SeelectAccess",
  created() {
    this.access1 = null;
  },
  data() {
    return {
      access1: "",
    };
  },
};
</script>
<style scoped>
select {
  width: 60%;
  border-radius: 10px;
  background: #d9d9d9;
  box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
  border: none;
  padding: 2% 4%;
}
</style>
