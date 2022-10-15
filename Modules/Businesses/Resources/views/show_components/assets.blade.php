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
                url: '/businesses',
                formData: {
                    ...@json($model ?? []),
                },
            }
        },

        computed: {
            // Convert subcategories to string
            subcategories: function () {

                if (!!this.formData.subcategories.length) {

                    let subcategories_string = ""

                    this.formData.subcategories.forEach((category, index, array) => {

                        subcategories_string += category.name

                        // Add comma
                        if (array.length-1 != index) {

                            subcategories_string += ', '
                        }
                    });

                    return subcategories_string
                } else {

                    return "None"
                }
            }
        }
    })
    </script>
@endpush
