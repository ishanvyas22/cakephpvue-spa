<template>
    <div>
        <top-header></top-header>

        <sidebar></sidebar>

        <div class="container clearfix">
            <router-view></router-view>
        </div>
        <footer>
        </footer>
    </div>
</template>

<script>
    import Header from '../components/Header.vue';
    import Sidebar from '../components/Sidebar.vue';

    export default {
        components: {
            'top-header': Header,
            'sidebar': Sidebar,
        }
    }
</script>
