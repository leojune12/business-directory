@section('title', isset($module) ? ' | ' . $module : '')
<x-app-layout>
    <v-app
        id="app"
        v-cloak
        class="tw-bg-gray-100"
    >
        <div class="tw-sticky tw-top-0 tw-z-50">
            @include('browse::products.index_components.appbar')
            @include('browse::products.index_components.tabs')
        </div>
        <v-main class="tw-z-0">
            <v-container class="tw-py-6">
                <v-row>
                    <v-col
                        cols="12"
                        md="6"
                        class="tw-flex tw-flex-col tw-gap-y-5"
                        offset-md="3"
                    >
                        <div>
                            <div class="tw-mb-0 tw-text-xl tw-font-bold">
                                Browse For Products
                            </div>
                        </div>

                        {{-- Skeleton Loader --}}
                        @include('browse::products.index_components.skeleton-loader')

                        {{-- Data List --}}
                        @include('browse::products.index_components.data-list')
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>

    @include('browse::products.index_components.assets')

</x-app-layout>
