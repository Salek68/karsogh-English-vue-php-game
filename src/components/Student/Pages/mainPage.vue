<template>
  <div class="col-lg-8 me-5 h-100vh justify-content-center layout">
    <div class="col-lg-8  h-100vh justify-content-center detail" >
      <img style=" margin-top: 0.1rem; margin-right: 1rem;" class="icon rounded" :src="require(`@/assets/Picture/dashboard/dashboard.svg`)" alt=""  /><span style="margin-right: 1.3rem; margin-top: 0.5rem !important; line-height: 67px;">{{ this.nameuser }}</span>
      <span style="float: left; margin-left: 1rem;">      <img style=" margin-top: 0.1rem; margin-right: 1rem; width: 50px; height: 50px;" class="icon rounded" :src="require(`@/assets/Picture/dashboard/water_drop_icon_175805.png`)" alt=""  /><span style="margin-right: 1.3rem; margin-top: 0.5rem !important; line-height: 67px;">{{ this.emtyaz }}</span>
    <img style=" margin-top: 0.1rem; margin-right: 1rem; width: 50px; height: 50px;" class="icon rounded" :src="require(`@/assets/Picture/dashboard/MacFamilyTree_30181 (1).png`)" alt=""  /><span style="margin-right: 1.3rem; margin-top: 0.5rem !important; line-height: 67px;">{{ this.marhale }}</span>

</span>    <span style="margin-right: 17rem;">سلام  <b style="font-weight: bold !important; color: #eee;">{{ this.nameuser }}</b> به سامانه ی ما خوش آمدید</span>

    </div>
    <div  class="col-lg-8  h-100vh justify-content-center" >

    
     <img class="imger" v-if="marhaled()"  :src="require(`@/assets/Picture/dashboard/marhale2.jpg`)">
     <img  class="imger"  v-if="marhales()" :src="require(`@/assets/Picture/dashboard/marhale3.jpg`)">
     <img   class="imger"  v-if="marhalec()" :src="require(`@/assets/Picture/dashboard/marhale4.jpg`)">
     <img  class="imger"  v-if="marhaley()" :src="require(`@/assets/Picture/dashboard/marhale1.jpg`)">
<br>   
<span  style="margin-right: 19rem;margin-top:1rem;line-height: 4rem;">
<span>شما برای رفتن به مرحله {{Number(this.marhale) +1 }}  &nbsp; </span>

<span>به &nbsp; {{ this.nyaz }} &nbsp; سکه نیاز دارید</span></span>
<GreenButton  v-if="emtyazy()" @click="nextmarhale()" :name="next" :value="'next marhale'" style="  width: 7rem;margin-right: 10rem;margin-top: 1rem;"></GreenButton>

    </div>
  
    <!-- <h5>
      شما میتوانید با کلیک کردن بر روی آیتم های پنل از امکانات سامانه استفاده
      کنید.
    </h5> -->

  </div>
</template>

<script>
import { sendRequest } from "@/script/private/API-Request";
import Button1View from "@/components/public/Buttons/Button1View.vue";
import jsCookie from "js-cookie";
export default {
  components: {
    // Result: Resultpage,
    GreenButton: Button1View,
  },
  name: "mainPageStudent",
  mounted() {},
  async created() {
    await this.getname();
    await this.getemtyaz();
    await this.getemarhale();

  },
  data() {
    return {
   
      nameuser : "",
      emtyaz : 0,
      marhale : 1,
      nyaz : 17,
     
    };
  },
  methods: {
   
    async getname() {
      const apiUrl = "http://localhost/api/api.php";
      let data = {
        type: "checktoken",
 
        sid: jsCookie.get("userToken"),
     
      };
      let nameu = await sendRequest(apiUrl, data);
      nameu = await nameu.text();
      nameu = JSON.parse(nameu);
      
      this.nameuser = nameu["mess"]["name"];

    },
    async getemtyaz() {
      const apiUrl = "http://localhost/api/api.php";
      let data = {
        type: "emtyaz",
 
        sid: jsCookie.get("userToken"),
     
      };
      let emtyazz = await sendRequest(apiUrl, data);
      emtyazz = await emtyazz.text();
      emtyazz = JSON.parse(emtyazz);
      
      this.emtyaz = emtyazz[0]["emtyaz"];

    },
    async nextmarhale() {
      const apiUrl = "http://localhost/api/api.php";
      let data = {
        type: "nextmarhale",
 
        sid: jsCookie.get("userToken"),
        score:this.nyaz,
     
      };
      await sendRequest(apiUrl, data);
      this.$router.go(0)

    },
    async getemarhale() {
      const apiUrl = "http://localhost/api/api.php";
      let data = {
        type: "marhale",
 
        sid: jsCookie.get("userToken"),
     
      };
      let emtyazz = await sendRequest(apiUrl, data);
      emtyazz = await emtyazz.text();
      emtyazz = JSON.parse(emtyazz);
      
      this.marhale = emtyazz[0]["marhale"];
if(this.marhale == "2"){
  this.nyaz = 35
  
}
if(this.marhale == "3"){
  this.nyaz = 51
}
if(this.marhale == "4"){
  this.nyaz = 100
}
    },
    marhaley(){
if( this.marhale == 1){
return true
}

    },
    marhaled(){
if( this.marhale == 2){
return true
}
else{
  return false
}
    },
    marhales(){
if( this.marhale == 3){
return true
}

    },
    marhalec(){
if( this.marhale == 4){
return true
}
    },
    emtyazy(){
if( this.emtyaz >= this.nyaz ){
return true
}
else{
  return false
}

    },
  
  
  },
};
</script>

<style scoped>
.detail{
  background: #42557a;
    width: 102.5%;
    height: 2.8rem;
    margin-right: -0.75rem;
    /* margin-top: 0.0rem; */
    border-radius: 20px 20px 0 0;
}
  .imger{

    width: 50.5%;
    height: 21.2rem;
    margin-right: 20rem;
    margin-top: 0.75rem;
    border-radius: 20px 20px 20px 20px;

  }
.layout {

  height: 80vh;
  border-radius: 20px;
  margin-top: 4.5rem !important;
  background-color: #242e42;
  color: var(--white-color);
}

h1 {
  font-family: "graphik_bold";
  margin-top: 12.55rem !important;
  font-size: 3rem !important;
  text-align: center;
  color: var(--white-color) !important;
}

h5 {
  font-family: "graphik_medium";
  margin-top: 3.125rem !important;
  text-align: center;
  color: var(--white-color) !important;
}
</style>

