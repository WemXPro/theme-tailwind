{{-- alerts --}}
@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="mb-4 flex rounded-lg bg-red-50 p-4 text-sm text-red-800 dark:bg-gray-800 dark:text-red-400" role="alert">
            <svg aria-hidden="true" class="mr-3 inline h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">{!! __('client.info') !!}</span>
            <div>
                <span class="font-medium">{!! __('admin.error') !!}!</span> {!! $error !!}
            </div>
        </div>
    @endforeach
@endif

@if (Session::has('success'))
    <div class="mb-4 flex rounded-lg border border-green-300 bg-green-50 p-4 text-sm text-green-800 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
        role="alert">
        <svg aria-hidden="true" class="mr-3 inline h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">{!! __('client.info') !!}</span>
        <div>
            <span class="font-medium">{!! __('admin.success') !!}!</span> {!! session('success') !!}
        </div>
    </div>
@endif

@if (Session::has('error'))
    <div class="mb-4 flex rounded-lg border border-red-300 bg-red-50 p-4 text-sm text-red-800 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
        role="alert">
        <svg aria-hidden="true" class="mr-3 inline h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">{!! __('client.info') !!}</span>
        <div>
            <span class="font-medium">{!! __('admin.error') !!}!</span> {!! session('error') !!}
        </div>
    </div>
@endif

@if (Session::has('warning'))
    <div class="mb-4 flex rounded-lg border border-yellow-300 bg-yellow-50 p-4 text-sm text-yellow-800 dark:border-yellow-800 dark:bg-gray-800 dark:text-yellow-300"
        role="alert">
        <svg aria-hidden="true" class="mr-3 inline h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">{!! __('client.info') !!}</span>
        <div>
            <span class="font-medium">{!! __('admin.warning') !!}!</span> {!! session('warning') !!}
        </div>
    </div>
@endif

@if (Session::has('impersonate'))
    <div class="mb-6 flex items-center rounded-lg border border-gray-300 bg-gray-50 p-4 text-sm text-gray-800 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300"
        role="alert">
        <svg class="mr-3 inline h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">{!! __('client.info') !!}</span>
        <div>
            {!! __('client.you_are_currently_logged_in_as_please_press_exit', [
                'username' => User::find(session('impersonate'))->username,
                'route' => route('admin.user.impersonate.exit', session('impersonate')),
            ]) !!}
        </div>
    </div>
@endif

@admin
    @if (Settings::get('maintenance') == 'true')
        <div id="alert-additional-content-5" class="mb-4 rounded-lg border border-gray-300 bg-gray-50 p-4 dark:border-gray-600 dark:bg-gray-800"
            role="alert">
            <div class="flex items-center">
                <svg aria-hidden="true" class="mr-2 h-5 w-5 text-gray-800 dark:text-gray-300" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">{!! __('client.info') !!}</span>
                <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">{!! __('client.maintenance_mode_enabled') !!}</h3>
            </div>
            <div class="mb-4 mt-2 text-sm text-gray-800 dark:text-gray-300">
                {!! __('client.maintenance_mode_desc') !!}
            </div>
            <div class="flex">
                <a href="/admin/settings/store?maintenance=false"
                    class="mr-2 inline-flex items-center rounded-lg bg-gray-700 px-3 py-1.5 text-center text-xs font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-800">
                    <svg aria-hidden="true" class="-ml-0.5 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                        <path fill-rule="evenodd"
                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {!! __('client.disable_maintenance') !!}
                </a>
                <button type="button"
                    class="rounded-lg border border-gray-700 bg-transparent px-3 py-1.5 text-center text-xs font-medium text-gray-800 hover:bg-gray-800 hover:text-white focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-800"
                    data-dismiss-target="#alert-additional-content-5" aria-label="{!! __('client.close') !!}">
                    {!! __('client.dismiss') !!}
                </button>
            </div>
        </div>
    @endif
@endadmin

@auth
    @if ($request = auth()->user()->deletion_requests()->first())
        <div class="mb-4 flex rounded-lg border border-red-300 bg-red-50 p-4 text-sm text-red-800 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
            role="alert">
            <svg aria-hidden="true" class="mr-3 mt-2 inline h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <div class="mt-2">
                {!! __('client.account_deleted_alert', ['time' => $request->delete_at->diffForHumans()]) !!}
            </div>
            <a href="{{ route('user.cancel-removal') }}"
                class="ml-auto rounded-lg border border-red-700 px-4 py-1.5 text-center text-sm font-medium text-red-700 hover:bg-red-800 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">
                <span class="uppercase">
                    {!! __('client.cancel') !!}
                </span>
            </a>
        </div>
    @endif

    @if (OrderMember::where('email', auth()->user()->email)->where('status', 'pending')->exists())
        <div class="mb-4 flex items-center rounded-lg border border-gray-300 bg-gray-50 p-4 text-sm text-gray-800 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300"
            role="alert">
            <svg class="me-3 inline h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">{{ __('admin.info') }}</span>
            <div>
                {!! __('client.you_have_pending_member_invitations', ['route' => route('invites.index')]) !!}
            </div>
        </div>
    @endif
@endauth
