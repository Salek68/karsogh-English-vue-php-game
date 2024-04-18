<template>
  <div class="col-8 row me-5 mt-4 justify-content-evenly" style="height: min-content">
    <div class="col-12 justify-content-center row">
      <h1 style="text-align: center">افزودن شرکت کنندگان آزمون</h1>
    </div>

    <div class="col-5 justify-content-center row box">
      <h5
        style="text-align: center; width: fit-content"
        v-if="!isSelectedClass"
        class="alert alert-warning"
      >
        ابتدا کلاس مورد نظر را انتخاب کنید
      </h5>

      <label for="class" class="form-label">کلاس :</label>
      <select
        style="height: min-content"
        class="form-select"
        @change="classSelectHandler"
        v-model="selectedClass"
        name="class"
      >
        <option value="Select one" selected>Select one</option>
        <option v-for="item in classList" :key="item['id']" :value="item['id']">
          {{ item["class name"] }}
        </option>
      </select>
    </div>
    <div class="col-5 row justify-content-center border-1 box">
      <label for="user" class="form-label">دانش آموز :</label>
      <select
        class="form-select"
        v-model="selectedUser"
        :disabled="!isSelectedClass || allClassStudents"
        name="user"
      >
        <option value="Select one" selected>Select one</option>
        <option v-for="item in userList" :key="item['id']" :value="item['id']">
          {{ item["fname"] + " " + item["lname"] + " - " + item["name"] }}
        </option>
      </select>
      <br />
      <input
        type="checkbox"
        v-model="allClassStudents"
        :disabled="!isSelectedClass"
        style="width: fit-content"
      />
      <label style="width: fit-content"> تمام کلاس افزوده شود </label>
      <GreenButton class="mt-3" @click="addUsersToTest">افزودن</GreenButton>
    </div>
    <div class="col-5">
      <p>کلاس های موجود در این آزمون:</p>
      <ul>
        <li v-for="(item, key) in getedClass" :key="key">{{ item["name"] }}</li>
      </ul>
    </div>
    <div class="col-5">
      <p>دانش آموزان موجود در این آزمون:</p>
      <ul>
        <li v-for="(item, key) in getedUsers" :key="key">{{ item["name"] }}</li>
      </ul>
    </div>
    <GreenButton @click="changeToRoute('yourTests')" style="width: 30%;">پایان </GreenButton>
  </div>
</template>

<script>
import GreenButtonVue from "@/components/public/Buttons/GreenButton.vue";
import { sendRequest } from "@/script/private/API-Request";
import jsCookie from "js-cookie";
import router from '@/router';

export default {
  components: {
    GreenButton: GreenButtonVue,
  },
  created() {
    this.getClassList();
    this.getAddedInQuiz();
    // this.getUserList();
  },
  methods: {
    addStudent() {
      console.log(this.selectedUser);
    },
    classSelectHandler() {
      if (this.selectedClass == "Select one") {
        this.isSelectedClass = false;
      } else {
        this.isSelectedClass = true;
        this.getUserList();
      }
    },
    async getClassList() {
      console.log(this.addedUsers.length);
      const apiUrl = "http://localhost/api/api.php";
      const data = {
        type: "classList",
        sid: jsCookie.get("userToken"),
      };
      let response = await sendRequest(apiUrl, data);
      let responseBody = await response.text();
      let jsonData = await JSON.parse(responseBody);
      this.classList = await jsonData["classlist"];
      console.log(this.classList);
    },
    async getUserList() {
      const apiUrl = "http://localhost/api/api.php";
      const data = {
        type: "studentList",
        sid: jsCookie.get("userToken"),
        classId: this.selectedClass,
      };
      let response = await sendRequest(apiUrl, data);
      let responseBody = await response.text();
      let jsonData = await JSON.parse(responseBody);
      this.userList = await jsonData["userList"];
      console.log(this.userList);
    },
    async getAddedInQuiz() {
      const apiUrl = "http://localhost/api/api.php";
      const data = {
        type: "getUsersToTest",
        sid: jsCookie.get("userToken"),
        quiz_id: this.$route.params.id,
      };
      // {
      //     "type": "getUsersToTest",
      //     "sid": "c6f856999a91b0f6",
      //     "quiz_id": 110
      // }
      const response = await sendRequest(apiUrl, data);
      const responseBody = await response.text();
      const jsonData = JSON.parse(responseBody);
      console.log(jsonData);
      this.getedClass = jsonData["class"];
      this.getedUsers = jsonData["users"];
      console.log("aaaaaaaaaa" + JSON.stringify(this.getedUsers));
    },
    async addUsersToTest() {
      const apiUrl = "http://localhost/api/api.php";
      let dataType = "";
      let data = {
        type: "addUsersToTest",
        sid: jsCookie.get("userToken"),
        quiz_id: this.$route.params.id,
      };
      if (this.allClassStudents) {
        dataType = "class";
        data["class"] = this.selectedClass;
      } else {
        dataType = "student";
        data["student"] = this.selectedUser;
      }
      data["dataType"] = dataType;
      const response = await sendRequest(apiUrl, data);
      const responseBody = await response.text();
      const jsonData = JSON.parse(responseBody);
      console.log(jsonData);
      this.getAddedInQuiz();
    },  changeToRoute(name) {
      router.push({ name: name });
    },
  },
  data() {
    return {
      classList: null,
      userList: null,
      addedUsers: Array,
      selectedUser: "Select one",
      selectedClass: "Select one",
      isSelectedClass: false,
      allClassStudents: false,
      getedUsers: Array,
      getedClass: Array,
    };
  },
};
</script>

<style scoped>
p {
  color: black;
}
.box {
  border: 1px solid black;
  border-radius: 10px;
  padding: 2%;
}
li {
  list-style-type: decimal;
}
</style>
