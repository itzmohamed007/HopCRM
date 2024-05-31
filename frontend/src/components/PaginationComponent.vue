<template>
    <div class="inline-flex xs:mt-0">
        <button @click="previousPage" :disabled="currentPage === 1"
            class="disabled:cursor-not-allowed px-3 py-1 ml-0 text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 disabled:opacity-50">
            &lt;
        </button>
        <button v-for="page in pages" :key="page" @click="goToPage(page)" class="disabled:cursor-not-allowed"
            :class="['px-3 py-1 leading-tight border border-gray-300 font-semibold text-black', page === currentPage ? 'text-blue-600 bg-blue-50' : 'text-gray-500 bg-white', 'hover:bg-gray-100 hover:text-gray-700']"
            :disabled="page === '...'">
            {{ page }}
        </button>
        <button @click="nextPage" :disabled="currentPage === totalPages"
            class="disabled:cursor-not-allowed px-3 py-1 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 disabled:opacity-50">
            &gt;
        </button>
    </div>
</template>

<script>
export default {
    name: 'PaginationComponent',
    props: {
        totalPages: {
            type: Number,
            required: true
        },
        currentPage: {
            type: Number,
            required: true
        },
        resultsPerPage: {
            type: Number,
            required: true
        },
        totalResults: {
            type: Number,
            required: true
        }
    },
    computed: {
        pages() {
            let pages = [];
            let startPage = 1;
            let endPage = this.totalPages;
            if (endPage > 13) {
                for (let i = startPage; i <= 11; i++) {
                    pages.push(i);
                }
                pages.push("...");
                pages.push(endPage - 1);
                pages.push(endPage);
            } else {
                for (let i = startPage; i <= endPage; i++) {
                    pages.push(i);
                }
            }
            return pages;
        },
        startResult() {
            return (this.currentPage - 1) * this.resultsPerPage + 1;
        },
        endResult() {
            return Math.min(this.currentPage * this.resultsPerPage, this.totalResults);
        }
    },
    methods: {
        goToPage(page) {
            this.$emit('update', page);
        },
        previousPage() {
            if (this.currentPage > 1) this.goToPage(this.currentPage - 1);
        },
        nextPage() {
            if (this.currentPage < this.totalPages) this.goToPage(this.currentPage + 1);
        }
    }
}
</script>
