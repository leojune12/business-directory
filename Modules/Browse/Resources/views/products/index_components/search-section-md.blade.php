<div class="tw-mb-4 tw-font-semibold">
    Search Products
</div>
<div class="tw-mb-4">
    <v-combobox
        placeholder="Enter Product Name"
        prepend-inner-icon="mdi-shopping-outline"
        solo
        hide-details
        :items="productItems"
        :search-input.sync="advanceFilters.product_name"
        v-on:keyup.enter="search()"
        v-on:keydown="showProductNames()"
        item-text="name"
        :loading="searchLoading"
        clearable
        {{-- dense --}}
        class="toolbar-search-input tw-border"
    ></v-combobox>
</div>
<div class="tw-mb-4">
    <v-combobox
        placeholder="Location"
        prepend-inner-icon="mdi-map-marker-radius"
        solo
        hide-details
        :items="locationItems"
        :search-input.sync="advanceFilters.location"
        v-on:keyup.enter="search()"
        v-on:keydown="showLocationNames()"
        item-text="address"
        :loading="locationLoading"
        clearable
        {{-- dense --}}
        class="toolbar-search-input tw-border"
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
