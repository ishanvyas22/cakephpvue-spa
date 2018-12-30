import VueRouter from 'vue-router';
import Home from './views/Home.vue';
import PostsIndex from './views/Posts/PostsIndex.vue';
import PostsAdd from './views/Posts/PostsAdd.vue';
import PageNotFound from './views/PageNotFound.vue';

export const routes = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'root',
            component: Home
        },
        {
            path: '/home',
            name: 'home',
            component: Home
        },
        {
            path: '/posts',
            name: 'posts',
            component: PostsIndex
        },
        {
            path: '/posts/add',
            name: 'addPost',
            component: PostsAdd
        },
        {
            path: "*",
            component: PageNotFound
        }
    ],
});