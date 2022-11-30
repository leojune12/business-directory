<v-dialog
    v-if="$vuetify.breakpoint.smAndDown"
    {{-- transition="dialog-top-transition" --}}
    max-width="600"
>
    <template v-slot:activator="{ on, attrs }">
        <v-btn
            icon
            color="white"
            large
            v-bind="attrs"
            v-on="on"
        >
            <v-icon>mdi-magnify</v-icon>
        </v-btn>
    </template>
    <template v-slot:default="dialog">
        <v-card>
            <v-card-text
                class="tw-py-5"
            >
                <div class="tw-mb-5 tw-flex tw-items-center tw-justify-between">
                    <h5 class="tw-mb-0">
                        {{-- Search In Capiz --}}
                    </h5>
                    <v-btn
                        icon
                        @click="dialog.value = false"
                    >
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </div>
                <div class="tw-mb-5">
                    <v-combobox
                        placeholder="Search Product"
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
                    ></v-combobox>
                </div>
                <div class="tw-mb-5">
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
                    ></v-combobox>
                </div>
                <div>
                    <v-btn
                        {{-- outlined --}}
                        color="primary"
                        block
                        large
                        class="tw-h-12"
                        elevation="2"
                        @click="search(dialog)"
                    >
                        <v-icon>mdi-magnify</v-icon>
                        Search
                    </v-btn>
                </div>
            </v-card-text>
        </v-card>
    </template>
</v-dialog>
