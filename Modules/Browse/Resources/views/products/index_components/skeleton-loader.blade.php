<div
    v-if="loading"
    class="tw-flex tw-flex-wrap tw-animate-pulse"
>
    <div
        v-for="n in 6"
        :key="n"
        class="tw-w-1/2 md:tw-w-1/3 md:tw-p-2 tw-p-1"
    >
        <div class="tw-bg-white tw-rounded-sm tw-overflow-hidden tw-drop-shadow tw-w-full">
            <div class="tw-w-full tw-h-40 tw-bg-slate-300"></div>
            <div class="tw-p-2">
                <div class="tw-h-3 tw-bg-slate-300 tw-mb-2 tw-w-4/5"></div>
                <div class="tw-h-4 tw-bg-slate-300 tw-w-1/3"></div>
            </div>
        </div>
    </div>
</div>
