<x-layout :pageName="'Login'">
    <x-auth-card>
        {{-- Logo Slot (optional) --}}
        {{-- <x-slot name="logo">
            <a href="/" class="inline-block mb-5">
                <img src="{{ asset('images/logo/logo-dark.svg') }}" alt="Logo" class="dark:hidden h-10" />
                <img src="{{ asset('images/logo/logo.svg') }}" alt="Logo" class="hidden dark:block h-10" />
            </a>
        </x-slot> --}}

        <x-auth-heading title="Sign In" subtitle="Login to access your account" />

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <!-- Key -->
            <x-form-input id="email" name="key" type="key" label="Email or username"
                placeholder="Enter your Email or Username" :value="old('email')" required autofocus :iconSvg="'<svg class=\'fill-current\' width=\'22\' height=\'22\' viewBox=\'0 0 22 22\' fill=\'none\' xmlns=\'http://www.w3.org/2000/svg\'><g opacity=\'0.5\'><path d=\'M19.2516 3.30005H2.75156C1.65156 3.30005 0.751562 4.20005 0.751562 5.30005V16.7C0.751562 17.8 1.65156 18.7 2.75156 18.7H19.2516C20.3516 18.7 21.2516 17.8 21.2516 16.7V5.30005C21.2516 4.20005 20.3516 3.30005 19.2516 3.30005ZM19.2516 4.80005C19.2828 4.80005 19.3128 4.80155 19.3432 4.80455L11.0016 10.3846L2.66003 4.80455C2.69034 4.80155 2.72034 4.80005 2.75156 4.80005H19.2516ZM19.2516 17.2H2.75156C2.47031 17.2 2.25156 16.9813 2.25156 16.7V6.9188L10.5244 12.2331C10.6716 12.3313 10.8366 12.3846 11.0016 12.3846C11.1666 12.3846 11.3316 12.3313 11.4788 12.2331L19.7516 6.9188V16.7C19.7516 16.9813 19.5328 17.2 19.2516 17.2Z\' fill=\'currentColor\'/></g></svg>'" />

            <!-- Password -->
            <div class="mb-4.5">
                <label for="password" class="mb-2.5 block font-medium text-black dark:text-white">Password</label>
                <div class="relative">
                    <span class="absolute left-4.5 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </span>
                    <input id="password" name="password" type="password" placeholder="Enter your password" required
                        class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-12 text-black focus:border-primary focus-visible:outline-none dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary @error('password') !border-red-500 @enderror">
                    <!-- Hidden Checkbox -->
                    <input type="checkbox" id="togglePasswordCheckbox" class="hidden">
                    <!-- Label acting as a button for the hidden checkbox -->
                    <label for="togglePasswordCheckbox" id="togglePasswordLabel" aria-label="Toggle password visibility"
                        class="absolute inset-y-0 right-0 flex items-center pr-4 cursor-pointer text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                        <span id="togglePasswordShowIcon" class="w-5 h-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                        <span id="togglePasswordHideIcon" class="w-5 h-5 hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.243 4.243l-4.243-4.243" />
                            </svg>
                        </span>
                    </label>
                </div>
                @error('password')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6 flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary-dark dark:border-form-strokedark dark:bg-form-input dark:focus:ring-offset-gray-800">
                    <label for="remember" class="ml-2 text-sm font-medium text-black dark:text-white">
                        Remember me
                    </label>
                </div>
                {{-- <a href="route('password.request')" class="text-sm font-medium text-primary hover:underline"> Replace with your forgot password route --}}
                {{-- Forgot password? --}}
                {{-- </a> --}}
            </div>

            <!-- Sign In Button -->
            <div class="mb-5">
                <x-primary-button>
                    Sign In
                </x-primary-button>
            </div>

            <!-- Sign up link -->
            <div class="mt-6 text-center">
                <p class="font-medium text-black dark:text-white">
                    Don’t have an account?
                    <a href="{{ route('register') }}" class="text-primary hover:underline">
                        Sign up
                    </a>
                </p>
            </div>
        </form>
    </x-auth-card>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const toggleCheckbox = document.getElementById('togglePasswordCheckbox');
            const showIcon = document.getElementById('togglePasswordShowIcon');
            const hideIcon = document.getElementById('togglePasswordHideIcon');
            // const toggleLabel = document.getElementById('togglePasswordLabel'); // Optional, if you need to interact with label specifically
            if (passwordInput && toggleCheckbox && showIcon && hideIcon) {
                toggleCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        passwordInput.type = 'text';
                        showIcon.classList.add('hidden');
                        hideIcon.classList.remove('hidden');
                    } else {
                        passwordInput.type = 'password';
                        showIcon.classList.remove('hidden');
                        hideIcon.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</x-layout>
