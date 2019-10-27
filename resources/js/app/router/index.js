import Vue from 'vue';
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from "../pages/Home";
import Login from "../pages/auth/Login";
import Register from "../pages/auth/Register";
import Profile from "../pages/Profile";

const routes = [
  {
    path: '/',
    component: Home
  },
  {
    path: '/auth/login',
    component: Login
  },
  {
    path: '/auth/register',
    component: Register
  },
  {
    path: '/profile',
    component: Profile
  },


];

export default new VueRouter({routes});