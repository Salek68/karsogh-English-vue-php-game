<template>
  <div>
    <GreenButton
      v-if="showProp"
      class=""
      @click="
        toggleShow();
        $emit('clicked', show_button, show_menubar);
      "
      >Open menu</GreenButton
    >
  </div>
</template>

<script>
import GreenButtonVue from "./GreenButton.vue";

export default {
  methods: {
    toggleShow() {
      this.show_button = !this.show_button;
      this.show_menubar = !this.show_menubar;
    },
  },
  components: {
    GreenButton: GreenButtonVue,
  },
  data() {
    return {
      show_button: true,
      show_menubar: false,
    };
  },
  props: {
    showProp: { type: Boolean },
  },
};
</script>

<style scoped></style>
