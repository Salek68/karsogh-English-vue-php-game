<template>
  <div class="body">
    <span class="blur"></span>
    <span class="blur"></span>
    <nav>
      <div class="nav-logo">
        <a href="#">
          <!-- <img src="../assets/pic/favicon.svg" /> -->
        </a>
      </div>

      <ul class="nav-links">
        <li class="link"><a href="#">معرفی</a></li>
        <li id="link1" class="link" @click="scrollToElement('selector')">
          <a href="#">مزایا</a>
        </li>
        <li id="link2" class="link"><a href="#">تعرفه ها</a></li>
        <li id="link3" class="link"><a href="#">درباره ما</a></li>
      </ul>
      <a href="#/login"><button class="btn-1">ورود به سامانه</button></a>
    </nav>

    <div class="title">
      <h1>آزمونیار پلتفرمی برای پیشرفت دانش آموزان و معلمان در سرتاسر کشور</h1>
      <span class="sub-title">
        طرح سوال، ساخت آزمون، نمونه سوالات آماده و هزاران قابلیت دیگر برای معلمان و دانش
        آموزان در این پلتفرم فراهم شده است.
      </span>
    </div>
    <div class="buttons row justify-content-center mt-4">
      <button class="btn-2 col-2">اطلاعات بیشتر</button>
      <a href="#/login" class="col-2"><button class="btn-1">ورود به سامانه</button></a>
    </div>
    <div class="sec-1 row justify-content-center">
      <img class="display" src="../assets/Picture/landing/display.svg" alt="" />
      <span class="blur-1 col-2"></span>
      <span class="blur-2 col-2"></span>
      <div class="nav-1 align-items-center row justify-content-center">
        <span class="banner-text-1 col-2 text-center"> آزمونیار</span>
        <span class="banner-text-2 col-2 text-center"> آزمونیار</span>
        <span class="banner-text-1 col-2 text-center"> آزمونیار</span>
        <span class="banner-text-2 col-2 text-center"> آزمونیار</span>
        <span class="banner-text-1 col-2 text-center"> آزمونیار</span>
        <span class="banner-text-2 col-2 text-center"> آزمونیار</span>
      </div>
    </div>
    <div class="sec-2 row justify-content-center p-3">
      <div class="col-4">
        <h3 class="text-white">با قابلیت های آزمونیار آشنا شوید :</h3>
        <div class="mt-5">
          <div class="row align-items-center mt-4">
            <div class="img-box col-1">
              <img
                src="../assets/Picture/landing/briefcase.svg"
                alt=""
                class="icon-atr"
              />
            </div>
            <div class="col text-white">
              <span>طرح سوال با قابلیت های مختلف</span>
            </div>
          </div>
          <div class="row align-items-center mt-4">
            <div class="img-box col-1">
              <img
                src="../assets/Picture/landing/briefcase.svg"
                alt=""
                class="icon-atr"
              />
            </div>
            <div class="col text-white">
              <span>ساخت آزمون و نمونه سوال با قابلیت های مختلف</span>
            </div>
          </div>
          <div class="row align-items-center mt-4">
            <div class="img-box col-1">
              <img
                src="../assets/Picture/landing/briefcase.svg"
                alt=""
                class="icon-atr"
              />
            </div>
            <div class="col text-white">
              <span>بیش از دو هزار سوال در دروس مختلف</span>
            </div>
          </div>
          <div class="row align-items-center mt-4">
            <div class="img-box col-1">
              <img
                src="../assets/Picture/landing/briefcase.svg"
                alt=""
                class="icon-atr"
              />
            </div>
            <div class="col text-white">
              <span>بیش از 500 آزمون و نمونه سوال آماده</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-4">
        <img
          src="../assets/Picture/landing/Decoration.svg"
          alt=""
          class="decrotion-image"
        />
        <img src="../assets/Picture/landing/view.svg" alt="" class="view-image" />
      </div>
    </div>

    <div class="sec-3 p-3 row text-center justify-content-center">
      <div class="text-center title-sec-3">
        <span class="text-white sec-3-title"> آزمونیار چیست؟ </span>
      </div>
      <div class="video-container mt-5">
        <!-- <video
          id="my-video"
          class="h-100"
          src="../assets/Picture/landing/test.mp4"
          controls
        ></video> -->
      </div>

      <div class="icons">
        <div class="icon-box">
          <div class="d-flex justify-content-center">
            <div class="icon-img">
              <img src="../assets/Picture/landing/spaceship.svg" alt="" />
            </div>
          </div>
          <h6>طراحی سوال</h6>
          <span>طراحی سوالات با قابلیت های متفاوت</span>
        </div>
        <div class="icon-box">
          <div class="d-flex justify-content-center">
            <div class="icon-img">
              <img src="../assets/Picture/landing/spaceship.svg" alt="" />
            </div>
          </div>
          <h6>ساخت آزمون</h6>
          <span>ساخت آزمون با قابلیت های متفاوت</span>
        </div>
        <div class="icon-box">
          <div class="d-flex justify-content-center">
            <div class="icon-img">
              <img src="../assets/Picture/landing/spaceship.svg" alt="" />
            </div>
          </div>
          <h6>دیدن سوالات دیگران</h6>
          <span>استفاده و </span>
        </div>
      </div>
    </div>
    <div class="free-vrs d-flex justify-content-center mt-5">
      <div class="free-box d-flex p-4 justify-content-between">
        <div class="free-info mr-5">
          <h2 class="text-white free-title">با نسخه رایگان ما شروع کنید!</h2>
          <span class="free-subtitle"
            >همه سوالات و آزمون ها را جستجو کنید. داشبورد شخصی خود را برای مادام العمر
            دریافت کنید.</span
          >

          <br />
          <div class="buttons-2 mt-5">
            <button class="btn-12">همین حالا شروع کنید</button>
            <button class="btn-2 mx-5">اطلاعات بیشتر</button>
          </div>
        </div>
        <img src="../assets/Picture/landing/person.svg" alt="" class="free-pic" />
      </div>
    </div>

    <div class="footer mt-5 row p-5">
      <div class="col">
        <div class="d-flex">
          <img src="../assets/Picture/landing/briefcase.svg" alt="" />
          <h2 class="text-white prj-name">آزمونیار </h2>
        </div>
        <div class="soc-img">
          <a href="#">
            <img src="../assets/Picture/landing/Linkedin.svg" alt="" />
          </a>

          <a href="#">
            <img src="../assets/Picture/landing/Linkedin.svg" alt="" />
          </a>

          <a href="#">
            <img src="../assets/Picture/landing/Linkedin.svg" alt="" />
          </a>
        </div>
      </div>
      <div class="col">
        <div class="row">
          <div class="col-6">
            <h5 class="text-white">محصولات</h5>
            <div class="row footer-link">
              <a href="#">لینک 1</a>
              <a href="#">لینک 2</a>
              <a href="#">لینک 3</a>
              <a href="#">لینک 4</a>
            </div>
          </div>
          <div class="col-6">
            <h5 class="text-white">خدمات</h5>
            <div class="row footer-link">
              <a href="#">لینک 1</a>
              <a href="#">لینک 2</a>
              <a href="#">لینک 3</a>
              <a href="#">لینک 4</a>
            </div>
          </div>
        </div>
      </div>
      <span dir="ltr" class="text-secondary copy-right">© 2024 TeamName</span>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    scrollToElement(elementSelector, instance = 0) {
      // Select all elements that match the given selector
      const elements = document.querySelectorAll(elementSelector);
      // Check if there are elements matching the selector and if the requested instance exists
      if (elements.length > instance) {
        // Scroll to the specified instance of the element
        elements[instance].scrollIntoView({ behavior: "smooth" });
      }
    },
  },
};
</script>

<style scoped>
* {
  font-family: graphik_medium;
}

.body {
  background-color: #051139;
  width: 100%;
  height: 100%;
}

nav {
  max-width: 1200px;
  margin: auto;
  padding: 2rem 1rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
}

.nav-logo {
  max-width: 8rem;
}

.nav-links {
  list-style: none;
  display: flex;
  align-items: center;
  gap: 3rem;
}

.link a {
  position: relative;
  padding-bottom: 0.5rem;
  color: #fff;
  text-decoration: none;
}

.link a::after {
  content: "";
  position: absolute;
  height: 3px;
  width: 0;
  bottom: 0;
  left: 0;
  background-color: #fff;
  transition: all 0.3s ease;
}

.link a:hover::after {
  width: 100%;
}

.btn-1 {
  padding: 0.5rem 1rem;
  font-size: 1rem;
  color: #fff;
  background-color: #6a65ff;
  border-radius: 10px;
  cursor: pointer;
  transition: all 0.3s ease;
  width: 12.5rem !important;
  z-index: 1;
  border-style: solid none;
}

.btn-12 {
  padding: 0.5rem 1rem;
  font-size: 1rem;
  color: black;
  background-color: white;
  border-radius: 10px;
  cursor: pointer;
  transition: all 0.3s ease;
  width: 12.5rem !important;
  border-style: none;
  z-index: 1;
}

.btn-2 {
  padding: 0.5rem 1rem;
  font-size: 1rem;
  color: #fff;
  background-color: transparent;
  border-color: #fff;
  border-radius: 10px;
  cursor: pointer;
  transition: all 0.3s ease;
  width: 12.5rem !important;
  z-index: 1;
}

.buttons {
  display: flex;
  gap: 5rem;
}

.title {
  color: #fff;
  width: 50vw;
  display: flex;
  flex-direction: column;
  text-align: center;
  margin-top: 5rem;
  margin-left: auto;
  margin-right: auto;
}

.sub-title {
  margin-top: 2rem;
}

.blur {
  position: absolute;
  box-shadow: 150px 50px 150px 50px #1e50ff;
  left: 0;
  margin-top: 12rem;
  margin-left: -10rem;
}

.blur-1 {
  position: absolute;
  box-shadow: 150px 200px 200px 200px #1e50ff;
  margin-top: -2rem !important;
}

.blur-2 {
  position: absolute;
  box-shadow: 400px 200px 400px 200px #9c08ff;
  margin-right: 70rem;
  margin-top: -2rem !important;
}

.display {
  width: 60rem;
  height: 60rem;
  z-index: 1;
  margin-right: 7.5rem;
  margin-top: -8rem;
}

.sec-1 {
  margin-top: 4rem !important;
  z-index: 0 !important;
}

.nav-1 {
  display: flex;
  background-color: #6a65ff;
  height: 4rem;
  margin-top: -13rem;
  z-index: 1000;
}

.banner-text-1,
.banner-text-2 {
  font-size: 1.9rem;
  margin-top: -2px;
}

.banner-text-1 {
  color: #fff;
}

.banner-text-2 {
  color: transparent;
  -webkit-text-stroke: 0.05rem #fff;
}

.view-image {
  height: 40rem;
  position: relative;
  z-index: 5;
}

.decrotion-image {
  margin-top: 7rem;
  margin-right: 25rem;
  position: absolute;
}

.icon-atr {
  height: 1.75rem;
}

.img-box {
  padding: 0.75rem;
  background-color: #6a65ff;
  width: fit-content;
  border-radius: 0.5rem;
}

.sec-3 {
  background-color: rgba(106, 101, 255, 0.08);
}

.sec-3-title {
  font-size: 2.5rem;
}

.title-sec-3 {
  margin-top: 1.75rem !important;
  width: 38rem;
}

#my-video {
  border-radius: 2rem;
  width: 50rem;
}

.icons {
  display: flex;
  flex-wrap: wrap;
  margin-top: 5rem !important;
}

.icon-box {
  flex: 0 0 calc(33.333% - 20px);
  margin: 0.6rem;
  margin-top: 2rem;
  box-sizing: border-box;
}

.icon-img {
  background-color: rgba(254, 220, 90, 0.1);
  width: fit-content;
  padding: 1rem;
  border-radius: 50%;
}
.icon-box h6,
span {
  text-align: center;
  color: white;
  margin-top: 1rem;
}

.button-1 {
  border-top-right-radius: 10px !important;
  border-bottom-right-radius: 10px !important;
  border-top-left-radius: 0px !important;
  border-bottom-left-radius: 0px !important;
}

.button-2 {
  border-top-right-radius: 0px !important;
  border-bottom-right-radius: 0px !important;
  border-top-left-radius: 10px !important;
  border-bottom-left-radius: 10px !important;
}

.plan {
  border: 1px solid #fff;
  border-radius: 26px;
  background-color: #0d1849;
}

.pric-plans {
  margin-top: 5rem !important;
  gap: 10rem !important;
}

.price-title {
  font-size: 2rem;
}

.icon-feature {
  margin-left: 1rem !important;
}

.features {
  padding: 0.5rem;
}

.feature {
  margin-bottom: 1.5rem;
}

.choose-plan {
  margin-top: 3rem;
  border-radius: 10px;
  color: #515def;
  width: 9.75rem;
  height: 3rem;
  font-size: 1rem;
}

.gold-plan {
  background-color: #515def;
}

.popular {
  padding: 0.75rem !important;
  background-color: #ffd88d;
  border: 3px solid white;
  font-size: 1rem;
  position: absolute;
  margin-top: -3rem;
  margin-right: -5rem;
  color: black;
  border-radius: 10rem;
  width: 10.5rem;
}

.free-box {
  background-color: #515def;
  width: 81rem;
  height: fit-content;
  border-radius: 25px;
}

.free-pic {
  height: 20rem;
}

.free-title {
  margin-right: 2rem !important;
  margin-top: 2rem !important;
  margin-bottom: 3rem !important;
}

.free-subtitle {
  margin-right: 2rem !important;
}

.buttons-2 {
  margin-right: 2rem;
}

.footer {
  background-color: #0d1849;
}

.prj-name {
  margin-right: 1rem !important;
}

.soc-img {
  margin-top: 3rem !important;
  margin-right: 2rem;
}

.soc-img a {
  margin-left: 1rem;
}

.copy-right {
  bottom: 0;
  margin-bottom: -3rem;
}

.footer-link a {
  text-decoration: none;
  color: white;
}

.footer-link {
  margin-right: 0.75rem !important;
  margin-top: 1rem !important;
  margin-bottom: 3rem !important;
}

.buttons a {
  z-index: 2;
}
</style>
