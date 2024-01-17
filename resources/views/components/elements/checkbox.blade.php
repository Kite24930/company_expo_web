<div class="flex items-center gap-2">
    <input {!! $attributes->merge([
        'type' => 'checkbox',
        'class' => 'form-checkbox rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50',
        'id' => $setId,
        'name' => $setId,
        'value' => $setValue,
    ]) !!} @if(isset($checked)) checked @endif>
    <x-input-label for="{{ $setId }}">{{ $notation }}</x-input-label>
</div>
