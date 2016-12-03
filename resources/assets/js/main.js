import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'


Vue.use(VueRouter)

Vue.use(VueResource)

/* eslint-disable no-new */

var router = new VueRouter({
    history: true,
    root: 'dashboard'
})


router.map({
    '/home': {
        component: require('./components/Home.vue')
    },
    //post
    '/posts/': {
        name: 'posts',
        component: require('./components/post/Posts.vue')
    },
    '/posts/:hashid/edit': {
        name: 'editpost',
        component: require('./components/post/Editpost.vue')
    },
    '/posts/categories/:hashid': {
        name: 'postincats',
        component: require('./components/post/Posts.vue')
    },
    //admin
    '/admin/': {
        name: 'admins',
        component: require('./components/admin/Admins.vue')
    },
    '/admin/:hashid/edit': {
        name: 'editadmins',
        component: require('./components/admin/Editadmin.vue')
    },
    '/admin/create': {
        name: 'createadmins',
        component: require('./components/admin/Createadmin.vue')
    },
    //users
    '/users/': {
        name: 'user',
        component: require('./components/user/Users.vue')
    },
    '/users/:hashid/edit': {
        name: 'editusers',
        component: require('./components/user/Edituser.vue')
    },
    '/users/create': {
        name: 'createuser',
        component: require('./components/user/Createuser.vue')
    },
    //layout
    '/profile': {
        name:'edituser',
        component: require('./components/layouts/Profile.vue')
    },
    //category
    '/categories': {
        component: require('./components/category/Categories.vue')
    },
    '/categories/:hashid/edit': {
        name: 'categories',
        component: require('./components/category/Editcategory.vue')
    },
    //comment
    '/comment': {
        name:'comment',
        component: require('./components/comment/Comment.vue')
    },
    '/reply': {
        name:'reply',
        component: require('./components/comment/Reply.vue')
    },
})

router.alias({

    // alias can contain dynamic segments
    // the dynamic segment names must match
    '/posts/:hashid': '/posts/:hashid/edit',
    'categories/:hashid': '/categories/:hashid/edit',
    '/users/:hashid': '/users/:hashid/edit',
    '/admin/:hashid': '/admin/:hashid/edit'
})

router.start(App, 'body')
