@push('links')
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue@2"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script type="text/javascript">
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data () {
                return {
                    url: '/businesses',
                    errors: null,
                    formData: {
                        ...@json($model ?? []),
                        model_subcategories: {!! $model_subcategories !!}
                    },
                    categories: {!! $categories !!},
                    subcategories: [],
                    subcategoryError: "",
                    cities: {!! $cities ?? [] !!},
                    barangays: [1],
                    region: "{!! $region !!}",
                    province: "{!! $province !!}",
                }
            },

            watch: {
                'formData.model_subcategories': {
                    handler () {
                        if (this.formData.model_subcategories != null && this.formData.model_subcategories.length > 3) {

                            this.subcategoryError = "Only 3 subcategories allowed"
                        } else {

                            this.subcategoryError = ""
                        }
                    },
                    deep: true,
                },

                'formData.city_id': {
                    handler () {

                        this.getBarangays(this.formData.city_id)
                        this.formData.barangay_id = null
                    },
                    deep: true,
                },

                'formData.category_id': {
                    handler () {

                        this.getSubcategories(this.formData.category_id)
                        this.formData.model_subcategories = null
                    },
                    deep: true,
                },
            },

            mounted() {

                this.getBarangays(this.formData.city_id)
                this.getSubcategories(this.formData.category_id)
            },

            methods: {

                async submit() {

                    if (this.formData.model_subcategories != null && this.formData.model_subcategories.length > 3) {

                        Swal.fire({
                            title: "Whoops!",
                            text: "Please complete the form.",
                            icon: 'error',
                            confirmButtonColor: '#d33',
                        })

                        return false;
                    }

                    await axios.{{ isset($model->id) ? 'put' : 'post' }}(this.url + '{{ isset($model->id) ? "/" . $model->id : '' }}', this.formData)
                        .then((response) => {

                            if (response.data.status == 'success') {

                                Swal.fire({
                                    title: response.data.title,
                                    text: response.data.message,
                                    icon: response.data.status,
                                    confirmButtonColor: '#4CAF50'
                                }).then(() => {

                                    window.location.href = this.url;
                                })
                            } else {

                                Swal.fire({
                                    title: response.data.title,
                                    text: response.data.message,
                                    icon: response.data.status,
                                    confirmButtonColor: '#d33',
                                })

                                this.formData = response.data.old
                                this.errors = response.data.errors
                                document.getElementById('app').scrollIntoView();
                            }
                        }
                    )
                },

                async getBarangays(city_id) {

                    this.barangays = []

                    await axios.get('/get-address?q=barangay&parent_id=' + city_id)
                        .then((response) => {

                            this.barangays = response.data.barangays
                        }
                    )
                },

                async getSubcategories(category_id) {

                    this.subcategories = []

                    await axios.get('/get-subcategories/' + category_id)
                        .then((response) => {

                            this.subcategories = response.data.subcategories
                        }
                    )
                },
            },
        })
    </script>
@endpush
