import Vue from 'vue'
import Router from 'vue-router'
import store from './store.js'

import Login from './pages/Login.vue'
import Home from './pages/Home.vue'
import Register from './pages/Register.vue'
import Checkout from './pages/Checkout.vue'

import ShopIndex from './pages/shop/Index.vue'
import Shop from './pages/shop/Shop.vue'

import UserIndex from './pages/user/Index.vue'
import Profile from './pages/user/Profile.vue'
import Wishlist from './pages/user/Wishlist.vue'
import Cart from './pages/user/Cart.vue'

Vue.use(Router)

const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: { requiresAuth: true }
        },
        {
          path: '/login',
          name: 'login',
          component: Login
        },
        {
          path: '/register',
          name: 'register',
          component: Register
        },
        {
            path: '/shop',
            component: ShopIndex,
            meta: { requiresAuth: true },
            children: [
                {
                    path: '',
                    name: 'shop',
                    component: Shop,
                    meta: { title: 'Shop' }
                },
                {
                    path: 'pilih-cabang/:id',
                    name: 'pilih_cabang',
                    component: Shop,
                    meta: { title: 'Pilih Cabang' }
                }
            ]
        },
        {
            path: '/user',
            component: UserIndex,
            meta: { requiresAuth: true },
            children: [
                {
                    path: '',
                    name: 'user',
                    component: Profile,
                    meta: {title: 'User Profile' }
                },
                {
                    path: 'wishlist',
                    name: 'wishlist',
                    component: Wishlist,
                    meta: { title: 'Wishlist' }
                },
                {
                    path: 'cart',
                    name: 'cart',
                    component: Cart,
                    meta: { title: 'Cart' }
                },
            ]
        },
        {
          path: '/checkout',
          name: 'checkout',
          component: Checkout,
          meta: { requiresAuth: true, title: 'Checkout' }
        },
    ]
});

router.beforeEach((to, from, next) => {
    store.commit('CLEAR_ERRORS')
    if (to.matched.some(record => record.meta.requiresAuth)) {
        let auth = store.getters.isAuth
        if (!auth) {
            next({ name: 'login' })
        } else {
            next()
        }
    } else {
        next()
    }
})

export default router;
