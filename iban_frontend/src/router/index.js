import {createRouter, createWebHashHistory} from 'vue-router';

const routes = [
    {
        path:'', 
        name:'home', 
        component: ()=>import('@/view/auth/login.vue')
    },
    {
        path:'/login', 
        name:'login',
        component: ()=>import('@/view/auth/login.vue')
    },
    {
        path:'/register',
        name:'register',
        component: ()=>import('@/view/auth/signup.vue')
    },
    {
        path:'/user/home',
        name:'user-home',
        component: ()=>import('@/view/user/home.vue'),
        meta:{
            requiresAuth: true
        }
    },
    {
        path:'/admin/home',
        name:'admin-home',
        component: ()=>import('@/view/admin/home.vue')
    },
]

const router = createRouter({
    routes,
    history:createWebHashHistory()
})

export default router