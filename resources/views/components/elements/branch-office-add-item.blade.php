<div class="w-full flex gap-2 branch-office-item" data-id="{{ $target }}">
    <x-text-input id="{{ __('branch_office_name_input-'.$target) }}" class="w-44 branch-office-name text-sm" value="" placeholder="勤務地名" />
    <x-text-input id="{{ __('branch_office_address_input-'.$target) }}" class="flex-1 branch_office_address text-sm" value="" placeholder="勤務地住所" />
    <div class="flex items-center justify-center w-12">
        <x-elements.delete-btn class="branch-office-delete" data-id="{{ $target }}" />
    </div>
    <input type="hidden" id="{{ __('branch_office_lat-'.$target) }}" value="">
    <input type="hidden" id="{{ __('branch_office_lng-'.$target) }}" value="">
</div>
