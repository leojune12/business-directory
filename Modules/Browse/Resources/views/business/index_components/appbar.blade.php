<div class="tw-bg-blue-600">
    <v-container
        class="tw-p-0"
    >
        <v-toolbar
            color="transparent"
            flat
            :height="$vuetify.breakpoint.smAndDown ? 60 : 72"
            {{-- extension-height="64" --}}
        >
            <a href="/" class="tw-flex tw-items-center">
                <v-avatar
                    color="white"
                    size="36"
                    class="tw-mr-2"
                >
                    <span class="dark--text text-h5">RI</span>
                </v-avatar>

                <v-toolbar-title
                    class="tw-mr-6 white--text sm:tw-block tw-hidden"
                >
                    Roxas Index
                </v-toolbar-title>
            </a>

            <div
                v-if=!$vuetify.breakpoint.smAndDown
                class="tw-flex"
            >
                <div class="tw-w-60 tw-mr-1">
                    <v-combobox
                        placeholder="Search Business"
                        {{-- append-icon="mdi-magnify" --}}
                        solo
                        hide-details
                        :items="businessItems"
                        :search-input.sync="advanceFilters.business_name"
                        v-on:keyup.enter="search()"
                        v-on:keydown="showBusinessNames()"
                        item-text="name"
                        :loading="searchLoading"
                        clearable
                        dense
                        class="toolbar-search-input tw-border"
                    ></v-combobox>
                </div>
                <div class="tw-w-60 tw-mr-1">
                    <v-combobox
                        placeholder="Location"
                        {{-- prepend-inner-icon="mdi-map-marker-radius" --}}
                        solo
                        hide-details
                        :items="locationItems"
                        :search-input.sync="advanceFilters.location"
                        v-on:keyup.enter="search()"
                        v-on:keydown="showLocationNames()"
                        item-text="address"
                        :loading="locationLoading"
                        clearable
                        dense
                        class="toolbar-search-input tw-border"
                    ></v-combobox>
                </div>
                <div>
                    <v-btn
                        height="40"
                        @click="search()"
                        color="white"
                        outlined
                    >
                        <v-icon>mdi-magnify</v-icon>
                        Search
                    </v-btn>
                </div>
            </div>

            <v-spacer></v-spacer>

            @include('browse::business.index_components.search-section')

            @auth
            <v-menu
                open-on-hover
                offset-y
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                        text
                        dark
                        v-bind="attrs"
                        v-on="on"
                    >
                        {{ Auth::user()->first_name }}
                        <v-icon>mdi-chevron-down</v-icon>
                    </v-btn>
                </template>

                <v-list class="tw-p-0">
                    <v-list-item>
                        <v-list-item-title>
                            <form
                                method="POST"
                                action="{{ route('logout') }}"
                            >
                                @csrf

                                <button type="submit" class="tw-text-sm tw-flex tw-items-center tw-gap-3 tw-text-gray-500 hover:tw-text-gray-600">
                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M14.08,15.59L16.67,13H7V11H16.67L14.08,8.41L15.5,7L20.5,12L15.5,17L14.08,15.59M19,3A2,2 0 0,1 21,5V9.67L19,7.67V5H5V19H19V16.33L21,14.33V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V5C3,3.89 3.89,3 5,3H19Z" />
                                    </svg>
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
            @endauth

            @guest
            <div class="tw-flex">
                <v-btn
                    text
                    dark
                    class="px-2"
                    href="/login"
                >
                    Sign in
                </v-btn>
                <v-btn
                    text
                    dark
                    class="px-2"
                    href="/register"
                >
                    Register
                </v-btn>
            </div>
            @endguest
        </v-toolbar>
    </v-container>
</div>
