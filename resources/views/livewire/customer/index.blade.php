<div class="p-6 max-w-8xl mx-auto bg-white rounded shadow overflow-x-auto">
    <h2 class="text-2xl font-bold mb-6">My Videos</h2>

    <table class="min-w-full table-auto border border-collapse border-gray-200 text-sm">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="px-4 py-2 border">#</th>
                {{-- <th class="px-4 py-2 border">Title</th> --}}
                <th class="px-4 py-2 border">Description</th>
                <th class="px-4 py-2 border">Preview</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($videos as $index => $video)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                    {{-- <td class="px-4 py-2 border">{{ $video->title }}</td> --}}
                    <td class="px-4 py-2 border">{{ $video->description ?? '-' }}</td>
                    <td class="px-4 py-2 border">
                        @if ($video->path)
                            @php
                                $extension = strtolower(pathinfo($video->path, PATHINFO_EXTENSION));
                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                            @endphp

                            @if (in_array($extension, $imageExtensions))
                                <img src="{{ asset($video->path) }}" alt="Image Preview"
                                    class="w-40 h-24 object-cover rounded cursor-pointer"
                                    wire:click="viewImage('{{ asset($video->path) }}')" />
                            @else
                                <video src="{{ asset($video->path) }}" controls controlsList="nodownload"
                                    class="w-40 h-24 rounded"></video>
                            @endif
                        @else
                            <span class="text-gray-400 italic">No file</span>
                        @endif
                    </td>

                    <td class="px-4 py-2 border">
                        <div class="flex flex-wrap gap-2">
                            @if ($video->status !== 'approved')
                                <button wire:click="openEditModal({{ $video->id }})"
                                    class="border border-blue-500 text-blue-600 hover:bg-blue-50 px-3 py-1 rounded text-xs">
                                    Edit
                                </button>
                            @endif

                            @if ($video->status !== 'approved' && $video->status !== 'proccess')
                                <button wire:click="confirmDone({{ $video->id }})"
                                    class="border border-green-500 text-green-600 hover:bg-green-50 px-3 py-1 rounded text-xs">
                                    Done
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">You haven't uploaded any videos yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($editing)
        <div class="fixed inset-0 bg-transparent bg-opacity-40 backdrop-blur-sm z-40 flex items-center justify-center">
            <div class="bg-white rounded-lg p-6 shadow-xl z-50 w-full max-w-md">
                <h3 class="text-lg font-semibold mb-4 text-blue-600">Edit Description</h3>
                <textarea wire:model="editDescription" rows="4" class="w-full border rounded px-3 py-2"></textarea>
                @error('editDescription')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                <div class="flex justify-end mt-4 space-x-3">
                    <button wire:click="cancelEdit"
                        class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-gray-700">Cancel</button>
                    <button wire:click="updateVideo"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
                </div>
            </div>
        </div>
    @endif

    @if ($confirmingDone)
        <div class="fixed inset-0 bg-transparent bg-opacity-40 backdrop-blur-sm z-40 flex items-center justify-center">
            <div class="bg-white rounded-lg p-6 shadow-xl z-50 w-full max-w-md">
                <h3 class="text-lg font-semibold mb-4 text-green-600">Confirm Approval</h3>
                <p class="text-gray-700 mb-6">Are you sure you want to mark this video as <strong>approved</strong>?</p>
                <div class="flex justify-end space-x-3">
                    <button wire:click="cancelDone"
                        class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-gray-700">Cancel</button>
                    <button wire:click="markAsDone"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Yes, Done</button>
                </div>
            </div>
        </div>
    @endif

    @if ($showImage)
        <div class="fixed inset-0 bg-black bg-opacity-10 backdrop-blur-sm z-50 flex items-center justify-center"
            wire:click="$set('showImage', false)">
            <div class="max-w-3xl w-full p-4">
                <img src="{{ $imageUrl }}" alt="Full Image" class="rounded max-h-[80vh] mx-auto" />
            </div>
        </div>
    @endif

</div>
