@section('title', isset($module) ? ' | ' . $module : '')
<x-app-layout>
    <v-app
        id="app"
        v-cloak
        class="tw-bg-gray-100"
    >
        <div class="tw-z-50">
            @include('businesses::view_business_components.appbar')
        </div>
        <div>
            @include('businesses::view_business_components.business-info-header')
        </div>
        <div class="tw-sticky tw-top-0 tw-z-50">
            @include('businesses::view_business_components.tabs')
        </div>
        <div class="tw-drop-shadow tw-bg-white tw-h-px">
        </div>
        <v-main class="tw-z-0">
            @include('businesses::view_business_components.business-info-content')
        </v-main>
    </v-app>

    @include('businesses::view_business_components.assets')
</x-app-layout>
