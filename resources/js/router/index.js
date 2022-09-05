
import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';
import Tailors from '../pages/Tailors';
import Customers from '../pages/Customers';
import Cloths from '../pages/Cloths';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'tailors',
        path: '/tailors',
        component: Tailors
    },
    {
        name: 'cloths',
        path: '/cloths',
        component: Cloths
    },
    {
        name: 'customers',
        path: '/customers',
        component: Customers
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
