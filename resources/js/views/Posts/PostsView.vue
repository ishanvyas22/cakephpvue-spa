<template>
    <div class="posts view large-9 medium-8 columns content">
        <div class="row">
            <div class="columns large-6">
                <h3>Post Details</h3>
            </div>
            <div class="columns large-6 clearfix">
                <div class="button-group right">
                    <a @click="showDeleteDialog(post.id)" class="shadow radius large" title="Remove">
                        <i class="fi-trash large"></i>
                    </a>
                    <router-link
                        :to="{ path: `/posts/edit/${post.id}` }"
                        class="shadow radius large"><i class="fi-page-edit large"></i></router-link>
                </div>
            </div>
        </div>
        <table class="vertical-table">
            <tr>
                <th scope="row">ID</th>
                <td>{{ post.id }}</td>
            </tr>
            <tr>
                <th scope="row">Title</th>
                <td>{{ post.title }}</td>
            </tr>
            <tr>
                <th scope="row">Description</th>
                <td>{{ post.description }}</td>
            </tr>
            <tr>
                <th scope="row">Created</th>
                <td>{{ post.created | moment }}</td>
            </tr>
            <tr>
                <th scope="row">Modified</th>
                <td>{{ post.modified | moment }}</td>
            </tr>
        </table>

        <!-- <div class="related">
            <h4>Related Comments</h4>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Post Id') ?></th>
                    <th scope="col"><?= __('User Id') ?></th>
                    <th scope="col"><?= __('Body') ?></th>
                    <th scope="col"><?= __('Status') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <tr>
                    <td><?= h($comments->id) ?></td>
                    <td><?= h($comments->post_id) ?></td>
                    <td><?= h($comments->user_id) ?></td>
                    <td><?= h($comments->body) ?></td>
                    <td><?= h($comments->status) ?></td>
                    <td><?= h($comments->created) ?></td>
                    <td><?= h($comments->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Comments', 'action' => 'view', $comments->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comments->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Comments', 'action' => 'delete', $comments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comments->id)]) ?>
                    </td>
                </tr>
            </table>
        </div> -->
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        data() {
            return {
                postId: null,
                post: [],
                currentRoute: null,
            };
        },
        mounted() {
            this.currentRoute = this.$router.currentRoute.name;
            this.postId = this.$route.params.id;

            this.viewPost(this.$route.query);
        },
        watch: {
            '$route.query' (newQuery, oldQuery) {
                this.viewPost(newQuery);
            }
        },
        methods: {
            viewPost(query) {
                axios.get(`/api/posts/view/${this.postId}`, { params: query })
                    .then(response => {
                        this.post = response.data.post;
                    })
                    .catch(error => {
                        console.log('Error: ' + error);
                    });
            },
            showDeleteDialog(id) {
                // $swal function calls SweetAlert into the application with the specified configuration.
                this.$swal({
                    title: `Are you sure you want to delete #${id}?`,
                    text: 'You won\'t be able to revert this!',
                    type: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                }).then((result) => {
                    if (result.value) {
                        this.deletePost(id);
                    }
                })
            },
            deletePost(id) {
                axios.post(`/api/posts/delete/${id}`, {
                        'id': id
                    })
                    .then(response => {
                        this.$notify({
                            group: 'default',
                            type: 'success',
                            text: response.data.message
                        });

                        this.$router.push({ path: '/posts' });
                    })
                    .catch(error => {
                        this.$notify({
                            group: 'default',
                            type: 'error',
                            text: error.response.data.message
                        });
                    });
            }
        },
        filters: {
            moment: function (date) {
                return moment(date).format('YYYY-MM-DD, hh:mm:ss A');
            }
        }
    }
</script>
