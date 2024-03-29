@push('links')
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <style>
        .v-skeleton-loader__avatar {

            width: 60px !important;
            height: 60px !important;
        }

        .toolbar-search-input .v-input__slot{

            box-shadow: none !important;
        }

        .top-pagination .v-pagination__navigation {

            margin-left: 4px;
            margin-right: 4px;
        }
    </style>
@endpush
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue@2"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    {{-- <script src="https://unpkg.com/vue-infinite-loading@^2/dist/vue-infinite-loading.js"></script> --}}
    <script type="text/javascript">
    new Vue({
        el: '#app',
        vuetify: new Vuetify(),

        data() {
            return {
                url: '/browse',
                loading: true,
                options: {
                    itemsPerPage: 12
                },
                pagination: {
                    data: [],
                },
                footerProps: {
                    showFirstLastPage: true,
                    itemsPerPageOptions: [12, 25, 50],
                    prevIcon: 'mdi-arrow-left',
                    nextIcon: 'mdi-arrow-right',
                },
                advanceFilters: {
                    business_name: null,
                    location: null,
                    category_id: null,
                    subcategory_id: null,
                },
                businessItemsDebounce: null,
                businessItems: [],
                searchLoading: false,
                locationItemsDebounce: null,
                locationItems: [],
                locationLoading: false,
                categories: {!! $categories ?? [] !!},
                subcategories: [],
                subcategoryLoading: false,
            }
        },

        watch: {
            options: {
                handler () {
                    this.fetchTableData()
                },
                deep: true,
            },
            'advanceFilters.category_id': {
                handler () {
                    this.fetchSubcategories()
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
            },
        },

        methods: {

            async fetchTableData() {

                this.loading = true
                this.scrollToTop()

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
                            // text: error,
                            icon: 'error',
                            confirmButtonColor: '#d33',
                        })
                    })
            },

            search(dialog) {

                if (dialog) {

                    dialog.value = false
                }

                this.options.page = 1
                this.fetchTableData()
            },

            async fetchBusinessNames() {

                await axios.get('/api/search-business-name/' + this.advanceFilters.business_name)
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

            async fetchLocationNames() {

                await axios.get('/api/search-address/' + this.advanceFilters.location)
                    .then(response => {

                        let itemsArray = []

                        response.data.forEach((item) => {

                            itemsArray.push(this.ucWords(item.address))
                        });

                        this.locationLoading = false
                        this.locationItems = itemsArray
                    })
                    .catch(error => {
                        console.log(error)
                        Swal.fire({
                            title: 'Something went wrong',
                            text: "Please refresh the page.",
                            icon: 'error',
                            confirmButtonColor: '#d33',
                        })
                    })
            },

            showLocationNames() {

                if (this.locationItemsDebounce) clearTimeout(this.locationItemsDebounce)

                this.locationItemsDebounce = setTimeout(() => {

                    this.locationLoading = true
                    this.fetchLocationNames()
                }, 600)
            },

            getImage(name) {

                let images = [
                    // 'https://ui-avatars.com/api/?name=' + name + '&background=random',
                    // 'https://picsum.photos/seed/picsum/200',
                    // 'https://random.imagecdn.app/200/200',
                    'https://api.lorem.space/image/shoes?w=150&h=150',
                    'https://api.lorem.space/image/house?w=150&h=150',
                    'https://api.lorem.space/image/pizza?w=150&h=150',
                    'https://api.lorem.space/image/burger?w=150&h=150',
                    'https://api.lorem.space/image/drink?w=150&h=150',
                    'https://api.lorem.space/image/car?w=150&h=150',
                ]

                return images[Math.floor(Math.random()*images.length)]
            },

            scrollToTop() {
                window.scrollTo(0,0);
            },

            ucWords(str) {

                return str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                    return letter.toUpperCase();
                });
            },

            async fetchSubcategories() {

                this.subcategoryLoading = true

                await axios.get('/api/search-subcategories/' + this.advanceFilters.category_id)
                    .then(response => {

                        this.subcategoryLoading = false
                        this.subcategories = response.data
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Something went wrong',
                            text: "Please refresh the page.",
                            icon: 'error',
                            confirmButtonColor: '#d33',
                        })
                    })
            }
        },
    })
    </script>
@endpush
