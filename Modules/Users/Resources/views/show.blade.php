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
                                    filled
                                    v-model="formData.first_name"
                                    label="First name"
                                    readonly
                                ></v-text-field>
                            </v-col>

                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-text-field
                                    filled
                                    v-model="formData.last_name"
                                    label="Last name"
                                    readonly
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
                                    filled
                                    v-model="formData.email"
                                    label="E-mail"
                                    readonly
                                ></v-text-field>
                            </v-col>

                            <v-col
                                cols="12"
                                md="4"
                                class="tw-py-0"
                            >
                                <v-text-field
                                    filled
                                    v-model="formData.roles[0].name"
                                    label="Role"
                                    readonly
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
                                    outlined
                                    :href="url"
                                >
                                    Back
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-form>
            </v-main>
        </v-app>
    </div>

    @include('users::show_components.assets')

</x-app-layout>
