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
                                <v-row>
                                    <v-col
                                        cols="12"
                                        md="6"
                                        class="tw-py-0"
                                    >
                                        <v-text-field
                                            filled
                                            v-model="formData.name"
                                            label="Name"
                                            readonly
                                        ></v-text-field>
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
                        </v-row>
                    </v-container>
                </v-form>
            </v-main>
        </v-app>
    </div>

    @include('address::show_components.assets')

</x-app-layout>
