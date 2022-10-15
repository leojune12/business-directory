@push('links')
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script type="text/javascript">
    new Vue({
        el: '#app',
        vuetify: new Vuetify(),

        data() {
            return {
                url: '/service',
                loading: true,
                options: {},
                headers: [
                    {
                        text: 'ID',
                        align: 'start',
                        value: 'id',
                    },
                    {
                        text: 'Name',
                        align: 'start',
                        value: 'name',
                    },
                    {
                        text: 'Action',
                        value: 'actions',
                        sortable: false,
                    },
                ],
                footerProps: {
                    showFirstLastPage: true,
                    itemsPerPageOptions: [10, 25, 50, 100]
                },
                selected: [],
                pagination: {
                    data: []
                },
                filterDialog: false,
                advanceFilters: {
                    name: null,
                },
            }
        },

        watch: {
            options: {
                handler () {
                    this.fetchTableData()
                },
                deep: true,
            },
        },

        computed: {
            getFilters () {

                let { sortBy, sortDesc, page, itemsPerPage } = this.options

                let filters = '?'
                filters += 'page=' + page
                filters += '&perPage=' + itemsPerPage
                filters += '&orderBy=' + sortBy
                filters += '&orderType=' + (sortDesc[0] ? 'ASC' : 'DESC')

                return filters
            },

            getAdvanceFilters () {
                let filters = ''

                for (const filter in this.advanceFilters) {

                    filters += '&' + `${filter}` + '=' + `${this.advanceFilters[filter]}`
                }

                return filters
            }
        },

        methods: {

            async fetchTableData() {

                this.loading = true

                await axios.get(this.url + this.getFilters + this.getAdvanceFilters)
                    .then(response => {
                        this.pagination = response.data
                        this.options.page = response.data.current_page
                        this.options.itemsPerPage = parseInt(response.data.per_page)
                        this.loading = false
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Something went wrong',
                            text: "Please refresh the page.",
                            icon: 'error',
                            confirmButtonColor: '#d33',
                        })
                    })
            },

            confirmDelete(id) {

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.loading = true
                        this.delete(id)
                    }
                })
            },

            async delete(id) {

                let id_array = Array.isArray(id)
                    ? Object.keys(id).map(index => id[index].id)
                    : [id]

                let url = this.url + '/' + id_array[0]

                await axios.post(url, {
                    _method: 'delete',
                    id_array: id_array
                })
                    .then(response => {
                        Swal.fire({
                            title: "Success",
                            text: "Deleted successfully.",
                            icon: "success",
                            confirmButtonColor: "#4CAF50",
                            timer: 3000
                        })
                        this.selected = []
                        this.fetchTableData()
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Something went wrong',
                            text: "Please refresh the page.",
                            icon: 'error',
                            confirmButtonColor: '#d33',
                        })
                    })
            },

            filter() {
                this.filterDialog = false
                this.fetchTableData()
            },

            closeFilter() {
                this.filterDialog = false
            },

            resetFilter() {
                this.$refs.advanceFilterForm.reset()
            },
        },
    })
    </script>
@endpush
