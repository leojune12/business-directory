<v-data-iterator
    v-show="!loading"
    :items="pagination.data"
    :options.sync="options"
    :server-items-length="pagination.total"
    :footer-props="footerProps"
    item-key="id"
    hide-default-footer
>
    <template v-slot:default="props">

        <div
            v-for="item in pagination.data"
            :key="item.id"
            class="tw-p-0"
        >
        <div class="tw-border tw-shadow tw-rounded-md tw-p-4 tw-w-full tw-mx-auto tw-bg-white tw-mb-4">
            <div class="tw-flex md:tw-space-x-4 tw-space-x-3 tw-mb-4">
                <img
                    :src="getImage(item.name)"
                    {{-- src="https://picsum.photos/seed/picsum/200" --}}
                    alt="photo"
                    class="tw-rounded-full md:tw-h-14 md:tw-w-14 tw-h-10 tw-w-10 tw-ring-2 tw-ring-gray-300"
                >
                <div class="tw-flex tw-flex-1 tw-flex-col tw-justify-center tw-space-y-1">
                    <div class="tw-grid tw-grid-cols-1">
                        <a
                            :href="'/business/' + item.id + '/' + item.slug"
                            class="md:tw-text-lg tw-text-sm tw-text-black tw-font-medium tw-truncate"
                        >
                            @{{ item.name }}
                        </a>
                    </div>
                    <div class="tw-text-sm tw-text-gray-500 tw-flex -tw-ml-1">
                        <span>
                            <svg style="width:16px;height:16px" viewBox="0 0 24 24" class="tw-text-gray-400">
                                <path fill="currentColor" d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z" />
                            </svg>
                        </span>
                        <div class="tw-grid tw-grid-cols-1">
                            <div class="tw-col-span-1 tw-truncate">
                                @{{ item.full_address }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tw-flex tw-flex-wrap tw-text-gray-500 tw-items-center">
                <svg style="width:16px;height:16px" viewBox="0 0 24 24" class="tw-text-gray-400 tw-mr-1">
                    <path fill="currentColor" d="M19,5V7H15V5H19M9,5V11H5V5H9M19,13V19H15V13H19M9,17V19H5V17H9M21,3H13V9H21V3M11,3H3V13H11V3M21,11H13V21H21V11M11,15H3V21H11V15Z" />
                </svg>
                <span class="tw-text-xs tw-font-bold tw-uppercase tw-leading-none">@{{ item.category_name }}</span>
            </div>
            <div class="tw-flex tw-mb-1">
                <v-rating
                    v-model="item.rating"
                    readonly
                    background-color="grey"
                    color="warning"
                    dense
                    half-increments
                    hover
                    size="18"
                ></v-rating>
                <div class="tw-mt-1 tw-ml-1 tw-text-sm tw-text-gray-500 tw-flex tw-items-center tw-leading-none">
                    (@{{ item.rating }})
                    {{-- (123 Reviews) --}}
                </div>
            </div>
            <div class="">
                <div class="md:tw-text-sm tw-text-xs tw-text-gray-600 bd-truncate-overflow">
                    @{{ item.description }}
                </div>
            </div>
        </div>
    </div>

        <v-pagination
            v-model="options.page"
            :length="pagination.last_page"
            :total-visible="6"
            color="#2563EB"
            :disabled="loading"
        ></v-pagination>
    </template>
</v-data-iterator>
