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
                                <v-row class="mb-4">
                                    <v-col
                                        cols="12"
                                        md="6"
                                        class="tw-py-0"
                                    >
                                        <h6>
                                            Category
                                        </h6>
                                        <div>
                                            <v-chip
                                                class="mr-1 mb-1"
                                                color="primary"
                                                outlined
                                                v-for="category in formData.categories"
                                            >
                                                @{{ category.name }}
                                            </v-chip>
                                        </div>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col
                                        cols="12"
                                        md="6"
                                        class="tw-py-0"
                                    >
                                        <v-text-field
                                            filled
                                            v-model="formData.user.full_name"
                                            label="Owner"
                                            readonly
                                        ></v-text-field>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        md="6"
                                        class="tw-py-0"
                                    >
                                        <v-text-field
                                            filled
                                            v-model="formData.name"
                                            label="Business Name"
                                            readonly
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col
                                        cols="12"
                                        md="6"
                                        class="tw-py-0"
                                    >
                                        <v-text-field
                                            filled
                                            v-model="formData.address"
                                            label="Address"
                                            readonly
                                        ></v-text-field>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        md="6"
                                        class="tw-py-0"
                                    >
                                        <v-text-field
                                            filled
                                            v-model="formData.contact_number"
                                            label="Contact No."
                                            readonly
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col
                                        cols="12"
                                        md="6"
                                        class="tw-py-0"
                                    >
                                        <v-text-field
                                            filled
                                            v-model="formData.website"
                                            label="Website"
                                            readonly
                                        ></v-text-field>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        md="6"
                                        class="tw-py-0"
                                    >
                                        <v-text-field
                                            filled
                                            v-model="formData.facebook_link"
                                            label="Facebook Link"
                                            readonly
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col
                                        cols="12"
                                        md="6"
                                        class="tw-py-0"
                                    >
                                        <v-textarea
                                            filled
                                            v-model="formData.map_location"
                                            label="Map Location"
                                            readonly
                                            auto-grow
                                            rows="1"
                                        ></v-textarea>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        md="6"
                                        class="tw-py-0"
                                    >
                                        <v-textarea
                                            filled
                                            v-model="formData.description"
                                            label="Description"
                                            readonly
                                            auto-grow
                                            rows="1"
                                        ></v-textarea>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col
                                        cols="12"
                                        md="12"
                                        class="tw-py-0"
                                    >
                                        <v-btn
                                            outlined
                                            :href="url"
                                        >
                                            Back
                                        </v-btn>
                                        <v-btn
                                            outlined
                                            :href="url+'/'+formData.id+'/edit'"
                                            color="success"
                                        >
                                            Edit
                                        </v-btn>
                                    </v-col>
                                </v-row>
                            </v-col>
                            <v-col
                                cols="12"
                                md="4"
                            >
                                <iframe :src="formData.map_location" width="100%" height="550px" frameborder="0" style="border:0; border-radius: 23px; " allowfullscreen=""></iframe>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-form>
            </v-main>
        </v-app>
    </div>

    @include('businesses::show_components.assets')

</x-app-layout>
