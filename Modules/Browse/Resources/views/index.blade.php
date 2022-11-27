<x-app-layout>
    <v-app
        id="app"
        v-cloak
        class="tw-bg-gray-100"
    >
        <div class="tw-sticky tw-top-0 tw-z-50">
            @include('browse::index_components.appbar')
            @include('browse::index_components.tabs')
        </div>
        <v-main class="tw-z-0">
            <v-container
                class="tw-py-6 md:tw-py-10"
            >
                <v-row>
                    <v-col
                        cols="12"
                        md="3"
                        class="tw-p-0"
                    >
                        {{-- Search --}}
                        {{-- @include('browse::index_components.search-section') --}}
                    </v-col>

                    <v-col
                        cols="12"
                        md="6"
                        class="tw-flex tw-flex-col tw-gap-y-5"
                    >
                        <div>
                            <h4 class="tw-mb-0 tw-text-xl tw-font-bold">Browse For Business</h4>
                        </div>

                        {{-- Skeleton Loader --}}
                        {{-- @include('browse::index_components.skeleton-loader') --}}

                        {{-- List --}}
                        @include('browse::index_components.data-list')
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>

    @include('browse::index_components.assets')

</x-app-layout>
