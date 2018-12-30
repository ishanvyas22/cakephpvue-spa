<template>
    <div v-html="content" v-on:click.capture="handleClick"></div>
</template>

<script>
    import formSerialize from 'form-serialize';

    export default {
        data() {
            return {
                content: ''
            };
        },
        mounted() {
            this.getAddPostView(this.$route.query);
        },
        methods: {
            getAddPostView(query) {
                axios.get('/api/posts/add', { params: query })
                    .then(response => {
                        this.content = response.data
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
            }
        },
    }
</script>