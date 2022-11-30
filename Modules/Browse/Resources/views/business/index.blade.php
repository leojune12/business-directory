@section('title', isset($module) ? ' | ' . $module : '')
<x-app-layout>
    <v-app
        id="app"
        v-cloak
        class="tw-bg-gray-100"
    >
        <div class="tw-sticky tw-top-0 tw-z-50">
            @include('browse::business.index_components.appbar')
            @include('browse::business.index_components.tabs')
        </div>
        <v-main class="tw-z-0">
            <v-container class="tw-py-6 tw-px-1 md:tw-px-3">
                <v-row>
                    <v-col
                        v-if=!$vuetify.breakpoint.smAndDown
                        cols="12"
                        md="3"
                        class="tw-pt-20"
                    >
                        {{-- Search Section MD --}}
                        @include('browse::business.index_components.search-section-md')
                    </v-col>
                    <v-col
                        cols="12"
                        md="6"
                        class="tw-flex tw-flex-col tw-gap-y-5"
                    >
                        {{-- Data List Header --}}
                        @include('browse::business.index_components.data-list-header')

                        {{-- Skeleton Loader --}}
                        @include('browse::business.index_components.skeleton-loader')

                        {{-- Data List --}}
                        @include('browse::business.index_components.data-list')
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>

    @include('browse::business.index_components.assets')

</x-app-layout>
