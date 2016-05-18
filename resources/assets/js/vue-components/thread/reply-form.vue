<template>
    <form action="/" method="post" class="quill-thread-reply-form">
        <textarea :disabled="sendingReply" v-model="reply" @blur="saveDraft" placeholder="Reply to this thread." class="form-control" rows="5"></textarea>
    
        <div class="reply-controls">
            <button @click="handleReplySubmission" type="submit" class="btn btn-primary" :class="{'disabled': sendingReply}">
                <i class="fa fa-paper-plane"></i> Post Reply
            </button>

            <button @click="handleSaveDraftButtonClick" :class="{'disabled': reply.length < 1}" class="btn btn-success-outline">
                <i class="fa fa-save"></i> Save Draft
            </button>
        </div>
    </form>
</template>

<script>
    module.exports = {
        props: ['thread'],

        data: function() {
            return {
                reply: '',
                sendingReply: false
            };
        },

        ready: function() {
            this.loadDraft();
        },

        methods: {
            handleReplySubmission(event) {
                event.preventDefault();

                this.sendingReply = true;

                let data = {
                    threadId: this.thread.id,
                    body: this.reply
                };

                this.$http.post('/api/threads/reply', data).then(function(response) {
                    this.$dispatch('postCreated', response.data);

                    this.sendingReply = false;
                    this.reply = '';

                    this.clearDraft();
                });
            },

            handleSaveDraftButtonClick(event) {
                event.preventDefault();

                if (this.reply.length < 1)
                    return false;

                this.saveDraft();

                let message = `Your draft has been successfully saved.
                    You can now close this window and come back to
                    finish your reply later!`;

                swal('Success!', message, 'success');
            },

            loadDraft() {
                let currentDrafts = this.getDrafts();
                let draft = currentDrafts[this.thread.id];

                if (draft) this.reply = draft;
            },

            getDrafts() {
                return JSON.parse(localStorage.getItem('quill_drafts'));
            },

            saveDraft() {
                let currentDrafts = this.getDrafts();

                if (! currentDrafts)
                    currentDrafts = {};

                currentDrafts[this.thread.id] = this.reply;

                localStorage.setItem('quill_drafts', JSON.stringify(currentDrafts));
            },

            clearDraft() {
                let currentDrafts = this.getDrafts();

                if (! currentDrafts)
                    currentDrafts = {};

                delete currentDrafts[this.thread.id];

                localStorage.setItem('quill_drafts', JSON.stringify(currentDrafts));
            }
        }
    };
</script>

<style>
    .reply-controls {
        margin-top: 20px;
    }
</style>