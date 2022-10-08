@section('title', isset($module) ? ' | ' . $module : '')
<x-app-layout>
    <div id="app" class="py-5" v-cloak>
        <v-app>
            <v-main>
                <v-form>
                    <v-container>

                        <h3 class="tw-mb-10">{{ $method . " " . $module }}</h3>

                        <v-row class="mb-4">
                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                {{-- <h6>
                                    Category
                                </h6>
                                <div>
                                    <v-chip
                                        class="mr-2 mb-2"
                                        color="primary"
                                        outlined
                                        v-for="category in formData.categories"
                                    >
                                        @{{ category.name }}
                                    </v-chip>
                                </div> --}}
                                <v-autocomplete
                                    v-model="formData.model_categories"
                                    :items="categories"
                                    chips
                                    color="blue-grey lighten-2"
                                    label="Category"
                                    item-text="name"
                                    item-value="id"
                                    multiple
                                    disable-lookup
                                    deletable-chips
                                    :error-messages="categoryErrorMessage"
                                >
                                </v-autocomplete>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-text-field
                                    filled
                                    readonly
                                    v-model="formData.user.full_name"
                                    label="Owner"
                                ></v-text-field>
                            </v-col>

                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-text-field
                                    v-model="formData.name"
                                    label="Business Name"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-text-field
                                    v-model="formData.address"
                                    label="Address"
                                ></v-text-field>
                            </v-col>

                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-text-field
                                    v-model="formData.contact_number"
                                    label="Contact No."
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-text-field
                                    v-model="formData.website"
                                    label="Website"
                                ></v-text-field>
                            </v-col>

                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-text-field
                                    v-model="formData.facebook_link"
                                    label="Facebook Link"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-textarea
                                    v-model="formData.map_location"
                                    label="Map Location"
                                    auto-grow
                                    rows="1"
                                ></v-textarea>
                            </v-col>

                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-textarea
                                    v-model="formData.description"
                                    label="Description"
                                    auto-grow
                                    rows="1"
                                ></v-textarea>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-btn
                                    {{-- color="primary" --}}
                                    outlined
                                    :href="url"
                                >
                                    Back
                                </v-btn>
                                <v-btn
                                    color="primary"
                                    outlined
                                    @click="submit()"
                                >
                                    Submit
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-form>
            </v-main>
        </v-app>
    </div>

    @include('businesses::form_components.assets')

</x-app-layout>
