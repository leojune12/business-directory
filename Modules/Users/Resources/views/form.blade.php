@section('title', isset($module) ? ' | ' . $module : '')
<x-app-layout>
    <div id="app" class="py-5" v-cloak>
        <v-app>
            <v-main>
                <v-form>
                    <v-container>

                        <h3 class="mb-5">{{ $method . " " . $module }}</h3>

                        <v-row>
                            <v-col
                                cols="12"
                                md="4"
                            >
                                <v-text-field
                                    v-model="formData.first_name"
                                    label="First name"
                                    :error-messages="errors?.first_name?.[0]"
                                ></v-text-field>
                            </v-col>

                            <v-col
                                cols="12"
                                md="4"
                            >
                                <v-text-field
                                    v-model="formData.last_name"
                                    label="Last name"
                                    :error-messages="errors?.last_name?.[0]"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col
                                cols="12"
                                md="4"
                            >
                                <v-text-field
                                    v-model="formData.email"
                                    label="E-mail"
                                    :error-messages="errors?.email?.[0]"
                                ></v-text-field>
                            </v-col>

                            <v-col
                                cols="12"
                                md="4"
                            >
                                <v-select
                                    v-model="formData.role"
                                    :items="roles"
                                    label="Role"
                                    :error-messages="errors?.role?.[0]"
                                ></v-select>
                            </v-col>
                        </v-row>
                        {{-- <v-row>
                            <v-col
                                cols="12"
                                md="4"
                            >
                                <v-text-field
                                    v-model="formData.password"
                                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                    :type="showPassword ? 'text' : 'password'"
                                    label="{{ $method == 'Update' ? 'New ' : '' }}Password"
                                    hint="At least 8 characters"
                                    @click:append="showPassword = !showPassword"
                                    :error-messages="errors?.password?.[0]"
                                ></v-text-field>
                            </v-col>
                        </v-row> --}}
                        <v-row>
                            <v-col
                                cols="12"
                                md="4"
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

    @include('users::form_components.assets')

</x-app-layout>
