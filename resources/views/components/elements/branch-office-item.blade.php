<div class="w-full flex gap-2 branch-office-item" data-id="{{ $office->id }}">
    <x-text-input id="{{ __('branch_office_name_input-'.$office->id) }}" class="w-44 branch-office-name text-sm bg-gray-300" value="{{ $office->office_name }}" placeholder="勤務地名" disabled />
    <x-text-input id="{{ __('branch_office_address_input-'.$office->id) }}" class="flex-1 branch_office_address text-sm bg-gray-300" value="{{ $office->office_address }}" placeholder="勤務地住所" disabled />
    <div class="flex items-center justify-center w-12">
        <x-elements.delete-btn class="branch-office-delete" data-id="{{ $office->id }}" />
    </div>
    <input type="hidden" id="{{ __('branch_office_lat-'.$office->id) }}" value="{{ $office->office_lat }}">
    <input type="hidden" id="{{ __('branch_office_lng-'.$office->id) }}" value="{{ $office->office_lng }}">
</div>
