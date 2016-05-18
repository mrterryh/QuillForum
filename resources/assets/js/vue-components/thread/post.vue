<template>
    <div class="row quill-post">
        <div class="col-md-1">
            <a href="#"><img class="post-avatar" :src="post.poster.avatar" alt="Post creator"></a>
        </div>

        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <a href="#">{{ post.poster.username }}</a> said
                    {{ post.created_at | moment }}

                    <span v-if="op">(original post)</span>

                    <span v-if="post.poster.is_administrator" class="label label-primary-outline pull-right badge">administrator</span>
                </div>
            
                <div class="card-block post-content">
                    <p v-if="!editMode">{{ post.body }}</p>

                    <form action="/" v-if="editMode" class="editForm">
                        <textarea class="form-control" v-model="editContent" rows="5"></textarea>

                        <button type="button" class="btn btn-sm btn-primary"
                        :class="{'disabled': editing}" @click="processEdit">
                            <i class="fa fa-spinner fa-spin" v-if="editing"></i>
                            <i class="fa fa-times" v-else></i>
                            Edit Post
                        </button>

                        <button type="button" class="btn btn-sm btn-danger-outline" @click="handleEditCancelClick">
                            <i class="fa fa-times"></i> Cancel
                        </button>
                    </form>

                    <div class="btn-group post-controls" v-if="quill.userLoggedIn && !op && !editMode">
                        <button type="button" class="btn btn-sm btn-secondary-outline" @click="handleEditClick">
                            <i class="fa fa-pencil"></i> Edit
                        </button>

                        <button type="button" class="btn btn-sm btn-secondary-outline"
                        :class="{'disabled': deleting}" @click="handleDeleteClick">
                            <i class="fa fa-spinner fa-spin" v-if="deleting"></i>
                            <i class="fa fa-times" v-else></i>
                            Delete
                        </button>

                        <button type="button" class="btn btn-sm btn-secondary-outline"
                        :class="{'sdisabled': reporting}" @click="handleReportClick">
                            <i class="fa fa-spinner fa-spin" v-if="reporting"></i>
                            <i class="fa fa-warning" v-else></i>
                            Report
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    module.exports = {
        props: ['post', 'op'],

        data: function() {
            return {
                quill: window.Quill,
                editMode: false,
                editContent: this.post.body,
                editing: false,
                reporting: false,
                deleting: false
            };
        },

        methods: {
            handleReportClick(event) {
                event.preventDefault();

                this.reporting = true;

                setTimeout(() => {
                    let message = `Thanks for reporting this post. Our team will get
                        onto it right away!`;

                    swal('Thank you!', message, 'success');

                    this.reporting = false;
                }, 1000);
            },

            handleEditClick(event) {
                event.preventDefault();

                this.editMode = true;
            },

            handleEditCancelClick(event) {
                event.preventDefault();

                this.editMode = false;
            },

            handleDeleteClick(event) {
                event.preventDefault();

                this.deleting = true;

                let data = {postId: this.post.id};

                this.$http.post('/api/posts/delete', data).then(function(response) {
                    let message = `The post has been successfully deleted!`;

                    swal('Success!', message, 'success');

                    this.deleting = false;

                    this.$parent.loadPosts(this.$parent.page);
                });
            },

            processEdit() {
                this.editing = true;

                let data = {
                    body: this.editContent,
                    postId: this.post.id
                };

                // @TODO Validation using quill form.
                this.$http.post('/api/posts/edit', data).then(function(response) {
                    this.editing = false;
                    this.editMode = false;

                    this.post.body = this.editContent;

                    swal('Success!', 'Your edit was made successfully!', 'success');
                });
            }
        }
    };
</script>

<style>
    .editForm textarea {
        margin-bottom: 10px;
    }
</style>