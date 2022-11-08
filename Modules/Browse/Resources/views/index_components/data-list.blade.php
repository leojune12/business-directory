<v-container
    {{-- v-show="!loading" --}}
    {{-- v-infinite-scroll="fetchTableData"
    :infinite-scroll-disabled="true"
    infinite-scroll-distance="10" --}}
>
    {{-- <v-data-iterator
        :items="pagination.data"
        :options.sync="options"
        :items-per-page="pagination.data.length"
        :server-items-length="pagination.total"
        hide-default-footer
        item-key="id"
    >
        <template v-slot:default="props">

            <v-row class="tw-mb-4 tw-gap-y-4">
                <v-col
                    v-for="item in props.items"
                    :key="item.id"
                    cols="12"
                    class="tw-p-0"
                >

                    <div class="tw-border tw-shadow tw-rounded-md tw-p-4 tw-w-full tw-mx-auto tw-bg-white">
                        <div class="tw-flex tw-space-x-4 tw-mb-4">
                            <img
                                :src="'https://ui-avatars.com/api/?name=' + item.name + '&background=random'"
                                alt="John"
                                class="tw-rounded-full  tw-h-14 tw-w-14 tw-ring-2 tw-ring-gray-300"
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

    </v-data-iterator> --}}
    <v-row class="tw-mb-4 tw-gap-y-4">
        <v-col
            v-for="item in pagination.data"
            :key="item.id"
            cols="12"
            class="tw-p-0"
        >
            <div class="tw-border tw-shadow tw-rounded-md tw-p-4 tw-w-full tw-mx-auto tw-bg-white">
                <div class="tw-flex tw-space-x-4 tw-mb-4">
                    <img
                        :src="'https://ui-avatars.com/api/?name=' + item.name + '&background=random'"
                        alt="John"
                        class="tw-rounded-full  tw-h-14 tw-w-14 tw-ring-2 tw-ring-gray-300"
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
        <infinite-loading
            ref="infiniteLoading"
            @infinite="fetchTableData"
            spinner="spiral"
            class="tw-p-0"
        >
            <div slot="spinner">
                <v-col
                    cols="12"
                    class="tw-p-0"
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
            </div>
            <div slot="no-more">
                No more result.
            </div>
            <div slot="no-results">
                No result. Try other name or location.
            </div>
        </infinite-loading>
    </v-row>
</v-container>
