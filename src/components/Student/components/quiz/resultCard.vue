<template>
  <div class="main">
    <div class="score">
      <h1>نمره ی آزمون شما:</h1>
      <p :value="value">{{ score }}</p>
    </div>
    <div class="informations">
      <div class="rowInformation">
        <div class="examInformations">
          <h5 class="extraInformations">
            نام آزمون :
            <h5>{{ lessonName }}</h5>
          </h5>
        </div>
        <div class="examInformations">
          <h5 class="extraInformations">
            معلم :
            <h5 :teacher="teacher">{{ teacher }}</h5>
          </h5>
        </div>
      </div>
      <div class="rowInformation">
        <!-- <div class="examInformations">
          <h5 class="extraInformations">
            تاریخ آزمون :
            <h5>24/10/11</h5>
          </h5>
        </div> -->
        <!-- <div class="examInformations">
          <h5 class="extraInformations">
            فصل :
            <h5 :lessonNum="lessonNum">{{ lessonNum }}</h5>
          </h5>
        </div> -->
      </div>
      <div class="progress">
        <div
          class="progress-bar progress-bar-striped bg-warning"
          role="progressbar"
          :style="'width:' + this.processed + '%'"
          aria-valuenow="75"
          aria-valuemin="0"
          aria-valuemax="100"
        ></div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.score {
  display: flex;
  flex-direction: column;
}
.main {
  width: 95%;
  height: 40%;
  margin-top: 2%;
  margin-right: 2.6%;
  border-radius: 22px;
  background-color: brown;
  text-align: center;
  color: var(--white-color);
  padding: 5px;
}

.rowInformation {
  gap: 53%;
  display: flex;
  margin-right: 10%;
}

.rowInformation:first-child {
  gap: 59.5%;
}

.informations {
  margin-top: -4.9%;
}

.examInformations {
  display: flex;
  gap: 0.5%;
}

p {
  font-size: 2rem;
}

.extraInformations {
  /* display: flex;
  flex-direction: row;
  width: 10%;
  gap: 0.5rem; */
}

</style>

<script>
export default {
  name: "resultCard",
  created() {
    console.log(this.processed);
    this.processed = (this.score * 100) / this.sumScore;
    console.log(this.processed);
  },
  watch: {
    score(newval) {
      this.processed = (newval * 100) / this.sumScore;
      console.log(this.processed);
    },
  },
  props: {
    lessonName: {
      type: String,
      default: "value",
    },
    lessonNum: {
      type: String,
      default: "value",
    },
    score: {
      type: String,
      default: "value",
    },
    teacher: {
      type: String,
      default: "value",
    },
    sumScore: Number,
  },
  data() {
    return {
      processed: Number,
    };
  },
};
</script>
