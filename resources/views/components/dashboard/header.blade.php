<header class="flex md:flex-col flex-row gap-2 bg-gray-50 fixed top-0 left-0 md:w-80 w-full p-2 md:border-r md:h-full h-auto justify-between md:justify-start">
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
    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
        <ul class="py-2 text-sm text-gray-700 px-2" aria-labelledby="dropdownDefaultButton">
            <x-dashboard.items></x-dashboard.items>
        </ul>
    </div>
</header>
