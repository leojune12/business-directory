<v-container
    class="tw-py-6 md:tw-py-10"
>
    <v-row>
        <v-col
            cols="12"
            md="6"
            offset-md="1"
        >
            <div class="tw-bg-white md:tw-p-6 tw-p-4 tw-rounded-md">
                <div class="tw-mb-7">
                    <div class="tw-font-bold tw-mb-2 tw-text-lg">
                        Category
                    </div>
                    <div class="tw-flex tw-items-center tw-text-sm tw-text-gray-600">
                        <svg style="width:16px;height:16px" viewBox="0 0 24 24" class="tw-mr-3">
                            <path fill="currentColor" d="M19,5V7H15V5H19M9,5V11H5V5H9M19,13V19H15V13H19M9,17V19H5V17H9M21,3H13V9H21V3M11,3H3V13H11V3M21,11H13V21H21V11M11,15H3V21H11V15Z" />
                        </svg>
                        @{{ business.category_name }}
                    </div>
                </div>
                <div class="tw-mb-7">
                    <div class="tw-font-bold tw-mb-2 tw-text-lg">
                        Subcategories
                    </div>
                    <div class="tw-flex tw-items-center tw-text-sm tw-text-gray-600">
                        <ul class="tw-p-0 tw-mb-0">
                            <li
                                v-for="subcategory in subcategories"
                                :key="subcategory.id"
                                class="tw-flex tw-align-center"
                            >
                                @{{ subcategory.name }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tw-mb-7">
                    <div class="tw-font-bold tw-mb-2 tw-text-lg">
                        Contact Info
                    </div>
                    <div class="tw-flex tw-items-start tw-mb-4 tw-text-gray-600">
                        <div>
                            <svg style="width:20px;height:20px" viewBox="0 0 24 24" class="tw-mr-3">
                                <path fill="currentColor" d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z" />
                            </svg>
                        </div>
                        <div>
                            <div class="tw-text-sm">
                                @{{ business.full_address }}
                            </div>
                            <div class="tw-text-xs">
                                Address
                            </div>
                        </div>
                    </div>
                    <div class="tw-flex tw-items-start tw-mb-4 tw-text-gray-600">
                        <div>
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24" class="tw-mr-3">
                                <path fill="currentColor" d="M6.62,10.79C8.06,13.62 10.38,15.94 13.21,17.38L15.41,15.18C15.69,14.9 16.08,14.82 16.43,14.93C17.55,15.3 18.75,15.5 20,15.5A1,1 0 0,1 21,16.5V20A1,1 0 0,1 20,21A17,17 0 0,1 3,4A1,1 0 0,1 4,3H7.5A1,1 0 0,1 8.5,4C8.5,5.25 8.7,6.45 9.07,7.57C9.18,7.92 9.1,8.31 8.82,8.59L6.62,10.79Z" />
                            </svg>
                        </div>
                        <div>
                            <div class="tw-text-sm">
                                @{{ business.contact_number }}
                            </div>
                            <div class="tw-text-xs">
                                Phone
                            </div>
                        </div>
                    </div>
                    <div class="tw-flex tw-items-start tw-mb-4 tw-text-gray-600">
                        <div>
                            <svg style="width:20px;height:20px" viewBox="0 0 24 24" class="tw-mr-3">
                                <path fill="currentColor" d="M22 6C22 4.9 21.1 4 20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6M20 6L12 11L4 6H20M20 18H4V8L12 13L20 8V18Z" />
                            </svg>
                        </div>
                        <div>
                            <div class="tw-text-sm">
                                @{{ business.email }}
                            </div>
                            <div class="tw-text-xs">
                                Email
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tw-mb-7">
                    <div class="tw-font-bold tw-mb-2 tw-text-lg">
                        Website and Links
                    </div>
                    <div class="tw-flex tw-items-start tw-mb-4 tw-text-gray-600">
                        <div>
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24" class="tw-mr-3">
                                <path fill="currentColor" d="M16.36,14C16.44,13.34 16.5,12.68 16.5,12C16.5,11.32 16.44,10.66 16.36,10H19.74C19.9,10.64 20,11.31 20,12C20,12.69 19.9,13.36 19.74,14M14.59,19.56C15.19,18.45 15.65,17.25 15.97,16H18.92C17.96,17.65 16.43,18.93 14.59,19.56M14.34,14H9.66C9.56,13.34 9.5,12.68 9.5,12C9.5,11.32 9.56,10.65 9.66,10H14.34C14.43,10.65 14.5,11.32 14.5,12C14.5,12.68 14.43,13.34 14.34,14M12,19.96C11.17,18.76 10.5,17.43 10.09,16H13.91C13.5,17.43 12.83,18.76 12,19.96M8,8H5.08C6.03,6.34 7.57,5.06 9.4,4.44C8.8,5.55 8.35,6.75 8,8M5.08,16H8C8.35,17.25 8.8,18.45 9.4,19.56C7.57,18.93 6.03,17.65 5.08,16M4.26,14C4.1,13.36 4,12.69 4,12C4,11.31 4.1,10.64 4.26,10H7.64C7.56,10.66 7.5,11.32 7.5,12C7.5,12.68 7.56,13.34 7.64,14M12,4.03C12.83,5.23 13.5,6.57 13.91,8H10.09C10.5,6.57 11.17,5.23 12,4.03M18.92,8H15.97C15.65,6.75 15.19,5.55 14.59,4.44C16.43,5.07 17.96,6.34 18.92,8M12,2C6.47,2 2,6.5 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                            </svg>
                        </div>
                        <div>
                            <div class="tw-text-sm">
                                <a target="_blank" :href="business.website">
                                    @{{ business.website }}
                                </a>
                            </div>
                            <div class="tw-text-xs">
                                Website
                            </div>
                        </div>
                    </div>
                    <div class="tw-flex tw-items-start tw-mb-4 tw-text-gray-600">
                        <div>
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24" class="tw-mr-3">
                                <path fill="currentColor" d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z" />
                            </svg>
                        </div>
                        <div>
                            <div class="tw-text-sm">
                                <a target="_blank" :href="business.facebook_link">
                                    @{{ business.facebook_link }}
                                </a>
                            </div>
                            <div class="tw-text-xs">
                                Facebook
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tw-mb-7">
                    <div class="tw-font-bold tw-mb-2 tw-text-lg">
                        Description
                    </div>
                    <div class="tw-flex tw-items-start tw-mb-4 tw-text-gray-600">
                        <div>
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24" class="tw-mr-3">
                                <path fill="currentColor" d="M13,9H11V7H13M13,17H11V11H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                            </svg>
                        </div>
                        <div>
                            <div class="tw-text-sm">
                                @{{ business.description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </v-col>
        <v-col
            cols="12"
            md="4"
            {{-- offset-md="1" --}}
        >
            <iframe :src="business.map_location" width="100%" height="550px" frameborder="0" class="tw-p-0 tw-rounded-md" allowfullscreen=""></iframe>
        </v-col>
    </v-row>
</v-container>
