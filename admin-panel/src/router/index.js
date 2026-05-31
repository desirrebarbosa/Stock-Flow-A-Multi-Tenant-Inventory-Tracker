import { createRouter, createWebHistory} from 'vue-router';
import LoginView from '../views/LoginView.vue';
import DashboardView from '../views/DashboardView.vue';

const routes = [
    { path: '/login', component: LoginView},
    {path: '/', component: LoginView },
    { 
        path: '/dashboard', 
        component: DashboardView,
        meta: { requiresAuth: true} 
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

router.beforeEach((to, from) => {
    if (to.meta.requiresAuth && !localStorage.getItem('auth_token')) {
        return '/login';
    } 
    return true;
});

export default router;