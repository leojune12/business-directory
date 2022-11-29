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
            <v-container class="tw-py-6 tw-px-1 md:tw-px-3">
                <v-row>
                    <v-col
                        cols="12"
                        md="6"
                        class="tw-flex tw-flex-col tw-gap-y-5"
                        offset-md="3"
                    >
                        <div class="tw-flex tw-items-center tw-justify-between">
                            <div class="tw-mb-0 tw-text-xl tw-font-bold">
                                Browse Products
                            </div>
                            <div class="tw-flex tw-items-center tw-gap-1 top-pagination">
                                <div class="tw-text-sm tw-text-gray-500">
                                    @{{ pagination.current_page }}/@{{ pagination.last_page }}
                                </div>
                                <v-pagination
                                    v-model="options.page"
                                    :length="pagination.last_page"
                                    :total-visible="0"
                                ></v-pagination>
                                {{-- <div class="tw-flex">
                                    <a
                                        :href="pagination.prev_page_url" v-bind:class="{'tw-text-gray-500': pagination.prev_page_url}"
                                    >
                                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z" />
                                        </svg>
                                    </a>
                                    <a :href="pagination.next_page_url">
                                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                                        </svg>
                                    </a>
                                </div> --}}
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
