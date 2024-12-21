import {createRouter, createWebHashHistory} from 'vue-router';

const routes = [
    {path:'', name:'home', component: ()=>import('@/view/admin/home.vue')},
    {path:'/login', name:'login', component: ()=>import('@/view/auth/login.vue')},
    {path:'/register', name:'register', component: ()=>import('@/view/auth/signup.vue')},
]

const router = createRouter({
    routes,
    history:createWebHashHistory()
})

export default router