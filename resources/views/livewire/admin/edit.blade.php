<div>
    <div class="p-6 bg-white max-w-3xl mx-auto rounded shadow">
        <h2 class="text-xl font-bold mb-4">Edit Video</h2>

        <form wire:submit.prevent="update" enctype="multipart/form-data" class="space-y-4">
            <x-form.input label="Title" name="title" wireModel="title" readonly />
            <x-form.input label="Description" name="description" type="textarea" wireModel="description" />

            <x-form.input label="Replace Video & Image File" name="newVideo" type="file" wireModel="newVideo" inputClass="cursor-pointer"  />
            @error('newVideo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            <div wire:loading wire:target="newVideo" class="flex flex-row text-blue-600 text-sm mt-2 flex items-center gap-2">
                Uploading video, please wait...
                <svg class="animate-spin h-4 w-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8v4l3.5-3.5L12 0v4a8 8 0 00-8 8z"></path>
                </svg>
            </div>
            @if ($path)
            @php
                $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            @endphp

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Preview</label>

                @if (in_array($extension, $imageExtensions))
                    <img src="{{ asset($path) }}" alt="Image Preview" class="w-64 h-36 object-cover rounded" />
                @else
                    <video src="{{ asset($path) }}" controls class="w-64 h-36 rounded"></video>
                @endif
            </div>
        @endif


        <div class="flex flex-row text-center  space-x-3">
            <x-form.button type="submit" title="Update" wireTarget="update" />

            <x-form.button title="Back" class="bg-gray-500 hover:bg-gray-600 text-white" route="admin.video.index" />
        </div>
        </form>
    </div>

</div>
