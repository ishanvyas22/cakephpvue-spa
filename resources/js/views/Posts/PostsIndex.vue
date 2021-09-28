<template>
    <div class="posts index large-9 medium-8 columns content">
        <div class="row">
            <div class="columns large-6">
                <h3>Posts</h3>
            </div>
            <div class="columns large-6 clearfix">
                <router-link
                    :to="{ name: 'addPost' }"
                    class="button shadow radius right small"
                    >Add Post</router-link
                >
            </div>
        </div>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col">
                        <router-link
                            :to="{ name: currentRoute, query: queryParams.id }"
                            :class="defaultClass.id"
                            >ID</router-link
                        >
                    </th>
                    <th scope="col">
                        <router-link
                            :to="{
                                name: currentRoute,
                                query: queryParams.title,
                            }"
                            :class="defaultClass.title"
                            >Title</router-link
                        >
                    </th>
                    <th scope="col">
                        <router-link
                            :to="{
                                name: currentRoute,
                                query: queryParams.created,
                            }"
                            :class="defaultClass.created"
                            >Created</router-link
                        >
                    </th>
                    <th scope="col">
                        <router-link
                            :to="{
                                name: currentRoute,
                                query: queryParams.modified,
                            }"
                            :class="defaultClass.modified"
                            >Modified</router-link
                        >
                    </th>
                    <th scope="col" class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in posts">
                    <td>{{ post.id }}</td>
                    <td>{{ post.title }}</td>
                    <td>{{ post.created | moment }}</td>
                    <td>{{ post.modified | moment }}</td>
                    <td class="actions">
                        <router-link
                            :to="{ path: `posts/view/${post.id}` }"
                            class="item"
                            title="View"
                            ><i class="fi-eye"></i
                        ></router-link>
                        <router-link
                            :to="{ path: `posts/edit/${post.id}` }"
                            class="item"
                            title="Edit"
                            ><i class="fi-page-edit"></i
                        ></router-link>
                        <a
                            @click="showDeleteDialog(post.id)"
                            class="item"
                            title="Remove"
                        >
                            <i class="fi-trash"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import moment from "moment";

export default {
    data() {
        return {
            posts: [],
            currentRoute: null,
            defaultClass: {
                id: "",
                title: "",
                created: "",
                modified: "",
            },
            queryParams: {},
        };
    },
    mounted() {
        this.currentRoute = this.$router.currentRoute.name;

        this.getPosts(this.$route.query);
    },
    watch: {
        "$route.query"(newQuery, oldQuery) {
            this.getPosts(newQuery);
        },
    },
    methods: {
        getPosts(query) {
            if (query.sort !== "undefined" && query.direction) {
                this.defaultClass[query.sort] = query.direction;
            }

            axios
                .get("api/posts", { params: query })
                .then((response) => {
                    this.posts = response.data.posts;
                    this.queryParams = response.data.query;
                })
                .catch((error) => {
                    console.log("Error: " + error);
                });
        },
        showDeleteDialog(id) {
            // $swal function calls SweetAlert into the application with the specified configuration.
            this.$swal({
                title: `Are you sure you want to delete #${id}?`,
                text: "You won't be able to revert this!",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
            }).then((result) => {
                if (result.value) {
                    this.deletePost(id);
                }
            });
        },
        deletePost(id) {
            axios
                .post(`/api/posts/delete/${id}`, {
                    id: id,
                })
                .then((response) => {
                    this.$notify({
                        group: "default",
                        type: "success",
                        text: response.data.message,
                    });

                    this.getPosts(this.$route.query);
                })
                .catch((error) => {
                    this.$notify({
                        group: "default",
                        type: "error",
                        text: error.response.data.message,
                    });
                });
        },
    },
    filters: {
        moment: function (date) {
            return moment(date).format("YYYY-MM-DD, hh:mm A");
        },
    },
};
</script>
