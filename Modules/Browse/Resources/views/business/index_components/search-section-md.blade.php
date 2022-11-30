{{-- <div class="tw-mb-4 tw-font-semibold">
    Search Products
</div> --}}
<div class="tw-mb-4">
    <v-combobox
        placeholder="Search Business"
        prepend-inner-icon="mdi-storefront-outline"
        solo
        hide-details
        :items="businessItems"
        :search-input.sync="advanceFilters.business_name"
        v-on:keyup.enter="search()"
        v-on:keydown="showBusinessNames()"
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
