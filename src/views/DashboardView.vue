<template>
  <div class="main pe-5">
    <div class="row menubar">
      <menuBtn
        @clicked="
          (btn, menu) => {
            show_menubar = menu;
            show_button = btn;
          }
        "
        :showProp="show_button"
      />
      <div
        class="col-4 col-md-3 p-3 ms-lg-5 position-fixed h-100vh d-flex align-items-center"
        id="mainmenu"
      >
        <rightPanel v-if="show_menubar" class="rightPanel">
          <GreenButton v-if="!screenIsBig" class="" @click="toggleShow">-</GreenButton>
          <optionPanel
            :img="require(`@/assets/Picture/dashboard/dashboard.svg`)"
            :text="'داشبورد'"
            @click="changeToRoute('DashboardMain')"
          />
          <optionPanel
            :img="require(`@/assets/Picture/dashboard/quiz.svg`)"
            :text="'آزمون های شما'"
            @click="changeToRoute('DashboardMainTests')"
          />
          <optionPanel
            :img="require(`@/assets/Picture/dashboard/paperPen.svg`)"
            :text="'افزودن آزمون'"
            @click="changeToRoute('addTest')"
          />
          <!-- <optionPanel
            :img="require(`@/assets/Picture/dashboard/book.svg`)"
            :text="'بانک سوالات'"
          /> -->
          <!-- <optionPanel
            :img="require(`@/assets/Picture/dashboard/school.svg`)"
            :text="'مدرسه شما'"
          /> -->
          <!-- <optionPanel
            :img="require(`@/assets/Picture/dashboard/avatar.svg`)"
            :text="'پروفایل کاربری'"
          /> -->
          <!-- @click="changeToRoute('adminProfile')" -->
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
import GreenButton from "@/components/public/Buttons/GreenButton.vue";
import router from "@/router";
import menuButtonVue from "@/components/public/Buttons/menuButton.vue";
import jsCookie from "js-cookie";

export default {
  name: "DashboardVue",
  data() {
    return {
      show_button: true,
      show_menubar: false,
      screenIsBig: false,
    };
  },
  mounted() {
    this.clienttest();
    window.addEventListener("resize", this.clienttest);
  },
  components: {
    rightPanel: rightPanelvue,
    optionPanel: optionInPanelVue,
    GreenButton: GreenButton,
    menuBtn: menuButtonVue,
  },
  methods: {
    changeToRoute(name) {
      router.push({ name: name });
    },
    exit() {
      jsCookie.remove("userToken");
      this.changeToRoute("Root");
    },
    toggleShow() {
      this.show_button = !this.show_button;
      this.show_menubar = !this.show_menubar;
      // element.classList.remove('col-sm-12');
      // element.classList.add('col-sm-8');
    },
    async clienttest() {
      if (window.innerWidth >= 1000) {
        this.show_button = false;
        this.show_menubar = true;
        let mainmenu = await document.getElementById("mainmenu");
        console.log(mainmenu);
        // mainmenu.style.setProperty("display", "block", "important");
        mainmenu.style.setProperty("position", "relative", "important");
        this.screenIsBig = true;
      } else {
        this.screenIsBig = false;

        this.show_button = true;
        this.show_menubar = false;
      }
    },
  },
};
</script>

<style scoped>
p {
  color: var(--white-color);
  font-size: calc(15px + 0.2vw);
  font-style: normal;
  font-weight: 500;
  line-height: 3rem;
  letter-spacing: -0.01875rem;
  text-transform: capitalize;
}
.menubar {
  z-index: 10;
}
.rightPanel {
  height: 80vh;
  width: 100%;
  overflow: auto;
}
.h-100vh {
  height: 100vh;
}
.main {
  background: url(../assets/Picture/AmirKabir-back.jpg) no-repeat;
  background-size: cover;
  height: 100vh;
  width: 100vw;
}
.space {
  background: var(--light-blue-color);
  margin-right: auto;
  margin-left: auto;
  height: 2px;
  width: 95%;
  border-radius: 50px;
  margin: 7% auto;
}
</style>
