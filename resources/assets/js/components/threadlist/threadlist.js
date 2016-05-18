module.exports = {
    props: ['source', 'page'],

    data: function() {
        return {
            threads: [],
            paginator: null,
            threadsLoading: true,
        };
    },

    components: {
        'quill-threadlist-item': require('./threadlist-item.js')
    },

    ready: function() {
        this.loadThreads(this.page);
    },

    events: {
        pageChanged: function(page) {
            this.loadThreads(page);

            history.pushState({page}, document.title, '?page=' + page);
        }
    },

    methods: {
        loadThreads: function(page = 1) {
            this.threads = {};
            this.threadsLoading = true;

            let source = this.source + '?page=' + page;

            return this.$http.get(source).then(function(response) {
                if (response.status == 500) {
                    return sweetAlert('Oops...', 'Something went wrong!', 'error');
                }

                this.threads = response.data.data;

                this.paginator = new QuillPaginator(
                    response.data.data,
                    response.data.current_page,
                    response.data.last_page
                );

                this.threadsLoading = false;
            });
        }
    }
};