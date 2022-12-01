@push('links')
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"
    />
@endpush
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue@2"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

    <script src="https://unpkg.com/vue-meta/dist/vue-meta.min.js"></script>

    <script type="text/javascript">

    new Vue({
        el: '#app',
        vuetify: new Vuetify(),
        metaInfo: {
            title: '{{ config('app.name', 'Business Index') }}{{ isset($module) ? " | " . $module : '' }}',
            meta: [
                {
                    vmid: 'og:url',
                    name: 'og:url',
                    content: 'https://roxas-index.herokuapp.com',
                },
                {
                    vmid: 'og:title',
                    name: 'og:title',
                    content: '{{ config("app.name", "Business Index") }}{{ isset($module) ? " | " . $module : '' }}',
                },
                {
                    vmid: 'og:description',
                    name: 'og:description',
                    content: 'List of businesses and establishment in Capiz that offer products and services.',
                },
                {
                    vmid: 'og:image',
                    name: 'og:image',
                    content: 'http://roxascity.gov.ph/wp-content/uploads/2021/10/Roxas-City-Drone-Shot-scaled.jpg',
                },
            ],
        },

        data() {
            return {
                url: '/products',
                product: {
                    ...@json($model ?? null),
                },
                windowTop: 0,
                showInfoOnTab: false,
                headerHeight: 0,
                imageList: [],
                breadcrumbItems: [
                    {
                    text: 'Home',
                    disabled: false,
                    href: '/browse',
                    },
                    // {
                    // text: '{{ $model->business_name }}',
                    // disabled: false,
                    // href: '/business/{{ $model->business_id }}/{{ $model->business_slug }}',
                    // },
                    {
                    text: 'Products',
                    disabled: false,
                    href: '/browse/products',
                    },
                    {
                    text: '{{ $model->name }}',
                    disabled: true,
                    href: '',
                    },
                ],
            }
        },

        computed: {
            getProductName () {

                return this.product.name ?? ''
            },
        },

        mounted() {
            this.initializeFancyBox()
            this.$forceUpdate();
        },

        methods: {
            initializeFancyBox() {

                // Initialise Carousel
                const mainCarousel = new Carousel(document.querySelector("#mainCarousel"), {
                    Dots: false,
                    Navigation: false,
                    infinite: false,
                });

                // Thumbnails
                const thumbCarousel = new Carousel(document.querySelector("#thumbCarousel"), {
                    Sync: {
                        target: mainCarousel,
                        friction: 0,
                    },
                    Dots: false,
                    Navigation: false,
                    center: true,
                    slidesPerPage: 1,
                    infinite: false,
                });

                // Customize Fancybox
                Fancybox.bind('[data-fancybox="gallery"]', {
                    Carousel: {
                        on: {
                            change: (that) => {
                                mainCarousel.slideTo(mainCarousel.findPageForSlide(that.page), {
                                    friction: 0,
                                });
                            },
                        },
                    },
                });
            }
        },
    })
    </script>
@endpush
