<x-app-layout>
    <v-app
        id="app"
        v-cloak
        class="tw-pt-5 tw-bg-gray-50"
    >
        <v-main>
            <v-container>

                <v-row>
                    <v-col
                        cols="12"
                        md="8"
                        offset="0"
                        offset-md="2"
                    >
                        <h3 class="mb-5">Browse For Top Results</h3>

                        <v-row
                            class="tw-pb-4"
                        >
                            <v-col
                                cols="12"
                                md="5"
                            >
                                <v-combobox
                                    {{-- v-model="advanceFilters.name" --}}
                                    placeholder="Search Business"
                                    prepend-inner-icon="mdi-magnify"
                                    solo
                                    hide-details
                                    :items="[]"
                                    :search-input.sync="advanceFilters.name"
                                    v-on:keyup.enter="search()"
                                ></v-combobox>
                            </v-col>
                            <v-col
                                cols="12"
                                md="5"
                            >
                                <v-combobox
                                    {{-- v-model="advanceFilters.address" --}}
                                    placeholder="Address"
                                    prepend-inner-icon="mdi-map-marker-radius"
                                    solo
                                    hide-details
                                    :items="[]"
                                    :search-input.sync="advanceFilters.address"
                                    v-on:keyup.enter="search()"
                                ></v-combobox>
                            </v-col>
                            <v-col
                                cols="12"
                                md="2"
                                class="tw-flex tw-items-center"
                            >
                                <v-btn
                                    outlined
                                    color="success"
                                    block
                                    large
                                    class="tw-h-12"
                                    elevation="2"
                                    @click="search()"
                                >
                                    Search
                                </v-btn>
                            </v-col>
                        </v-row>

                        <v-row
                            class="tw-pb-8"
                        >
                            <v-col
                                cols="12"
                                class="tw-pt-0"
                            >
                                <v-tabs
                                    background-color="transparent"
                                    fixed-tabs
                                    {{-- class="tw-border-b-2" --}}
                                >
                                    <v-tab>
                                        <v-icon
                                            class="tw-mr-1"
                                        >
                                            mdi-storefront
                                        </v-icon>
                                        <span class="md:tw-block tw-hidden">
                                            Business
                                        </span>
                                    </v-tab>
                                    <v-tab>
                                        <v-icon
                                            class="tw-mr-1"
                                        >
                                            mdi-shopping
                                        </v-icon>
                                        <span class="md:tw-block tw-hidden">
                                            Products
                                        </span>
                                    </v-tab>
                                    <v-tab>
                                        <v-icon
                                            class="tw-mr-1"
                                        >
                                            mdi-tools
                                        </v-icon>
                                        <span class="md:tw-block tw-hidden">
                                            Services
                                        </span>
                                    </v-tab>
                                </v-tabs>
                            </v-col>
                        </v-row>

                        {{-- Skeleton Loader --}}
                        <v-row
                            v-if="loading"
                            class="tw-gap-y-4 tw-mt-0"
                        >
                            <v-col
                                v-for="n in 5"
                                :key="n"
                                cols="12"
                                class="tw-py-0"
                            >
                                <div class="tw-border tw-shadow tw-rounded-md tw-p-4 tw-w-full tw-mx-auto tw-bg-white">
                                    <div class="tw-animate-pulse tw-flex tw-space-x-4 tw-mb-4">
                                        <div class="tw-rounded-full tw-bg-slate-300 tw-h-14 tw-w-14"></div>
                                        <div class="tw-flex tw-flex-1 tw-flex-col tw-justify-center tw-space-y-2">
                                            <div class="tw-h-5 tw-w-56 tw-bg-slate-300 tw-rounded"></div>
                                            <div class="tw-h-3 tw-w-60 tw-bg-slate-300 tw-rounded"></div>
                                        </div>
                                    </div>
                                    <div class="tw-space-y-3">
                                        <div class="tw-grid tw-grid-cols-3 tw-gap-4">
                                        <div class="tw-h-2 tw-bg-slate-300 tw-rounded tw-col-span-2"></div>
                                        <div class="tw-h-2 tw-bg-slate-300 tw-rounded tw-col-span-1"></div>
                                        </div>
                                        <div class="tw-h-2 tw-bg-slate-300 tw-rounded"></div>
                                    </div>
                                </div>
                            </v-col>
                        </v-row>

                        <v-data-iterator
                            v-show="!loading"
                            :items="pagination.data"
                            :options.sync="options"
                            :server-items-length="pagination.total"
                            :footer-props="footerProps"
                            item-key="id"
                        >
                            <template v-slot:default="props">

                                <v-row class="tw-mb-4 tw-gap-y-4">
                                    <v-col
                                        v-for="item in props.items"
                                        :key="item.id"
                                        cols="12"
                                        class="tw-py-0"
                                    >

                                        <div class="tw-border tw-shadow tw-rounded-md tw-p-4 tw-w-full tw-mx-auto tw-bg-white">
                                            <div class="tw-flex tw-space-x-4 tw-mb-4">
                                                <img
                                                    :src="'https://ui-avatars.com/api/?name=' + item.name + '&background=random'"
                                                    alt="John"
                                                    class="tw-rounded-full  tw-h-14 tw-w-15 tw-ring-2 tw-ring-gray-300"
                                                >
                                                <div class="tw-flex tw-flex-1 tw-flex-col tw-justify-center tw-space-y-1">
                                                    <div class="tw-text-xl tw-text-black">
                                                        @{{ item.name }}
                                                    </div>
                                                    <div class="tw-text-sm tw-text-gray-600 ">
                                                        <v-icon
                                                            color="blue"
                                                            small
                                                        >mdi-map-marker</v-icon>
                                                        @{{ item.address }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="tw-text-sm tw-text-gray-600">
                                                    @{{ item.description }}
                                                </div>
                                            </div>
                                        </div>
                                    </v-col>
                                </v-row>
                            </template>

                        </v-data-iterator>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>

        {{-- @include('browse::index_components.filter') --}}

    </v-app>

    @include('browse::index_components.assets')

</x-app-layout>
