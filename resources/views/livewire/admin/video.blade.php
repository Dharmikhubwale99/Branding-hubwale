<div class="p-6 bg-white rounded shadow max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Upload Video</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">

        <x-form.select name="user" label="Select Customer" :options="$data['users']" wireModel="user" required
            placeholder="Select Customer" />

        <x-form.input name="video" label="Upload Video/Image" type="file" wireModel="video" required
            inputClass="cursor-pointer" />

        <div wire:loading wire:target="video" class="flex flex-row text-blue-600 text-sm mt-2 flex items-center gap-2">
            Uploading video, please wait...
            <svg class="animate-spin h-4 w-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8v4l3.5-3.5L12 0v4a8 8 0 00-8 8z"></path>
            </svg>
        </div>


        <x-form.input name="description" label="Description" type="textarea" wireModel="description"
            placeholder="Enter description (optional)" />

        <x-form.button type="submit" title="Upload" wireTarget="submit" />
    </form>
</div>
