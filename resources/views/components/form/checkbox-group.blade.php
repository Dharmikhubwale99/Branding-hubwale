@props([
    'name',
    'groups' => [],         // ['group' => ['perm1','perm2']]
    'wireModel' => null,
])

<div class="space-y-4">
    @foreach ($groups as $groupName => $items)
        <div class="border rounded p-3">
            <p class="font-semibold mb-2 text-gray-700">{{ ucfirst($groupName) }}</p>

            <div class="grid grid-cols-2 gap-2">
                @foreach ($items as $perm)
                    <label class="inline-flex items-center space-x-2 text-sm">
                        <input type="checkbox"
                               name="{{ $name }}[]"
                               value="{{ $perm }}"
                               @if ($wireModel) wire:model="{{ $wireModel }}" @endif
                               class="text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                        <span>{{ Str::headline($perm) }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
