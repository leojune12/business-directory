<div class="tw-flex tw-items-center tw-justify-between">
    <div class="tw-mb-0 tw-text-xl tw-font-bold">
        Products
    </div>
    <div class="tw-flex tw-items-center tw-gap-1 top-pagination">
        <div class="tw-text-sm tw-text-gray-500">
            @{{ pagination.current_page }}/@{{ pagination.last_page }}
        </div>
        <v-pagination
            v-model="options.page"
            :length="pagination.last_page"
            :total-visible="0"
            :disabled="loading"
        ></v-pagination>
    </div>
</div>
