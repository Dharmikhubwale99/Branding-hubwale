<div class="p-6 max-w-8xl mx-auto bg-white rounded shadow">
    <div class="flex justify-between items-center mb-4 flex-wrap gap-4">
        <h2 class="text-2xl font-bold">Uploaded Videos</h2>
        <x-form.button
            title="Create"
            route="admin.video"
            wireTarget="createVideo"
            class="bg-blue-600 hover:bg-blue-700 text-white"
        />
    </div>

    {{-- 🎯 Responsive wrapper --}}
    <div class="overflow-x-auto">
        <table class="w-full table-auto border border-collapse border-gray-200 text-sm">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Customer</th>
                    <th class="px-4 py-2 border">Title</th>
                    <th class="px-4 py-2 border">Description</th>
                    <th class="px-4 py-2 border">Preview</th>
                    <th class="px-4 py-2 border">Uploaded At</th>
                    <th class="px-4 py-2 border">Comments</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($videos as $index => $video)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border">{{ $video->user->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border">{{ $video->title }}</td>
                        <td class="px-4 py-2 border">{{ $video->description }}</td>
                        <td class="px-4 py-2 border">
                            @if ($video->path)
                                @php
                                    $extension = pathinfo($video->path, PATHINFO_EXTENSION);
                                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                @endphp

                                @if (in_array(strtolower($extension), $imageExtensions))
                                    <img src="{{ asset($video->path) }}" class="w-full h-24 object-cover rounded" alt="Image Preview">
                                @else
                                    <video src="{{ asset($video->path) }}" controls controlsList="nodownload"
                                           class="w-full h-24 rounded"></video>
                                @endif
                            @else
                                <span class="text-gray-400 italic">No file</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border">{{ $video->created_at->format('d M Y, h:i A') }}</td>
                        <td class="px-4 py-2 border w-72 align-top">
                            @if ($video->comments->count())
                                <div class="max-h-24 overflow-y-auto space-y-1 pr-2 text-sm text-gray-700">
                                    @foreach ($video->comments as $comment)
                                        <div class="text-black pb-1">
                                            {{ $comment->comment }}
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-gray-400 italic text-sm">No comments</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border">
                            @php
                                $bg = 'bg-gray-200 text-gray-800';
                                if ($video->status === 'pending') {
                                    $bg = 'bg-yellow-200 text-yellow-800';
                                } elseif ($video->status === 'process') {
                                    $bg = 'bg-blue-200 text-blue-800';
                                } elseif ($video->status === 'approved') {
                                    $bg = 'bg-green-200 text-green-800';
                                }
                            @endphp

                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $bg }}">
                                {{ ucfirst($video->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border">
                            <x-form.button title="" :route="['admin.edit', $video->id]"
                                class="p-1 w-5 h-10 rounded flex items-center justify-center mt-3">
                                <span class="w-5 h-1 flex items-center justify-center">
                                    {!! file_get_contents(public_path('icon/edit.svg')) !!}
                                </span>
                            </x-form.button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-gray-500">No videos found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
