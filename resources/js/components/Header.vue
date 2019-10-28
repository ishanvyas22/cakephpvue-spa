<template>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><router-link :to="{ name: title_url }">{{ title }}</router-link></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li><router-link :to="{ name: 'home' }">Home</router-link></li>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        data() {
            return {
                title: 'CakeVue',
                title_url: 'root'
            };
        }
    }
</script>
