import { createRouter, createWebHistory } from "vue-router";
import Login from "../Pages/Login1.vue";
import Dashboard from "../Pages/Dashboard.vue";
import PegawaiIndex from "../Pages/Pegawai/Index.vue";
import PegawaiCreate from "../Pages/Pegawai/Create.vue";

const routes = [
  { path: "/login", component: Login },
  { path: "/dashboard", component: Dashboard, meta: { requiresAuth: true } },
  { path: "/pegawai/index", component: PegawaiIndex },
  { path: "/pegawai/create", component: PegawaiCreate },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  // Navigation guard to check for authentication
  beforeEach(to, from, next) {
    console.log("Navigating to:", to.path);
    console.log("Token present:", localStorage.getItem("token"));
    if (to.meta.requiresAuth && !localStorage.getItem("token")) {
      next({ path: "/login" });
    } else {
      next();
    }
  },
});

export default router;
