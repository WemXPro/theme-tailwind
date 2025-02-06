<div class="mb-4 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-6 xl:p-8">
    <h3 class="text-xl font-bold dark:text-white">{!! __('client.two_factor_authentication') !!}</h3>
    <p class="mt-2 text-sm font-normal text-gray-500 dark:text-gray-400">
        {!! __('client.two_factor_authentication_desc') !!}
    </p>
    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
        <li class="py-4">
            <div class="flex justify-end space-x-4">
                <div class="inline-flex items-center">
                    @if (!Auth::user()->TwoFa()->exists())
                        <a href="{{ route('2fa.setup') }}"
                           class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mb-2 mr-2 rounded-lg px-5 py-2.5 text-sm font-medium text-white focus:outline-none focus:ring-4">
                            {!! __('client.enable') !!}
                        </a>
                    @else
                        <button type="button" data-modal-target="disableTwoFA"
                                data-modal-toggle="disableTwoFA"
                                class="mb-2 mr-2 rounded-lg bg-red-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            {!! __('client.disable') !!}
                        </button>
                    @endif
                </div>
            </div>
        </li>
    </ul>
</div>

@if (Auth::user()->TwoFa()->exists())
    <!-- Disable 2FA modal -->
    <div id="disableTwoFA" tabindex="-1" aria-hidden="true"
         class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
        <div class="relative max-h-full w-full max-w-2xl">
            <!-- Modal content -->
            <form action="{{ route('2fa.disable') }}" method="POST">
                @csrf
                <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-start justify-between rounded-t border-b p-4 dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {!! __('client.two_factor_authentication') !!}
                        </h3>
                        <button type="button"
                                class="ml-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="disableTwoFA">
                            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="2"
                                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">{{ __('client.disable') }}</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="space-y-6 p-6">
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            {!! __('client.two_factor_authentication_desc') !!}
                        </p>
                        <div>
                            <label for="opt"
                                   class="mb-2 block text-sm font-medium text-gray-900 dark:text-gray-300">{!! __('auth.2fa_code') !!}</label>
                            <input type="text" name="OPT" id="opt"
                                   class="focus:ring-primary-500 focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                                   placeholder="XXXXXX" required="">
                        </div>
                        <div class="flex items-start justify-between">
                            <div class="flex items-center justify-end">
                                <a href="{{ route('2fa.recover') }}"
                                   class="text-primary-600 dark:text-primary-500 text-sm font-medium hover:underline">

                                    {!! __('auth.lost_access_to_device') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end space-x-2 rounded-b border-t border-gray-200 p-6 dark:border-gray-600">
                        <button type="submit"
                                class="rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">{!! __('client.disable') !!}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Disable 2FA modal -->
@endif
