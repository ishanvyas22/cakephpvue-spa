<template>
    <div class="container clearfix">
        <sidebar></sidebar>

        <router-view></router-view>
    </div>
</template>

<script>

    import Sidebar from '../components/Sidebar.vue';

    export default {
        components: {
            'sidebar': Sidebar,
        }
    }
</script>
