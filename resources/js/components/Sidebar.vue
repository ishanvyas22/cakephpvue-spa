<template>
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading">Actions</li>
            <li v-for="action in actions">
                <router-link :to="{ name: action.routeName }">{{ action.title }}</router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        data() {
            return {
                actions: []
            };
        },
        mounted() {
            axios.get('/api/routes/get-sidebar')
                .then(response => {
                    this.actions = response.data;
                })
                .catch(error => {
                    console.log('Error: ' + error);
                });
        }
    }
</script>
