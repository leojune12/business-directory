<div class="tw-bg-white">
    <v-container
        class="tw-py-0- tw-flex tw-justify-center"
    >
        <v-row>
            <v-col
                cols="12"
                md="3"
                class="tw-py-0 md:tw-flex tw-block md:tw-items-center"
            >
                <div
                    v-if="showInfoOnTab"
                >
                    <div
                        class="tw-flex tw-items-center tw-pt-2 md:tw-pt-0"
                    >
                        <div class="md:tw-mr-6 tw-mr-3">
                            <img
                                src="https://api.lorem.space/image/burger?w=150&h=150"
                                alt=""
                                class="tw-w-10 tw-h-10 tw-rounded-full tw-border-x tw-border-gray-400"
                            >
                        </div>
                        <div
                            class="tw-text-xl tw-font-bold tw-text-center md:tw-text-start"
                        >
                            @{{ business.name }}
                        </div>
                    </div>
                    <div
                        v-if="$vuetify.breakpoint.mdAndDown"
                        class="tw-h-px tw-w-full tw-bg-gray-200 tw-mt-2 md:tw-mt-0"
                    ></div>
                </div>
            </v-col>
            <v-col
                cols="12"
                md="6"
                class="tw-py-0"
            >
                <ul class="tw-flex tw-flex-wrap tw--mb-px tw-text-sm tw-font-medium tw-justify-center tw-pl-0">
                    <li class="mr-2">
                        <a href="#" class="md:tw-p-4 tw-py-3 tw-px-4 tw-rounded-t-lg tw-text-blue-500 hover:tw-text-blue-600 tw-group tw-no-underline tw-flex tw-items-center tw-justify-center tw-gap-x-2">
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z" />
                            </svg>
                            <span class="md:tw-block tw-hidden">
                                About
                            </span>
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="#" class="md:tw-p-4 tw-py-3 tw-px-4 tw-rounded-t-lg tw-text-gray-400 hover:tw-text-blue-500 tw-group tw-no-underline tw-flex tw-items-center tw-justify-center tw-gap-x-2" aria-current="page">
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19 6H17C17 3.2 14.8 1 12 1S7 3.2 7 6H5C3.9 6 3 6.9 3 8V20C3 21.1 3.9 22 5 22H19C20.1 22 21 21.1 21 20V8C21 6.9 20.1 6 19 6M12 3C13.7 3 15 4.3 15 6H9C9 4.3 10.3 3 12 3M19 20H5V8H19V20M12 12C10.3 12 9 10.7 9 9H7C7 11.8 9.2 14 12 14S17 11.8 17 9H15C15 10.7 13.7 12 12 12Z" />
                            </svg>
                            <span class="md:tw-block tw-hidden">
                                Products
                            </span>
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="#" class="md:tw-p-4 tw-py-3 tw-px-4 tw-rounded-t-lg tw-text-gray-400 hover:tw-text-blue-500 tw-group tw-no-underline tw-flex tw-items-center tw-justify-center tw-gap-x-2" aria-current="page">
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M21.71 20.29L20.29 21.71A1 1 0 0 1 18.88 21.71L7 9.85A3.81 3.81 0 0 1 6 10A4 4 0 0 1 2.22 4.7L4.76 7.24L5.29 6.71L6.71 5.29L7.24 4.76L4.7 2.22A4 4 0 0 1 10 6A3.81 3.81 0 0 1 9.85 7L21.71 18.88A1 1 0 0 1 21.71 20.29M2.29 18.88A1 1 0 0 0 2.29 20.29L3.71 21.71A1 1 0 0 0 5.12 21.71L10.59 16.25L7.76 13.42M20 2L16 4V6L13.83 8.17L15.83 10.17L18 8H20L22 4Z" />
                            </svg>
                            <span class="md:tw-block tw-hidden">
                                Services
                            </span>
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="#" class="md:tw-p-4 tw-py-3 tw-px-4 tw-rounded-t-lg tw-text-gray-400 hover:tw-text-blue-500 tw-group tw-no-underline tw-flex tw-items-center tw-justify-center tw-gap-x-2" aria-current="page">
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M20 7H16V5L14 3H10L8 5V7H4C2.9 7 2 7.9 2 9V14C2 14.75 2.4 15.38 3 15.73V19C3 20.11 3.89 21 5 21H19C20.11 21 21 20.11 21 19V15.72C21.59 15.37 22 14.73 22 14V9C22 7.9 21.1 7 20 7M10 5H14V7H10V5M4 9H20V14H15V11H9V14H4V9M13 15H11V13H13V15M19 19H5V16H9V17H15V16H19V19Z" />
                            </svg>
                            <span class="md:tw-block tw-hidden">
                                Jobs
                            </span>
                        </a>
                    </li>
                </ul>
            </v-col>
        </v-row>

    </v-container>
</div>
