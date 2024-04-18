import { createRouter, createWebHashHistory } from 'vue-router'
// Main views
import RootView from '../views/RootView.vue'
import LoginView from '../views/LoginView.vue'
import NotFoundView from '../views/NotFoundView.vue'
import PostView from '../views/PostView.vue'
import CategoryView from '../views/CategoryView.vue'
import DashboardView from '../views/DashboardView.vue'
import StudentView from '../views/StudentView.vue'
import RegisterView from '../views/RegisterView.vue'

// Admin Pages
import mainPanelAdmin from '@/components/Dashboard/Pages/main.vue'
import YourTestsVue from '@/components/Dashboard/Pages/YourTests.vue'
import AddTestVue from '@/components/Dashboard/Pages/AddTest.vue'
import AddQuestionTestVue from '@/components/Dashboard/Pages/AddQuestionTest.vue'
import profileVue from '@/components/Dashboard/Pages/Profile.vue'
import AddStudentsToTest from '@/components/Dashboard/Pages/AddStudentsToTest.vue'
import automateTest from '@/components/Dashboard/Pages/automateTest.vue'
// Student Pages
import mainPageStudent from '@/components/Student/Pages/mainPage.vue'
import quizPageStudent from '@/components/Student/Pages/quizePage.vue'
import studentProfilePage from '@/components/Student/Pages/profile.vue'
import studentExamPage from '@/components/Student/Pages/examPage.vue'
import resultPageuser from '@/components/Student/Pages/resultsPage.vue'
// import Cookies from 'js-cookie'
// import { sendRequest } from '@/script/private/API-Request'
// const apiUrl = "http://localhost/api/api.php"
const routes = [
  {
    path: '/',
    name: 'Root',
    component: RootView
  },
  {
    path: '/Login',
    name: 'Login',
    component: LoginView
  },
  {
    path: '/Register',
    name: 'Register',
    component: RegisterView
  },
  {
    path: '/404',
    name: 'NotFound',
    component: NotFoundView
  },
  {
    path: '/News',
    name: 'News',
    component: PostView
  },
  {
    path: '/Category',
    name: 'Category',
    component: CategoryView
  }, {
    name: "studentExamPage",
    path: "/student/exam-page/:id",
    component: studentExamPage
  },
  {
    path: '/student',
    name: 'student',
    component: StudentView,
    children: [
      {
        name: "mainStudent",
        path: "",
        component: mainPageStudent
      }, {
        name: "quizListStudent",
        path: "quiz-list",
        component: quizPageStudent
      },
      {
        name: "resultPageuser",
        path: "results-quiz",
        component: resultPageuser
      }, {
        name: "studentProfilePage",
        path: "profile",
        component: studentProfilePage
      },
    ]
  }, {
    path: '/admin',
    name: 'Dashboard',
    component: DashboardView,
    //  beforeEnter: async (to, from, next) => {
    //   const userToken = Cookies.get("userToken")
    //   const response = await sendRequest(apiUrl, {
    //     "type": "loginornot",
    //     "sid": userToken
    //   })
    //   let responseData = await response.text()
    //   responseData = JSON.parse(responseData)
    //   if (!((["اطلاعات کاربری"][0]) in responseData)) {
    //     next('/Login');
    //   } else {
    //     if (["school_id"] in responseData["اطلاعات کاربری"][0]) {
    //       //  this mean user is a dabir or a modir
    //       next();
    //     } else {
    //       next('/student')
    //     }
    //   }
    // },
    children: [
      {
        path: "",
        name:"mainPanelAdmin",
        component: mainPanelAdmin
      },{
        path: "/",
        component: mainPanelAdmin
      }, {
        name: "DashboardMain",
        path: "main",
        component: mainPanelAdmin
      }, {
        path: "profile",
        name: "adminProfile",
        component: profileVue
      }, {
        name:'yourTests',
        path: "tests/yours",
        component: YourTestsVue
      }, {
        name: "DashboardMainTests",
        path: "tests/",
        component: YourTestsVue
      }, {
        name: "addTest",
        path: "tests/new",
        component: AddTestVue
      }, {
        name: "addTest2",
        path: "tests/new/:id/2",
        component: AddQuestionTestVue
      }, {
        name: "addTest3",
        path: "tests/new/:id/3",
        component: AddStudentsToTest
      },{
        name: "wizardTest",
        path: "tests/new/:id/Wizard",
        component: automateTest
      },


    ]
  },

]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
