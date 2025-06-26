<div class="p-6 bg-white rounded shadow max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Create New Coustomer</h2>

    @if (session()->has('message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif
    @if (session()->has('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
    <form wire:submit.prevent="submit" class="space-y-4">
        <x-form.input name="name" label="Full Name" wireModel="name" required placeholder="Enter full name" />

        <x-form.input name="email" label="Email" type="email" wireModel="email" required
            placeholder="Enter email address" />

        <x-form.input name="mobile" label="Mobile Number" type="text" wireModel="mobile"
            placeholder="Enter 10-digit mobile number" />

        <div class="mb-4">
            <x-form.select name="role" label="Role" :options="$data['roles']" wireModel="role" required
                placeholder="Select Role" />
            @error('role')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <x-form.input name="password" label="Password" type="password" wireModel="password" required
            placeholder="Create a password" showToggle="true" />

        <x-form.input name="password_confirmation" label="Confirm Password" type="password"
            wireModel="password_confirmation" required placeholder="Confirm the password" showToggle="true" />


        <div class="flex flex-row text-center  space-x-3">
            <x-form.button type="submit" title="Create" wireClick="submit" wireTarget="submit" />

            <x-form.button title="Back" class="bg-gray-500 hover:bg-gray-600 text-white" route="admin.dashboard" />
        </div>
    </form>

</div>
