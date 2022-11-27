<div class="tw-bg-white">
    <v-container
        {{-- class="tw-py-5" --}}
    >
        <div class="tw-flex md:tw-flex-row tw-flex-col tw-items-center">
            <div class="tw-mr-0 md:tw-mr-6 tw-mb-3 md:tw-mb-0">
                <img
                    src="https://api.lorem.space/image/burger?w=150&h=150"
                    alt=""
                    class="tw-w-32 tw-h-32 tw-rounded-full tw-border-x tw-border-gray-400"
                >
            </div>
            <div>
                <div class="md:tw-text-3xl tw-text-2xl tw-font-bold tw-text-center md:tw-text-start">
                    @{{ business.name }}
                </div>
                {{-- <div class="d-flex tw-text-gray-400">
                    <svg style="width:20px;height:20px" viewBox="0 0 24 24" class="tw-text-gray-400">
                        <path fill="currentColor" d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z" />
                    </svg>
                    @{{ business.full_address }}
                </div> --}}
                <div class="tw-flex tw-mb-1 tw-justify-center md:tw-justify-start">
                    <v-rating
                        v-model="business.rating"
                        readonly
                        background-color="grey"
                        color="warning"
                        dense
                        half-increments
                        hover
                        size="18"
                    ></v-rating>
                    <div class="tw-mt-1 tw-ml-1 tw-text-sm tw-text-gray-500 tw-flex tw-items-center tw-leading-none">
                        {{-- (@{{ business.rating }} Stars) --}}
                        (<a href="#" class="tw-text-gray-500 hover:tw-underline">
                            123 Reviews
                        </a>)
                    </div>
                </div>
            </div>
        </div>
    </v-container>
    <v-container class="tw-py-0">
        <div class="tw-h-px tw-w-full tw-bg-gray-200"></div>
    </v-container>
</div>
