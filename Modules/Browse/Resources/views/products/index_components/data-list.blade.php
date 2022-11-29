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
        <div class="tw-flex tw-flex-wrap tw-mb-3">
            <a
                v-for="item in props.items"
                :key="item.id"
                href="#"
                class="tw-w-1/2 md:tw-w-1/3 md:tw-p-2 tw-p-1 tw-transition tw-ease-in-out tw-delay-100 tw-duration-200 hover:tw-scale-105- hover:tw--translate-y-0.5- tw-flex"
            >
                <div class="tw-bg-white tw-rounded-sm tw-overflow-hidden tw-drop-shadow tw-w-full tw-flex tw-flex-col tw-justify-between">
                    <img
                        :src="getImage(item.name)"
                        alt="photo"
                        class="tw-w-full tw-h-auto bd-min-h-28"
                    >
                    <div class="tw-p-2 tw-grid tw-grid-cols-1">
                        <div class="tw-text-sm tw-font-semibold- tw-text-gray-700 tw-mb-2 tw-truncate" :title="item.name">
                            @{{ item.name }}
                        </div>
                        <div class="tw-text-sm- tw-font-medium tw-text-gray-700 tw-leading-4">
                            &#8369;@{{ item.price }}
                        </div>
                        <div class="tw-mb-1">
                            <v-rating
                                :value="4"
                                readonly
                                background-color="grey"
                                color="warning"
                                dense
                                half-increments
                                hover
                                size="14"
                            ></v-rating>
                            {{-- <div class="tw-text-xs tw-text-gray-500 tw-flex tw-items-center tw-leading-none">
                                (123 Reviews)
                            </div> --}}
                        </div>
                        <div class="tw-text-xs tw-text-gray-700 tw-font-normal tw-flex tw-mb-1">
                            <span class="tw-w-4 tw-h-4 tw-mr-1">
                                <svg style="width:16px;height:16px" viewBox="0 0 24 24" class="tw-text-gray-400">
                                    <path fill="currentColor" d="M5.06 3C4.63 3 4.22 3.14 3.84 3.42S3.24 4.06 3.14 4.5L2.11 8.91C1.86 10 2.06 10.95 2.72 11.77L3 12.05V19C3 19.5 3.2 20 3.61 20.39S4.5 21 5 21H19C19.5 21 20 20.8 20.39 20.39S21 19.5 21 19V12.05L21.28 11.77C21.94 10.95 22.14 10 21.89 8.91L20.86 4.5C20.73 4.06 20.5 3.7 20.13 3.42C19.77 3.14 19.38 3 18.94 3H5.06M18.89 4.97L19.97 9.38C20.06 9.81 19.97 10.2 19.69 10.55C19.44 10.86 19.13 11 18.75 11C18.44 11 18.17 10.9 17.95 10.66C17.73 10.43 17.61 10.16 17.58 9.84L16.97 5L18.89 4.97M5.06 5H7.03L6.42 9.84C6.3 10.63 5.91 11 5.25 11C4.84 11 4.53 10.86 4.31 10.55C4.03 10.2 3.94 9.81 4.03 9.38L5.06 5M9.05 5H11V9.7C11 10.05 10.89 10.35 10.64 10.62C10.39 10.88 10.08 11 9.7 11C9.36 11 9.07 10.88 8.84 10.59S8.5 10 8.5 9.66V9.5L9.05 5M13 5H14.95L15.5 9.5C15.58 9.92 15.5 10.27 15.21 10.57C14.95 10.87 14.61 11 14.2 11C13.89 11 13.61 10.88 13.36 10.62C13.11 10.35 13 10.05 13 9.7V5M7.45 12.05C8.08 12.67 8.86 13 9.8 13C10.64 13 11.38 12.67 12 12.05C12.69 12.67 13.45 13 14.3 13C15.17 13 15.92 12.67 16.55 12.05C17.11 12.67 17.86 13 18.8 13H19.03V19H5V13H5.25C6.16 13 6.89 12.67 7.45 12.05Z" />
                                </svg>
                            </span>
                            <div class="tw-grid">
                                <div class="tw-truncate" :title="item.business.name">
                                    @{{ item.business.name }}
                                </div>
                            </div>
                        </div>
                        <div class="tw-flex">
                            <div class="tw-w-4 tw-h-4 tw-mr-1">
                                <svg style="width:16px;height:16px" viewBox="0 0 24 24" class="tw-text-gray-400">
                                    <path fill="currentColor" d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z" />
                                </svg>
                            </div>
                            <div>
                                <div class="tw-text-xs tw-font-light tw-text-gray-700 bd-truncate-overflow-sm" :title="item.business.full_address">
                                    @{{ item.business.full_address }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <v-pagination
            v-model="options.page"
            :length="pagination.last_page"
            :total-visible="6"
            color="#2563EB"
        ></v-pagination>
    </template>
</v-data-iterator>
