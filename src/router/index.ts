import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/views/home.vue';
import Cart from '@/views/car.vue';
import Produce from '@/views/produce.vue'
import About from '@/views/about.vue'
import HomeIntroduce from '@/views/homeIntroduce.vue'


const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
    children:[
      {path: '', name: 'HomeIntroduce', component: HomeIntroduce},
      {path: 'cart', name: 'Cart', component: Cart},
      {path: 'produce', name: 'produce', component: Produce},
      {path: 'about', name: 'about', component: About}
    ]
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;