<x-dashboard.template title="アカウント編集" css="dashboard/dashboard.css" :overview="$overview">
    <main class="w-full md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50 flex flex-col items-center md:pr-2.5 gap-6">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('アカウント情報編集') }}
            </h2>
        </x-slot>

        <div class="py-12 max-w-2xl w-full">
            <div class="max-w-2xl w-full mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                {{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
                {{--                <div class="max-w-xl">--}}
                {{--                    @include('profile.partials.delete-user-form')--}}
                {{--                </div>--}}
                {{--            </div>--}}
            </div>
        </div>
    </main>
    @vite(['resources/js/dashboard/dashboard.js'])
</x-dashboard.template>

