<template>
    <div class="container clearfix">
        <notifications group="default" position="bottom right" :width="400" />

        <!-- Custom template example -->
        <!-- <notifications group="my-custom-notification"
            :duration="5000"
            :width="1200"
            position="top center">

            <template slot="body" slot-scope="props">
                <div class="my-custom-notification">
                    <div class="message success" @click="props.close" v-html="props.item.text"></div>
                </div>
            </template>
        </notifications> -->

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
