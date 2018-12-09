<template>
    <div class="posts index large-9 medium-8 columns content">
        <h3>Posts</h3>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col">
                        <router-link :to="{ name: currentRoute, query: { sort: 'id', direction: 'desc' }}">ID</router-link>
                    </th>
                    <th scope="col">Title</th>
                    <th scope="col">Created</th>
                    <th scope="col">Modified</th>
                    <th scope="col" class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in posts">
                    <td>{{ post.id }}</td>
                    <td>{{ post.title }}</td>
                    <td>{{ post.created }}</td>
                    <td>{{ post.modified }}</td>
                    <td class="actions">

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                posts: [],
                currentRoute: null
            };
        },
        mounted() {
            this.currentRoute = this.$router.currentRoute.name;

            this.getPosts(this.$route.query);
        },
        watch: {
            '$route.query' (newQuery, oldQuery) {
                this.getPosts(newQuery);
            }
        },
        methods: {
            getPosts(query) {
                axios.get('api/posts', { params: query })
                    .then(response => {
                        this.posts = response.data;
                    })
                    .catch(error => {
                        console.log('Error: ' + error);
                    });
            }
        }
    }
</script>
