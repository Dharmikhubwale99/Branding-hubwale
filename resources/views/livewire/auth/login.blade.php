<div class="w-full flex items-center justify-center px-4 sm:px-6 lg:px-8 pt-16">
    <div class="w-full max-w-md">
        <div class="bg-white/90 backdrop-blur-md text-gray-800 rounded-lg shadow-lg px-4 sm:px-6 py-6 sm:py-8">
            <form class="space-y-6" wire:submit.prevent="submit">

                <div class="text-center">
                    <img class="mx-auto h-12 w-auto sm:h-14" src="{{ asset('icon/Branding_Hubwale_Final_01.jpg') }}" alt="Logo">
                    <h2 class="mt-4 text-xl sm:text-2xl font-bold text-gray-900">Sign in to your account</h2>
                    @if (session()->has('success'))
                        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif
                </div>

                <x-form.input name="login" label="Email or Mobile" type="text"
                    placeholder="Enter your email or mobile" required wireModel="login" autocomplete="username" />

                <x-form.input name="password" label="Password" type="password" placeholder="Enter your password"
                    wireModel="password" required autocomplete="current-password" showToggle="true"
                    inputClass="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" />

                <div class="flex flex-row sm:flex-row items-center justify-between gap-3 sm:gap-0">
                    <x-form.input name="remember" label="Remember me" type="checkbox"
                        inputClass="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                        wrapperClass="flex items-center mt-4 gap-2" wireModel="remember_me" />
                </div>

                <x-form.button type="submit"
                    class="w-full flex justify-center py-2 px-4 rounded-md shadow-sm text-sm sm:text-base font-medium text-white bg-gradient-to-r from-blue-500 to-cyan-400 hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200"
                    title="Sign in" wireTarget="submit" />

            </form>
        </div>
    </div>
</div>
