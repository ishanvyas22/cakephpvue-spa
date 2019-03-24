<template>
    <!-- <div v-html="content" v-on:click.capture="handleClick"></div> -->
    <div class="posts form large-9 medium-8 columns content">
        <form method="post" :action="postUrl" novalidate="novalidate" @submit.prevent="onSubmit">
            <fieldset>
                <legend>Add Post</legend>
                <div class="input text required ">
                    <label for="title">Title</label>
                    <input type="text" name="title" required="required" maxlength="255" id="title" v-model="title">
                    <div class="error-message"></div>
                </div>
                <div class="input textarea required ">
                    <label for="description">Description</label>
                    <textarea name="description" required="required" id="description" rows="5" v-model="description"></textarea>
                    <div class="error-message"></div>
                </div>
                <button type="submit" class="button radius shadow primary">Submit</button>
                <a class="button shadow radius right mr-6" name="goBack">Back</a>
            </fieldset>
        </form>
    </div>
</template>

<script>
    import formSerialize from 'form-serialize';

    export default {
        data() {
            return {
                content: '',
                postUrl: '',
                title: '',
                description: '',
                errors: {}
            };
        },
        mounted() {
            // this.getAddPostView(this.$route.query);
        },
        methods: {
            getAddPostView(query) {
                axios.get('/api/posts/add', { params: query })
                    .then(response => {
                        this.content = response.data;

                        let token = document.querySelector('[name="_csrfToken"]');

                        console.log(token);
                        if (token) {
                            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
                        } else {
                            console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
                        }
                    })
                    .catch(error => {
                        console.log('Error: ' + error);
                    });
            },
            handleClick( e ) {
                if ( e.target.tagName == 'BUTTON' && e.target.type == 'submit' ) {
                    let data = formSerialize( e.target.form, {
                        hash: false, empty: true
                    } );

                    data += '&' + e.target.name + '='
                        + encodeURIComponent( e.target.value );

                    axios.post( '/api/posts/add', data, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    } ).then( response => {
                        // Redirect on success
                        if (response.data.success) {
                            this.$router.push({ path: response.data.url });
                        }

                        this.content = response.data;
                    } );

                    e.preventDefault();
                }

                // Redirect to last page if tag `a` tag with `goBack` name clicked
                if ( e.target.tagName == 'A' && e.target.name == 'goBack' ) {
                    this.$router.go(-1);

                    e.preventDefault();
                }
            },
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
                        console.log(response.data);
                        // if (response.data.success) {
                        //     this.$router.push({ path: response.data.url });
                        // }
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            }
        },
    }
</script>
