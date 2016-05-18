module.exports = {
    props: ['thread'],

    computed: {
        date: function() {
            return this.$options.filters.moment(this.thread.created_at);
        }
    },
};