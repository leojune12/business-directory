@push('links')
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <style>
        .v-skeleton-loader__avatar {

            width: 60px !important;
            height: 60px !important;
        }
    </style>
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
                url: '/browse',
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
                    itemsPerPageOptions: [10, 25, 50],
                    prevIcon: 'mdi-arrow-left',
                    nextIcon: 'mdi-arrow-right',
                },
                selected: [],
                pagination: {
                    data: []
                },
                filterDialog: false,
                advanceFilters: {
                    name: null,
                    address: null,
                },
                businessItemsDebounce: null,
                businessItems: [],
                searchLoading: false,
                addressItemsDebounce: null,
                addressItems: [],
                addressLoading: false,
            }
        },

        mounted() {

            // this.fetchTableData()
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

            search() {
                this.fetchTableData()
            },

            async fetchBusinessNames() {

                await axios.get('/search-business-name/' + this.advanceFilters.name)
                    .then(response => {

                        this.searchLoading = false
                        this.businessItems = response.data
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

            showBusinessNames() {

                if (this.businessItemsDebounce) clearTimeout(this.businessItemsDebounce)

                this.businessItemsDebounce = setTimeout(() => {

                    this.searchLoading = true
                    this.fetchBusinessNames()
                }, 600)
            },

            async fetchAddressNames() {

                await axios.get('/search-address/' + this.advanceFilters.address)
                    .then(response => {

                        this.addressLoading = false
                        this.addressItems = response.data
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

            showAddressNames() {

                if (this.addressItemsDebounce) clearTimeout(this.addressItemsDebounce)

                this.addressItemsDebounce = setTimeout(() => {

                    this.addressLoading = true
                    this.fetchAddressNames()
                }, 600)
            },
        },
    })
    </script>
@endpush
