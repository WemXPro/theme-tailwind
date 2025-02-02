{{-- User Profile popup --}}
<div data-popover id="popover-user-profile" role="tooltip"
     class="invisible absolute z-10 inline-block w-64 rounded-lg border border-gray-200 bg-white text-sm text-gray-500 opacity-0 shadow-sm transition-opacity duration-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400">
    <div class="p-3">
        <div class="mb-2 flex items-center justify-between">
            <a href="#">
                {{--                <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Jese Leos"> --}}
            </a>
            <div>
                <button type="button"
                        class="rounded-lg bg-blue-700 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('client.follow') }}</button>
            </div>
        </div>
        <p class="text-base font-semibold leading-none text-gray-900 dark:text-white">
            <a href="#">Jese Leos</a>
        </p>
        <p class="mb-3 text-sm font-normal">
            <a href="#" class="hover:underline">@jeseleos</a>
        </p>
        <p class="mb-4 text-sm">{!! __('client.opensource_contributor_building_flowbitecom') !!}</p>
        <ul class="flex text-sm">
            <li class="mr-2">
                <a href="#" class="hover:underline">
                    <span class="font-semibold text-gray-900 dark:text-white">799</span>
                    <span>{{ __('client.following') }}</span>
                </a>
            </li>
            <li>
                <a href="#" class="hover:underline">
                    <span class="font-semibold text-gray-900 dark:text-white">3,758</span>
                    <span>{{ __('client.followers') }}</span>
                </a>
            </li>
        </ul>
    </div>
    <div data-popper-arrow></div>
</div>
