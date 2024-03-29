@section('title', isset($module) ? ' | ' . $module : '')
<x-app-layout>
    <v-app
        id="app"
        v-cloak
        class="tw-bg-gray-100"
    >
        <div class="tw-z-50">
            @include('browse::business.view_business_components.appbar')
        </div>
        <div>
            @include('browse::business.view_business_components.business-info-header')
        </div>
        <div class="tw-sticky tw-top-0 tw-z-50">
            @include('browse::business.view_business_components.tabs')
            <div class="tw-shadow tw-bg-white tw-h-px">
            </div>
        </div>
        <v-main class="tw-z-0">
            @include('browse::business.view_business_components.business-info-content')
        </v-main>
    </v-app>

    @include('browse::business.view_business_components.assets')
</x-app-layout>
