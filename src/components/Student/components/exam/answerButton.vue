<template>
  <button
    :class="'answer-text ' + this.classAdd"
    @click="$emit('clickedAns', this.itemid)"
    :name="name"
    :value="value"
  >
    {{ value }}
  </button>
</template>

<script>
// import func from 'vue-editor-bridge';
export default {
  name: "studentAnswerExamButton",
  props: {
    name: {
      type: String,
      default: "Button",
    },
    value: {
      type: String,
      default: "value",
    },
    itemid: Number,
    selected: Number,
  },
  watch:{
    selected(newval,oldval){
      console.log(newval,oldval);
      if (newval == this.itemid) {
        this.classAdd='bg-primary'
      }else{
        this.classAdd=''

      }
    }
  },
  methods: {
    test() {},
  },
  data() {
    return {
      classAdd: "",
    };
  },
};
</script>
<style scoped>
.answer-text {
  background-color: #fff;
  border: none;
  margin-bottom: 10px;
  height: 3.1rem;
  font-size: 1.1rem;
  padding: 10px 20px;
  border-radius: 15px;
  text-align: right;
  cursor: pointer;
  border: 2px solid #fff;
  transition: all 0.2s ease-in;
}

.answer-text:hover {
  background-color: #eeedfb;
  border: 2px solid #fff;
}
</style>
