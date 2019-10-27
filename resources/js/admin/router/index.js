import Vue from 'vue';
import VueRouter from "vue-router";
Vue.use(VueRouter);

import Dashboard from "../pages/Dashboard";
import Settings from "../pages/Settings";


import CreateUser from '../pages/users/Create';
import BrowseUsers from "../pages/users/Browse";
import ViewUser from "../pages/users/View";
import EditUser from "../pages/users/Edit";

import CreateAdmin from '../pages/admins/Create';
import BrowseAdmins from "../pages/admins/Browse";
import ViewAdmin from "../pages/admins/View";
import EditAdmin from "../pages/admins/Edit";


const routes = [
  {
    path: '/',
    component: Dashboard
  },
  {
    path: '/settings',
    component: Settings
  },

  /**
   * Admins
   */

  {
    path: '/admins/create',
    component: CreateAdmin
  },
  {
    path: '/admins/browse',
    component: BrowseAdmins
  },
  {
    path: '/admins/:id/edit',
    component: EditAdmin,
    name: 'admin-edit'
  },
  {
    path: '/admins/:id',
    component: ViewAdmin,
    name: 'admin'
  },


  /**
   * Users
   */

  {
    path: '/users/create',
    component: CreateUser
  },
  {
    path: '/users/browse',
    component: BrowseUsers
  },
  {
    path: '/users/:id/edit',
    component: EditUser,
    name: 'user-edit'
  },
  {
    path: '/users/:id',
    component: ViewUser,
    name: 'user'
  },

];

export default new VueRouter({routes});