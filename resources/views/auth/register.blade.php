<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="tw-w-20 tw-h-20 tw-fill-current tw-text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- First Name -->
            <div>
                <x-input-label for="first_name" :value="__('First Name')" />

                <x-text-input id="first_name" class="tw-block tw-mt-1 tw-w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />

                <x-input-error :messages="$errors->get('first_name')" class="tw-mt-2" />
            </div>

            <!-- Last Name -->
            <div class="tw-mt-4">
                <x-input-label for="last_name" :value="__('Last Name')" />

                <x-text-input id="last_name" class="tw-block tw-mt-1 tw-w-full" type="text" name="last_name" :value="old('last_name')" required autofocus />

                <x-input-error :messages="$errors->get('last_name')" class="tw-mt-2" />
            </div>

            <!-- Email Address -->
            <div class="tw-mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="tw-block tw-mt-1 tw-w-full" type="email" name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="tw-mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="tw-block tw-mt-1 tw-w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="tw-mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="tw-mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="tw-block tw-mt-1 tw-w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="tw-mt-2" />
            </div>

            <div class="tw-flex tw-items-center tw-justify-end tw-mt-4">
                <a class="tw-underline tw-text-sm tw-text-gray-600 hover:tw-text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="tw-ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
