<x-app-layout>
    <div id="app" class="py-5" v-cloak>
        <v-app>
            <v-main>
                <v-container>

                    <h3 class="mb-5">{{ $module }} List</h3>

                    <v-data-table
                        v-model="selected"
                        :headers="headers"
                        :loading="loading"
                        class="elevation-2"
                        :items="pagination.data"
                        :options.sync="options"
                        :server-items-length="pagination.total"
                        :footer-props="footerProps"
                        item-key="id"
                        show-select
                        checkbox-color="success"
                    >
                        <template v-slot:top>
                            <v-toolbar
                                flat
                            >
                                {{-- <v-btn
                                    color="success"
                                    outlined
                                    :href="url + '/create'"
                                >
                                    <v-icon left>
                                        mdi-plus
                                    </v-icon>
                                    Add {{ $module }}
                                </v-btn> --}}

                                <v-spacer></v-spacer>

                                <v-btn
                                    color="error"
                                    outlined
                                    class="tw-mr-1"
                                    @click="confirmDelete(selected)"
                                    :disabled="!selected.length"
                                >
                                    <v-icon left>
                                        mdi-delete
                                    </v-icon>
                                    Delete <span v-if="selected.length">(@{{ selected.length }})</span>
                                </v-btn>

                                <v-btn
                                    color="primary"
                                    outlined
                                    @click="filterDialog = true"
                                >
                                    <v-icon left>
                                        mdi-filter
                                    </v-icon>
                                    Filter
                                </v-btn>

                            </v-toolbar>
                        </template>

                        <template v-slot:item.actions="{ item }">

                            <div class="tw-flex">

                                <v-menu
                                    offset-y
                                    left
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-btn
                                            icon
                                            v-bind="attrs"
                                            v-on="on"
                                        >
                                            <v-icon>mdi-dots-vertical</v-icon>
                                        </v-btn>
                                    </template>

                                    <v-list flat>

                                        <v-list-item
                                            dense
                                            ripple
                                            :href="url + '/' + item.id"
                                            class="hover:tw-bg-gray-200"
                                        >
                                            <v-list-item-icon>
                                                <v-icon
                                                    v-text="'mdi-eye'"
                                                ></v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-content>
                                                <v-list-item-title v-text="'View'"></v-list-item-title>
                                            </v-list-item-content>
                                        </v-list-item>

                                        <v-list-item
                                            dense
                                            ripple
                                            :href="url + '/' + item.id + '/edit'"
                                            class="hover:tw-bg-gray-200"
                                        >
                                            <v-list-item-icon>
                                                <v-icon
                                                    v-text="'mdi-pencil'"
                                                ></v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-content>
                                                <v-list-item-title v-text="'Edit'"></v-list-item-title>
                                            </v-list-item-content>
                                        </v-list-item>

                                        <v-list-item
                                            dense
                                            link
                                            ripple
                                            class="hover:tw-bg-gray-200"
                                            @click="confirmDelete(item.id)"
                                        >
                                            <v-list-item-icon>
                                                <v-icon
                                                    v-text="'mdi-delete'"
                                                ></v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-content>
                                                <v-list-item-title
                                                    v-text="'Delete'"
                                                ></v-list-item-title>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-list>
                                </v-menu>
                            </div>
                        </template>
                    </v-data-table>
                </v-container>
            </v-main>

            @include('businesses::index_components.filter_dialog')

        </v-app>
    </div>

    @include('businesses::index_components.assets')

</x-app-layout>
