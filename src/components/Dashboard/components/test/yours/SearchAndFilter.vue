<template>
  <div class="row align-items-center justify-content-center">
    <div class="col-lg-3">
      <label for="topic" class="form-label">کتاب</label>
      <select class="form-select" name="topic" id="">
        <option selected>Select one</option>
        <option value="">علوم</option>
        <option value="">فارسی</option>
        <option value="">ریاضی</option>
      </select>
    </div>
    <div class="col-lg-2">
      <label for="lesson" class="form-label">درس</label>
      <select class="form-select" name="lesson" id="">
        <option selected>Select one</option>
        <option value="">1</option>
        <option value="">2</option>
        <option value="">3</option>
      </select>
    </div>
    <div class="col-lg-2">
      <label for="topic" class="form-label">میزان سختی</label>
      <select class="form-select" name="topic" id="">
        <option selected>Select one</option>
        <option value="">ساده</option>
        <option value="">متوسط</option>
        <option value="">سخت</option>
      </select>
    </div>
    <!-- TODO : add a button to reverse sort -->
    <div class="col-lg-5">
      <p class="text-center mb-0">مرتب سازی بر اساس:</p>
      <div class="row align-items-center justify-content-center">
        <div class="col-3 row">
          <input class="checkbox" v-model="sort" type="radio" value="time" id="" />
          <label class="sorts" for="">زمان</label>
        </div>
        <div class="col-3 row">
          <input class="checkbox" v-model="sort" type="radio" value="topic" id="" />
          <label class="sorts" for="">کتاب</label>
        </div>
        <div class="col-3 row">
          <input class="checkbox" v-model="sort" type="radio" value="lesson" id="" />
          <label class="sorts" for="">درس</label>
        </div>
        <div class="col-3 row">
          <input class="checkbox" v-model="sort" type="radio" value="level" id="" />
          <label class="sorts" for="">سختی</label>
        </div>
      </div>
    </div>
    <div class="col-lg-7 row align-items-center justify-content-center">
      <div class="col-lg-3">
        <GreenButton
          class="mt-4"
          style="font-size: calc(15px + 0.2vw) !important; line-height: 200%"
        >
          اعمال کردن
        </GreenButton>
      </div>
    </div>
  </div>
</template>

<script>
import GreenButtonVue from "@/components/public/Buttons/GreenButton.vue";
export default {
  name: "SearchAndFilter",
  components: {
    GreenButton: GreenButtonVue,
  },
  data() {
    return {
      sort: [],
    };
  },
};
</script>

<style scoped>
* {
  font-family: graphik_medium;
  color: black;
}
label {
  text-align: center;
  width: 100%;
  font-family: graphik_medium;
}
.checkbox,
.sorts {
  width: min-content !important;
}
.sorts {
  padding-left: 0 !important;
}
</style>
