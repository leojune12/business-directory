<v-container
    v-if="loading"
>
    <v-row
        class="tw-gap-y-4"
    >
        <v-col
            v-for="n in 2"
            :key="n"
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
    </v-row>
</v-container>
