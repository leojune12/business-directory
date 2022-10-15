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
            data () {
                return {
                    url: '/product',
                    errors: null,
                    formData: {
                        ...@json($model ?? []),
                    },
                }
            },

            methods: {

                async submit() {

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
            },
        })
    </script>
@endpush
