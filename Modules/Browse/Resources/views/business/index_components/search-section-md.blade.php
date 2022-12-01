<div class="tw-bg-white tw-px-4 tw-py-7 tw-drop-shadow-md tw-rounded-lg">
{{-- <div class="tw-mb-4 tw-font-semibold">
        Search Products
    </div> --}}
    <div class="tw-mb-4">
        <v-combobox
            placeholder="Search Business"
            solo
            hide-details
            :items="businessItems"
            :search-input.sync="advanceFilters.business_name"
            v-on:keyup.enter="search()"
            v-on:keydown="showBusinessNames()"
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
    <div class="tw-mb-4">
        <v-autocomplete
            v-model="advanceFilters.category_id"
            placeholder="Category"
            solo
            hide-details
            :items="categories"
            v-on:keyup.enter="search()"
            item-value="id"
            item-text="name"
            clearable
            class="toolbar-search-input tw-border tw-border-gray-300"
        ></v-autocomplete>
    </div>
    {{-- <div
        v-if="advanceFilters.category_id"
        class="tw-mb-4"
    >
        <v-autocomplete
            v-model="advanceFilters.subcategory_id"
            placeholder="Subcategory"
            solo
            hide-details
            :items="subcategories"
            :search-input.sync="advanceFilters.subcategory_id"
            v-on:keyup.enter="search()"
            item-value="id"
            item-text="name"
            :loading="subcategoryLoading"
            clearable
        ></v-autocomplete>
    </div> --}}
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
