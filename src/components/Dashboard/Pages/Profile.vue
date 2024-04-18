<template>
  <div class="col-8 row me-5 justify-content-center align-items-center layout">
    <img src= ../../../assets/Picture/dashboard/avatar.svg class="profile"
    alt="profile" />
    <h2>یک فرد تستی</h2>
    <Input1View :value="'مشهد,خراسان رضوی'" placeholder="شهر"></Input1View>
    <div class="information">
      <div class="content">
        <h6>تعداد کلاس ها:</h6>
        <h6>2</h6>
      </div>
      <div class="content">
        <Input1View
          :value="'09155555555'"
          placeholder="شماره تلفن"
        ></Input1View>
      </div>
      <div class="content">
        <h6>نام مدرسه:</h6>
        <h6>امیرکبیر</h6>
      </div>
      <button-1-view value="ثبت"></button-1-view>
    </div>
  </div>
</template>

<script>
import Input1View from "@/components/public/Inputs/Input1ViewWithoutClick.vue";
import Button1View from "@/components/public/Buttons/Button1View.vue";
export default {
  name: "ProfilePanel",
  components: {
    Input1View: Input1View,
    Button1View: Button1View,
  },
};
</script>

<style scoped lang="scss">
.layout {
  height: 80vh;
  border-radius: 20px;
  margin-top: 4.5rem !important;
  background-color: #242e42;
  color: var(--white-color);
}
.profile {
  width: 11.25rem !important;
  height: 10rem !important;
  border-radius: 50%;
  align-items: center;
  margin-top: -1rem;
}

input {
  font-family: "graphik_bold";
  margin-top: -13.75rem !important;
  font-size: 1rem !important;
  width: max-content;
  height: 3rem;
  text-align: center;
  border-radius: 10px;
  color: var(--white-color) !important;
}
h2 {
  font-family: "graphik_bold";
  margin-top: -8.75rem !important;
  font-size: 2rem !important;
  text-align: center;
  color: var(--white-color) !important;
}

.information {
  display: flex;
  text-align: center;
  margin-right: 22.5rem;
  margin-top: -9.75rem;
  gap: 1.5625rem;
  h6 {
    display: flex;
    margin-right: 0.4375rem;
    margin-top: 0.5rem;
  }
  .content {
    display: flex;
    margin-right: 1.5rem;
  }
  input {
    margin-top: -0.3em !important;
    margin-right: 0.4375rem;
    border-radius: 10px;
    width: 14.5rem;
    height: 3rem;
  }

  button {
    width: 14.5rem;
    height: 3rem;
    margin-top: 5.25rem !important;
    margin-right: -27.2rem !important;
  }
}
</style>
