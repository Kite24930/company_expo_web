<header id="header" class="flex md:flex-col flex-row gap-2 bg-gray-100 fixed top-0 left-0 md:w-80 w-full p-0 md:border-r md:h-full h-auto justify-between md:justify-start duration-500 @if(isset($hide)) hide @endif">
    <div class="w-full h-full m-0 p-2 flex md:flex-col flex-row gap-2 justify-between md:justify-start relative">
        <button id="headerToggleButton" class="absolute top-10 -right-6 w-6 h-24 rounded-r-md bg-gray-100 border-t border-r border-b md:flex hidden items-center justify-center">
            <div id="toggleHide" class="@if(isset($hide)) hidden @endif">
                <x-symbols.double-arrow-left />
                <span class="text">
                    close
                </span>
            </div>
            <div id="toggleShow" class="@if(!isset($hide)) hidden @endif">
                <x-symbols.double-arrow-right />
                <span class="text">
                    show
                </span>
            </div>
        </button>
        <x-app-logo :overview="$overview"></x-app-logo>
        {{--    PC--}}
        <hr class="md:block hidden">
        <ul class="md:block hidden px-2">
            <x-dashboard.items></x-dashboard.items>
        </ul>
        {{--    SP--}}

        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="bg-blue-100 hover:bg-blue-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-2xl px-5 py-2.5 text-center inline-flex items-center md:hidden" type="button">
            <i class="bi bi-list"></i>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
            <ul class="py-2 text-sm text-gray-700 px-2" aria-labelledby="dropdownDefaultButton">
                <x-dashboard.items></x-dashboard.items>
            </ul>
        </div>
    </div>
</header>
