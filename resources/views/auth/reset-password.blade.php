<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="tw-w-20 tw-h-20 tw-fill-current tw-text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="tw-block mt-1 tw-w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />

                <x-input-error :messages="$errors->get('email')" class="tw-mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="tw-block tw-mt-1 tw-w-full" type="password" name="password" required />

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

            <div class="tw-flex tw-items-center tw-justify-end mt-4">
                <x-primary-button>
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
