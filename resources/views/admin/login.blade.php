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

            <!-- Email Address -->
            <x-form-input id="email" name="email" type="email" label="Email" placeholder="Enter your email"
                :value="old('email')" required autofocus :iconSvg="'<svg class=\'fill-current\' width=\'22\' height=\'22\' viewBox=\'0 0 22 22\' fill=\'none\' xmlns=\'http://www.w3.org/2000/svg\'><g opacity=\'0.5\'><path d=\'M19.2516 3.30005H2.75156C1.65156 3.30005 0.751562 4.20005 0.751562 5.30005V16.7C0.751562 17.8 1.65156 18.7 2.75156 18.7H19.2516C20.3516 18.7 21.2516 17.8 21.2516 16.7V5.30005C21.2516 4.20005 20.3516 3.30005 19.2516 3.30005ZM19.2516 4.80005C19.2828 4.80005 19.3128 4.80155 19.3432 4.80455L11.0016 10.3846L2.66003 4.80455C2.69034 4.80155 2.72034 4.80005 2.75156 4.80005H19.2516ZM19.2516 17.2H2.75156C2.47031 17.2 2.25156 16.9813 2.25156 16.7V6.9188L10.5244 12.2331C10.6716 12.3313 10.8366 12.3846 11.0016 12.3846C11.1666 12.3846 11.3316 12.3313 11.4788 12.2331L19.7516 6.9188V16.7C19.7516 16.9813 19.5328 17.2 19.2516 17.2Z\' fill=\'currentColor\'/></g></svg>'" />

            <!-- Password -->
            <x-form-input id="password" name="password" type="password" label="Password"
                placeholder="Enter your password" required :iconSvg="'<svg class=\'fill-current\' width=\'22\' height=\'22\' viewBox=\'0 0 22 22\' fill=\'none\' xmlns=\'http://www.w3.org/2000/svg\'><g opacity=\'0.5\'><path d=\'M16.5088 10.5234H5.49117C4.26881 10.5234 3.29117 11.4784 3.29117 12.696V19.0042C3.29117 20.2218 4.26881 21.1768 5.49117 21.1768H16.5088C17.7312 21.1768 18.7088 20.2218 18.7088 19.0042V12.696C18.7088 11.4784 17.7312 10.5234 16.5088 10.5234ZM16.5088 19.6768C16.5088 19.7768 16.4262 19.8594 16.3262 19.8594H5.67373C5.57373 19.8594 5.49117 19.7768 5.49117 19.6768V12.696C5.49117 12.596 5.57373 12.5134 5.67373 12.5134H16.3262C16.4262 12.5134 16.5088 12.596 16.5088 12.696V19.6768Z\' fill=\'currentColor\'/><path d=\'M11.0003 13.8008C10.0453 13.8008 9.26782 14.5783 9.26782 15.5333C9.26782 16.4883 10.0453 17.2658 11.0003 17.2658C11.9553 17.2658 12.7328 16.4883 12.7328 15.5333C12.7328 14.5783 11.9553 13.8008 11.0003 13.8008ZM11.0003 15.9491C10.7728 15.9491 10.5846 15.7608 10.5846 15.5333C10.5846 15.3058 10.7728 15.1175 11.0003 15.1175C11.2278 15.1175 11.4161 15.3058 11.4161 15.5333C11.4161 15.7608 11.2278 15.9491 11.0003 15.9491Z\' fill=\'currentColor\'/><path d=\'M14.2238 10.5234V7.37419C14.2238 5.78336 13.4113 4.34919 12.2113 3.38336C11.9613 3.17419 11.7025 3.00002 11.435 2.86169C11.1588 2.71836 10.8575 2.63919 10.5525 2.63919C9.60629 2.63919 8.24879 3.13419 7.77629 4.38336C7.66254 4.68336 7.59129 5.00419 7.57254 5.33336C7.52879 6.05836 7.77629 7.37419 7.77629 7.37419V10.5234H9.09254V7.37419C9.09254 7.37419 8.91879 5.92836 9.09254 5.43752C9.22129 5.04502 9.46504 4.71919 9.80879 4.48336C10.085 4.29086 10.3988 4.13919 10.7263 4.13919C11.045 4.13919 11.3463 4.22169 11.605 4.38752C12.115 4.71502 12.5875 5.54086 12.5875 6.58752V7.37419C12.5875 7.37419 12.5875 7.37419 12.5875 7.37419V10.5234H14.2238Z\' fill=\'currentColor\'/></g></svg>'" />

            <!-- Remember me & Forgot password -->
            <div class="mb-6 flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember"
                        class="form-checkbox h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary-dark dark:border-form-strokedark dark:bg-form-input">
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
</x-layout>
