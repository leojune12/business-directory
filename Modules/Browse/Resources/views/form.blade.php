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
                                md="4"
                                class="tw-py-0"
                            >
                                <v-text-field
                                    v-model="formData.name"
                                    label="Name"
                                    :error-messages="errors?.name?.[0]"
                                ></v-text-field>
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

    @include('browse::form_components.assets')

</x-app-layout>
