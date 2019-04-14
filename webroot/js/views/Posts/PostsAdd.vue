<template>
    <div class="posts form large-9 medium-8 columns content">
        <form method="post" :action="postUrl" novalidate="novalidate" @submit.prevent="onSubmit" @keydown="errors.clear($event.target.name)">
            <fieldset>
                <legend>Add Post</legend>
                <div class="input text required" v-bind:class="{ 'error': errors.has('title') }">
                    <label for="title">Title</label>
                    <input type="text" name="title" v-model="title">
                    <div v-show="errors.has('title')" class="error-message" v-text="errors.get('title')"></div>
                </div>
                <div class="input textarea required" v-bind:class="{ 'error': errors.has('description') }">
                    <label for="description">Description</label>
                    <textarea name="description" rows="5" v-model="description"></textarea>
                    <div v-show="errors.has('description')" class="error-message" v-text="errors.get('description')"></div>
                </div>
                <button type="submit" class="button radius shadow primary" :disabled="errors.any()">Submit</button>

                <a class="button shadow radius right mr-6" name="goBack" @click.prevent="$router.go(-1)">Back</a>
            </fieldset>
        </form>
    </div>
</template>

<script>
    import formSerialize from 'form-serialize';
    import Errors from '../../helpers/FormErrors.js';

    export default {
        data() {
            return {
                postUrl: '',
                title: '',
                description: '',
                errors: new Errors()
            };
        },
        methods: {
            onSubmit(event) {
                let data = formSerialize(event.target, {
                    hash: false,
                    empty: true
                });

                axios.post('/api/posts/save', data, {
                        headers: {'X-Requested-With': 'XMLHttpRequest'}
                    })
                    .then(response => {
                        // Redirect on success
                        if (response.data.success) {
                            this.$notify({
                                group: 'default',
                                type: 'success',
                                text: response.data.message
                            });

                            this.$router.push({ path: response.data.url });
                        }
                    })
                    .catch(error => {
                        this.$notify({
                            group: 'default',
                            type: 'error',
                            text: error.response.data.message
                        });

                        this.errors.add(error.response.data.errors);
                    });
            }
        },
    }
</script>
