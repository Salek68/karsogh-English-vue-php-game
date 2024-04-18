<template>
  <div class="main" style="">
    <div class="row">
      <div class="col-lg-3 h-100vh d-flex align-items-center">
        <rightPanel class="rightPanel">
          <optionPanel
            :img="require(`@/assets/Picture/dashboard/dashboard.svg`)"
            :text="'داشبورد'"
            @click="changeToRoute('mainStudent')"
          />
          <optionPanel
            :img="require(`@/assets/Picture/dashboard/quiz.svg`)"
            :text="'آزمون های در دسترس'"
            @click="changeToRoute('quizListStudent')"
          />
          <optionPanel
            :img="require(`@/assets/Picture/dashboard/paperPen.svg`)"
            :text="'نتایج'"
            @click="changeToRoute('resultPageuser')"
          />
          <!-- <optionPanel
            :img="require(`@/assets/Picture/dashboard/book.svg`)"
            :text="'بانک سوالات'"
          /> -->
          <!-- <optionPanel
            :img="require(`@/assets/Picture/dashboard/school.svg`)"
            :text="'مدرسه شما'"
          />  -->
          <!-- <optionPanel
            :img="require(`@/assets/Picture/dashboard/avatar.svg`)"
            :text="'پروفایل کاربری'"
          /> -->
            <!-- @click="changeToRoute('studentProfilePage')" -->
          <div class="space"></div>
          <optionPanel
            class="exit"
            :img="require(`@/assets/Picture/dashboard/exit.svg`)"
            :text="'خروج از سامانه'"
            @click="exit"
          />
        </rightPanel>
      </div>

      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import rightPanelvue from "@/components/Dashboard/menu/rightPanel.vue";
import optionInPanelVue from "@/components/Dashboard/menu/optionInPanel.vue";
import router from "@/router";
import jsCookie from 'js-cookie';

export default {
  name: "DashboardVue",
  components: {
    rightPanel: rightPanelvue,
    optionPanel: optionInPanelVue,
  },
  methods: {
    changeToRoute(name) {
      router.push({ name: name });
    },  exit() {
      jsCookie.remove("userToken");
      this.changeToRoute("Root");
    },
  },
};
</script>
<style scoped>
.rightPanel {
  height: 80vh;
  width: 100%;
  overflow: auto;
  margin-right: 5%;
}
.h-100vh {
  height: 100vh;
}
.main {
  background-color: var(--light-gray-color);
  height: 100vh;
  width: 100vw;
}
.space {
  background: var(--light-blue-color);
  margin-right: auto;
  margin-left: auto;
  height: 2px;
  width: 70%;
  border-radius: 50px;
  margin: 7% auto;
}
</style>
