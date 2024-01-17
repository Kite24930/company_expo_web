<div class="w-full flex items-center gap-2 occupation-item" data-id="{{ $target }}">
    <x-text-input class="occupation-input flex-1" data-id="{{ $target }}" placeholder="募集職種" value="{{ $value }}" />
    <x-elements.delete-btn class="occupation-delete" data-id="{{ $target }}" />
</div>
