<template>
    <nav>
        <ul class="pagination">
            <li class="page-item" :class="{'disabled': paginator.currentPage == 1}">
                <a class="page-link" href="#" @click="previousPage" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>

            <li v-for="num in paginator.lastPage"
            class="page-item" :class="{'active': (num + 1) == paginator.currentPage}">
                <a @click="changePage" class="page-link" href="#">{{ num + 1 }}</a>
            </li>

            <li class="page-item" :class="{'disabled': paginator.currentPage >= paginator.lastPage}">
                <a class="page-link" href="#" @click="nextPage" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<style>
    .pagination a,
    .pagination a:hover,
    .pagination a:focus {
        text-decoration: none;
    }
</style>

<script>
    module.exports = {
        props: ['paginator'],

        methods: {
            changePage(event) {
                event.preventDefault();

                if (! this.linkIsActive(event.target))
                    this.setPage(event.target.innerHTML);
            },

            previousPage(event) {
                event.preventDefault();

                if (! this.linkIsDisabled(event.target))
                    this.setPage(this.paginator.currentPage - 1);
            },

            nextPage(event) {
                event.preventDefault();

                if (! this.linkIsDisabled(event.target))
                    this.setPage(this.paginator.currentPage + 1);
            },

            setPage(page) {
                this.paginator.currentPage = page;
                this.$dispatch('pageChanged', page);
            },

            linkIsDisabled(el) {
                return el.parentElement.className.indexOf('disabled') > -1;
            },

            linkIsActive(el) {
                return el.parentElement.className.indexOf('active') > -1;
            }
        }
    };
</script>