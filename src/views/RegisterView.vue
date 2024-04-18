<template>
  <layer>
    <div>
      <!-- <title-1-view class="mt-4 mb-4">ورود به سامانه هنرستان</title-1-view> -->
    </div>
    <div class="row justify-content-center mb-4 mt-2">
      <div class="col-lg-6 col-12 d-flex justify-content-center align-items-center">
        <div class="row col-lg-8 mb-5" style="width: fit-content; height: fit-content">
          <!-- <SelectAccess @changeData="changeAccess" class="select"></SelectAccess> -->
          <selectSchoolRegister @changeData="getSchoolToClass" />
          <selectClassRegister :schoolId="schoolID" @changeData="changclass_id" />
          <Text1View>لطفا نام خود را وارد کنید :</Text1View>
          <Input1View
            @ChangeDataEvent="changefname"
            :name="'UserName'"
            :placehold="'نام ...'"
          />
          <Text1View>لطفا نام خانوادگی خود را وارد کنید :</Text1View>
          <Input1View
            @ChangeDataEvent="changelname"
            :name="'UserName'"
            :placehold="' نام خانوادگی ...'"
          />
          <Text1View>لطفا نام کاربری خود را وارد کنید :</Text1View>
          <Input1View
            @ChangeDataEvent="changeUserName"
            :name="'UserName'"
            :placehold="' نام کاربری ...'"
          />
          <Text1View>لطفا رمز عبور خود را وارد کنید :</Text1View>
          <Input1View
            @ChangeDataEvent="changePassword"
            :type="'password'"
            :name="'Password'"
            :placehold="'رمز عبور ...'"
          />
          <Text1View>لطفا ایمیل خود را وارد کنید :</Text1View>
          <Input1View
            @ChangeDataEvent="changeemail"
            :name="'UserName'"
            :placehold="' ایمیل  ...'"
          />
          <Text1View>لطفا شماره همراه خود را وارد کنید :</Text1View>
          <Input1View
            @ChangeDataEvent="changephone"
            :name="'UserName'"
            :placehold="' شماره همراه  ...'"
          />
          <div class="row justify-content-center align-items-center">
            <GreenButton class="col-10 greenbtn" @click="submitRegister"
              >ورود به سامانه</GreenButton
            >
          </div>
        </div>
      </div>
      <div class="col-lg-5 col-12 row justify-content-center me-2 d-none d-lg-inline">
        <img src="../assets/Picture/LoginPic.svg" alt="" />
      </div>
    </div>
  </layer>
</template>

<script>
import layerComponent from "./Layers/LoginLayer.vue";
// import Title1View from "../components/public/Texts/GreenBigTitle.vue";
import Text1View from "../components/public/Texts/WhiteMediumText.vue";
import Input1View from "@/components/public/Inputs/Input1View.vue";
// import SelectBox from "@/components/LoginPage/SelectBox.vue";
import GreenButton from "@/components/public/Buttons/GreenButton.vue";
// import { uid } from "uid";
import { sendRequest } from "@/script/private/API-Request.js";
// import jsCookie from "js-cookie";
import router from "@/router";
import selectSchoolRegister from "@/components/Register/selectSchoolRegister.vue";
import selectClassRegisterVue from "@/components/Register/selectClassRegister.vue";

export default {
  components: {
    layer: layerComponent,
    // Title1View: Title1View,
    Text1View: Text1View,
    Input1View: Input1View,
    // SelectAccess: SelectBox,
    GreenButton: GreenButton,
    selectSchoolRegister: selectSchoolRegister,
    selectClassRegister: selectClassRegisterVue,
  },
  methods: {
    getSchoolToClass(access1) {
      console.log(access1);
      this.schoolID = access1;
    },
    changeUserName(text) {
      this.userName = text;
    },
    changePassword(text) {
      this.pass = text;
    },
    changefname(fname) {
      this.fname = fname;
    },
    changelname(lname) {
      this.lname = lname;
    },
    changeemail(email) {
      this.email = email;
    },
    changephone(phone) {
      this.phone = phone;
    },
    changclass_id(class_id) {
      this.class_id = class_id;
    },
    changeAccess(text) {
      this.access = text;
    },
    checkBeforeLogin() {
      let message = "Nothing";
      let isOk = true;
      if (!this.userName || this.userName == "") {
        message = "نام کاربری را وارد کنید";
        isOk = false;
      }
      if (!this.password || this.password == "") {
        message = "رمز عبور را وارد کنید";
        isOk = false;
      }
      if (!this.access || this.access == "") {
        message = "نوع حساب خود را انتخاب کنید";
        isOk = false;
      }
      return { message: message, correct: isOk };
    },
    changeToRoute(name) {
      router.push({ name: name });
    },
    async submitRegister() {
      const url = "http://localhost/api/api.php";
      const dataToSendForAPI = {
        type: "insertuser",
        fname: this.fname,
        lname: this.lname,
        uname: this.userName,
        pass: this.pass,
        email: this.email,
        phone: this.phone,
        location: "",
        address: "",
        class_id: this.class_id,
      };
      const response = await sendRequest(url, dataToSendForAPI);
      let responseText = await response.text();
      responseText = await JSON.parse(responseText);
      console.log(responseText);
      this.changeToRoute("Login");
    },
  },
  data() {
    return {
      password: "",
      userName: "",
      fname: "",
      lname: "",
      email: "",
      phone: "",
      access: "",
      class_id: "",
      schoolID: "",
    };
  },
};
</script>

<style scoped>
img {
  width: auto;
  height: 30.6875rem;
}
.select {
  margin-bottom: 2%;
  padding-right: 0;
}
.greenbtn {
  margin-top: 10%;
}
</style>
