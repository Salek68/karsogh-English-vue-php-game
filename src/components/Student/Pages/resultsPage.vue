<template>
  <div class="col-lg-8 me-5 h-100vh justify-content-center">
    <div class="row">
      <div class="col-8 p-0 mt-4 justify-content-center align-items-center content">
        <resultCard v-for="(item,key) in quizes" :key="key" :sumScore="item['sumScore']" :teacher="item['adminName']" lessonNum="2" :lessonName="item['name']" :score="item['score']" />
      </div>
    </div>
    <div class="lastSection" v-if="this.dataSeted">

    </div>
  </div>
</template>

<script>
import { sendRequest } from "@/script/private/API-Request";
import jsCookie from "js-cookie";
// import Resultpage from "../components/quiz/result.vue";
import resultCard from "../components/quiz/resultCard.vue";
export default {
  components: {
    // Result: Resultpage,
    resultCard: resultCard,
  },
  mounted() {},
  async created() {
    await this.getQuizByApi();
  },

  data() {
    return {
      quizes: {
        type: Array,
      },
      dataSeted: false,
    };
  },
  methods: {
    async getQuizByApi() {
      const apiUrl = "http://localhost/api/api.php";
      let data = {
        type: "result",
        sid: jsCookie.get("userToken"),
      };
      let quizes = await sendRequest(apiUrl, data);
      quizes = await quizes.text();
      quizes = JSON.parse(quizes);
      this.quizes = quizes['data'];
    },
  },
};
</script>

<style scoped>
/* .lastSection {
  margin-top: 10%;
  height: min-content;
} */

.content {
  background-color: #242e42;
  border-radius: 20px;
  max-height: 80vh;
  overflow-y: scroll;
  margin-top: 4.3rem !important;
  height: 80vh;
  width: 66.6%;
  width: 100%;
}
</style>
