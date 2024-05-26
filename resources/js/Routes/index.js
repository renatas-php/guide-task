import { createRouter, createWebHistory } from "vue-router";

const routes = [

];

const router = createRouter({
  history: createWebHistory(),
  linkActiveClass: "text-white",
  routes,
  scrollBehavior(to, from, savedPosition) {
      if (to.hash) {
        // This ensures that if hash is provided to router.push it works as expected.
        //  & since we have used "behavior: 'smooth'" the browser will slowly come to this hash position.
        return {
          el: to.hash,
          behavior: 'smooth',
        }
      }
    }
});

export default router;