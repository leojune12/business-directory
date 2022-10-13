@section('title', isset($module) ? ' | ' . $module : '')
<x-app-layout>
    <div id="app" class="py-5" v-cloak>
        <v-app>
            <v-main>
                <v-form>
                    <v-container>

                        <h3 class="tw-mb-10">{{ $method . " " . $module }}</h3>
                        <v-row>
                            <v-col
                                cols="12"
                                md="8"
                            >
                                <h5>
                                    General Information
                                </h5>
                            </v-col>
                        </v-row>

                        <v-row class="mb-4">
                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-text-field
                                    v-model="formData.name"
                                    label="Business Name"
                                    :error-messages="errors?.name?.[0]"
                                ></v-text-field>
                            </v-col>

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
                        </v-row>

                        <v-row class="mb-4">
                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-autocomplete
                                    v-model="formData.category_id"
                                    :items="categories"
                                    color="blue-grey lighten-2"
                                    label="Category"
                                    item-text="name"
                                    item-value="id"
                                >
                                </v-autocomplete>
                            </v-col>

                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-autocomplete
                                    v-model="formData.model_subcategories"
                                    :items="subcategories"
                                    color="blue-grey lighten-2"
                                    label="Subcategory"
                                    item-text="name"
                                    item-value="id"
                                    multiple
                                    :error-messages="subcategoryError"
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
                                <v-textarea
                                    v-model="formData.description"
                                    label="Description"
                                    auto-grow
                                    rows="1"
                                    :error-messages="errors?.description?.[0]"
                                ></v-textarea>
                            </v-col>
                        </v-row>

                        {{-- Divider --}}
                        <v-row>
                            <v-col
                                cols="12"
                                md="8"
                            >
                                <v-divider
                                    color="black"
                                ></v-divider>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col
                                cols="12"
                                md="8"
                            >
                                <h5>
                                    Address Information
                                </h5>
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
                                    v-model="region"
                                    label="Region"
                                ></v-text-field>
                            </v-col>

                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-text-field
                                    filled
                                    readonly
                                    v-model="province"
                                    label="Province"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-autocomplete
                                    clearable
                                    v-model="formData.city_id"
                                    :items="cities"
                                    item-text="citymunDesc"
                                    item-value="citymunCode"
                                    label="City / Municipality"
                                    :error-messages="errors?.city_id?.[0]"
                                >
                                </v-autocomplete>
                            </v-col>

                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-autocomplete
                                    clearable
                                    v-model="formData.barangay_id"
                                    :items="barangays"
                                    item-text="brgyDesc"
                                    item-value="brgyCode"
                                    label="Barangay"
                                    :error-messages="errors?.barangay_id?.[0]"
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
                                    v-model="formData.street"
                                    label="Street (optional)"
                                    :error-messages="errors?.street?.[0]"
                                ></v-text-field>
                            </v-col>

                        </v-row>

                        {{-- Divider --}}
                        <v-row>
                            <v-col
                                cols="12"
                                md="8"
                            >
                                <v-divider
                                    color="black"
                                ></v-divider>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col
                                cols="12"
                                md="8"
                            >
                                <h5>
                                    Contact Information
                                </h5>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-text-field
                                    v-model="formData.contact_number"
                                    label="Contact No."
                                    :error-messages="errors?.contact_number?.[0]"
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
                                    :error-messages="errors?.facebook_link?.[0]"
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
                                    :error-messages="errors?.website?.[0]"
                                ></v-text-field>
                            </v-col>

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
                                    :error-messages="errors?.map_location?.[0]"
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
