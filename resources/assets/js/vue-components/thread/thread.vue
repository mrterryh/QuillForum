<template>
    <div class="quill-thread" v-if="!threadLoading">
        <h1 class="page-header thread-title">{{ thread.title }}</h1>

        <p class="text-muted thread-info">
            Posted by <a href="#">{{ thread.poster.username }}</a>
            about {{ thread.created_at | moment }}
        </p>

        <quill-post transition="fadeRight" v-if="!threadLoading" op="true" :post="thread"></quill-post>

        <quill-post transition="fadeRight" v-for="post in posts" :post="post"></quill-post>
        
        <div class="col-md-offset-1">
            <quill-pagination :paginator="paginator"></quill-pagination>
            <quill-reply-form v-if="quill.userLoggedIn" :thread="thread"></quill-reply-form>
        </div>
    </div>

    <quill-spinner v-else></quill-spinner>
</template>

<script>
    module.exports = {
        props: ['thread', 'page'],

        components: {
            'quill-post': require('./post.vue'),
            'quill-reply-form': require('./reply-form.vue')
        },

        data: function() {
            return {
                quill: Quill,
                threadLoading: true,
                paginator: null,
                posts: {}
            };
        },

        ready: function() {
            this.loadPosts(this.page);
        },

        events: {
            pageChanged: function(page) {
                this.loadPosts(page);

                history.pushState({page}, document.title, '?page=' + page);
            },

            postCreated: function(post) {
                this.posts.push(post);
            }
        },

        methods: {
            loadPosts(page = 1) {
                this.threadLoading = true;

                let url = '/api/threads/posts/' + this.thread.id + '?page=' + page;

                this.$http.get(url).then(function(response) {
                    if (response.status == 500) {
                        return sweetAlert('Oops...', 'Something went wrong!', 'error');
                    }

                    this.posts = response.data.data;

                    this.paginator = new QuillPaginator(
                        response.data.data,
                        response.data.current_page,
                        response.data.last_page
                    );

                    this.threadLoading = false;
                });
            }
        }
    };
</script>