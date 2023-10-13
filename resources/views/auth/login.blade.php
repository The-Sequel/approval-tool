@vite(['resources/css/style.css', 'resources/js/customers.js'])

<div class="grid">
    <div class="col-12">
        <div class="login-container">

            <div class="login-logo">
                <a href="https://www.thesequel.nl" target="_blank"><img width="200" height="122" src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" class="attachment-full size-full entered lazyloaded" alt="" decoding="async" data-lazy-src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" data-ll-status="loaded"></a>
            </div>

            <form action="{{route('login')}}" method="POST">
                @csrf
                @method('POST')
            
                <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            
                <!-- Password -->
                <div class="form-group">
                    <x-input-label for="password" :value="__('Password')" />
            
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
            
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            
                <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
            
                    <div class="">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
            
                        <x-primary-button class="button">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .login-container {
        width: 500px;
        margin: 0 auto;
        margin-top: 200px;
        display: flex;
        flex-direction: column;
        align-items: center; /* Center horizontally */
        justify-content: center; /* Center vertically */
    }

    .login-logo {
        margin-bottom: 20px; /* Add some spacing between the logo and the form */
    }

    .login-logo img {
        width: 200px;
        height: auto; /* Maintain aspect ratio */
    }

    .button{
        width: 60px;
    }
</style>