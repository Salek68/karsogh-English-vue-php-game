<template>
  <router-view />
</template>

<style lang="scss">
@font-face {
  font-family: "graphik_bold";
  src: url("@/assets/font/Dana-Bold.ttf");
}
@font-face {
  font-family: "graphik_medium";
  src: url("@/assets/font/Dana-Medium.ttf");
}
@font-face {
  font-family: "graphik_light";
  src: url("@/assets/font/Dana-Bold.ttf");
}
:root {
  --dark-clay-color: #242e42;
  --lighten-clay-color: #2f3b52;
  --gray-blue-color: #657d95;
  --light-green-color: #00ae8a;
  --dark-green-color: #038269;
  --light-blue-color: #97fcff;
  --white-color: #ffffff;
  --light-gray-color: #d9d9d9;
}p {
  color: var(--white-color);
  font-size: calc(15px + 0.2vw);
  font-style: normal;
  font-weight: 500;
   line-height: 3rem;/* 240% */
  letter-spacing: -0.01875rem;
  text-transform: capitalize;
}
.graphik_bold {
  font-family: "graphik_bold";
}
.graphik_medium {
  font-family: "graphik_medium";
}
*{
  font-family: graphik_medium;
}
@import "@/styles/app/prefix.css";
</style>
