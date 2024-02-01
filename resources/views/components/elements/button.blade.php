<button {!! $attributes->merge([
    'class' => 'bg-[#1A73B7] text-white rounded-full w-[250px] flex items-center justify-center text-sm py-2 hover:bg-[#2EA7EB] duration-300',
    'type' => 'button',
]) !!}>
    {{ $slot }}
    @if(!isset($svgCancel))
        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="ic:baseline-arrow-right">
                <path id="Vector" d="M7.16663 11.8334L10.5 8.50008L7.16663 5.16675V11.8334Z" fill="white"/>
            </g>
        </svg>
    @endif
</button>
