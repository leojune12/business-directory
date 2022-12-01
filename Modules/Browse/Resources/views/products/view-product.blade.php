{{-- @section('title', isset($module) ? ' | ' . $module : '') --}}
<x-app-layout>
    <v-app
        id="app"
        v-cloak
        class="tw-bg-gray-100"
    >
        <div class="tw-z-50">
            @include('browse::products.view_product_components.appbar')
        </div>

        <v-container
            class="tw-pt-3"
        >
            <v-row>
                <v-col
                    cols="12"
                    md="10"
                    offset-md="1"
                >
                    <v-breadcrumbs
                        :items="breadcrumbItems"
                        class="tw-px-0"
                    >
                        <template v-slot:divider>
                            <v-icon>mdi-chevron-right</v-icon>
                        </template>
                    </v-breadcrumbs>

                    <div class="tw-flex tw-gap-6 tw-flex-col md:tw-flex-row">
                        <div>
                            @include('browse::products.view_product_components.fancybox')
                        </div>
                        <div>
                            <div class="tw-text-xl tw-font-semibold tw-text-gray-800 tw-mb-2">
                                @{{ product.name }}
                            </div>
                            <div class="tw-mb-5">
                                <v-rating
                                    :value="4"
                                    readonly
                                    background-color="grey"
                                    color="warning"
                                    dense
                                    half-increments
                                    hover
                                    size="20"
                                ></v-rating>
                            </div>
                            <div class="tw-text-3xl tw-text-orange-600 tw-mb-3">
                                &#8369;@{{ product.price }}
                            </div>
                            <div class="tw-text-gray-500">
                                @{{ product.description }}
                            </div>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </v-container>
    </v-app>

    @include('browse::products.view_product_components.assets')
</x-app-layout>
