<div class="tw-bg-white tw-px-4 tw-py-7 tw-drop-shadow-md tw-rounded-lg">
    {{-- <div class="tw-mb-4 tw-font-semibold">
        Search Products
    </div> --}}
    <div class="tw-mb-4">
        <v-combobox
            placeholder="Search Product"
            solo
            hide-details
            :items="productItems"
            :search-input.sync="advanceFilters.product_name"
            v-on:keyup.enter="search()"
            v-on:keydown="showProductNames()"
            item-text="name"
            :loading="searchLoading"
            clearable
            class="toolbar-search-input tw-border tw-border-gray-300"
        ></v-combobox>
    </div>
    <div class="tw-mb-4">
        <v-combobox
            placeholder="Location"
            solo
            hide-details
            :items="locationItems"
            :search-input.sync="advanceFilters.location"
            v-on:keyup.enter="search()"
            v-on:keydown="showLocationNames()"
            item-text="address"
            :loading="locationLoading"
            clearable
            class="toolbar-search-input tw-border tw-border-gray-300"
        ></v-combobox>
    </div>
    <div>
        <v-btn
            height="48"
            @click="search()"
            color="primary"
            outlined
            block
        >
            <v-icon>mdi-magnify</v-icon>
            Search
        </v-btn>
    </div>
</div>
