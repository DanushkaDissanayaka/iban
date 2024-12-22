import {createRouter, createWebHashHistory} from 'vue-router';

const routes = [
    {
        path:'', 
        name:'home', 
        component: ()=>import('@/view/auth/login.vue'),
        meta:{
            requiresNavbar: false
        }
    },
    {
        path:'/login', 
        name:'login',
        component: ()=>import('@/view/auth/login.vue'),
        meta:{
            requiresNavbar: false
        }
    },
    {
        path:'/register',
        name:'register',
        component: ()=>import('@/view/auth/signup.vue'),
        meta:{
            requiresNavbar: false
        }
    },
    {
        path:'/user/home',
        name:'user-home',
        component: ()=>import('@/view/user/home.vue'),
        meta:{
            requiresNavbar: true
        }
    },
    {
        path:'/admin/home',
        name:'admin-home',
        component: ()=>import('@/view/admin/home.vue'),
        meta:{
            requiresNavbar: true
        }
    },
]

const router = createRouter({
    routes,
    history:createWebHashHistory()
})

export default router