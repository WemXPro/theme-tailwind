@extends(Theme::path('orders.master'))

@section('title', __('client.members'))

@section('content')
    <section>
        <div class="mx-auto max-w-screen-xl">
            <!-- Start coding here -->
            <div class="relative overflow-visible bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col items-center justify-end space-y-3 p-4 md:flex-row md:space-x-4 md:space-y-0">
                    <div
                        class="flex w-full flex-shrink-0 flex-col items-stretch justify-end space-y-2 md:w-auto md:flex-row md:items-center md:space-x-3 md:space-y-0">
                        <button type="button" data-drawer-target="drawer-invite-member" data-drawer-show="drawer-invite-member"
                            aria-controls="drawer-invite-member"
                            class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 flex items-center justify-center rounded-lg px-4 py-2 text-sm font-medium text-white focus:outline-none focus:ring-4">
                            <svg class="mr-2 h-3.5 w-3.5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            {!! __('client.invite_member') !!}
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">{!! __('client.user') !!}</th>
                                <th scope="col" class="px-4 py-3">{!! __('client.user_role') !!}</th>
                                <th scope="col" class="px-4 py-3">{!! __('client.status') !!}</th>
                                <th scope="col" class="px-4 py-3">{!! __('client.last_seen') !!}</th>
                                <th scope="col" class="px-4 py-3">{!! __('client.created') !!}</th>
                                <th scope="col text-right" class="px-4 py-3">
                                    <span>{!! __('client.actions') !!}</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->members()->get() as $member)
                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row" class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 dark:text-white">
                                        <div class="flex items-center">
                                            <div
                                                class="relative mr-2 inline-flex h-9 w-9 items-center justify-center overflow-hidden rounded-full bg-gray-100 dark:bg-gray-600">
                                                <span
                                                    class="font-medium text-gray-600 dark:text-gray-300">{{ substr($member->email, 0, 2) }}</span>
                                            </div>
                                            <div class="pl-3">
                                                <div class="text-base text-sm font-semibold">{{ $member->user->username ?? null }}</div>
                                                <div class="font-normal text-gray-800 dark:text-gray-300">{{ $member->email }}</div>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="px-4 py-2">
                                        <div
                                            class="@if ($member->is_admin) bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300 @else bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300 @endif inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-3.5 w-3.5" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z">
                                                </path>
                                            </svg>
                                            @if ($member->is_admin)
                                                {!! __('client.administrator') !!}
                                            @else
                                                {!! __('client.member') !!}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                        <div class="flex items-center">
                                            <div
                                                class="@if ($member->status == 'pending') bg-yellow-500 @elseif($member->status == 'active') bg-green-500 @endif mr-2 h-2.5 w-2.5 rounded-full">
                                            </div>
                                            @if ($member->status == 'pending')
                                                {!! __('client.pending') !!}
                                            @elseif($member->status == 'active')
                                                {!! __('client.active') !!}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ isset($member->user->last_seen_at) ? $member->user->last_seen_at->diffForHumans() : 'n/a' }}
                                    </td>
                                    <td class="px-4 py-3">{{ $member->created_at->diffForHumans() }}</td>
                                    <td class="flex items-center justify-end px-4 py-5">
                                        <button id="member-edit-dropdown-{{ $member->id }}-button"
                                            data-dropdown-toggle="member-edit-dropdown-{{ $member->id }}"
                                            class="inline-flex items-center rounded-lg p-0.5 text-center text-sm font-medium text-gray-500 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button">
                                            <svg class="h-5 w-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div id="member-edit-dropdown-{{ $member->id }}"
                                            class="z-10 hidden w-44 divide-y divide-gray-100 rounded bg-white shadow dark:divide-gray-600 dark:bg-gray-700">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="member-edit-dropdown-{{ $member->id }}-button">
                                                <li>
                                                    <button type="button" data-drawer-target="drawer-update-member-{{ $member->id }}"
                                                        data-drawer-show="drawer-update-member-{{ $member->id }}"
                                                        aria-controls="drawer-update-member-{{ $member->id }}"
                                                        style="width: 100%;text-align: start;"class="py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                        {!! __('client.edit') !!}
                                                    </button>
                                                </li>
                                            </ul>
                                            <div class="py-1">
                                                <a href="{{ route('service', ['order' => $order, 'page' => 'delete-member', 'member_id' => $member->id]) }}"
                                                    class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white">
                                                    {!! __('client.delete') !!}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- update member drawer component -->
                                <div id="drawer-update-member-{{ $member->id }}"
                                    class="fixed left-0 top-0 z-40 h-screen w-80 -translate-x-full overflow-y-auto bg-white p-4 transition-transform dark:bg-gray-800"
                                    tabindex="-1" aria-labelledby="drawer-update-member-{{ $member->id }}-label">
                                    <h5 id="drawer-label"
                                        class="mb-2 inline-flex items-center text-base font-semibold uppercase text-gray-500 dark:text-gray-400">
                                        <svg class="mr-2.5 h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 20 18">
                                            <path
                                                d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z" />
                                        </svg>
                                        {{ $member->email }}
                                    </h5>

                                    <button type="button" data-drawer-hide="drawer-update-member-{{ $member->id }}"
                                        aria-controls="drawer-update-member-{{ $member->id }}"
                                        class="absolute right-2.5 top-2.5 inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                                        <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">{!! __('client.close_menu') !!}</span>
                                    </button>
                                    <form
                                        action="{{ route('service', ['page' => 'update-member', 'order' => $order->id, 'member_id' => $member->id]) }}"
                                        method="POST" class="mb-6">
                                        @csrf
                                        <div class="relative mb-6">
                                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                                    <path
                                                        d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                                    <path
                                                        d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                                </svg>
                                            </div>
                                            <input type="email" disabled
                                                class="datepicker-input block w-full cursor-not-allowed rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                                placeholder="{{ $member->email }}">
                                        </div>
                                        <div class="mb-6">
                                            <label for="is_admin-{{ $member->id }}"
                                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{!! __('client.user_role') !!}</label>
                                            <select id="is_admin-{{ $member->id }}" onchange="hidePermissions({{ $member->id }})"
                                                name="is_admin"
                                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                                                <option value="1" @if ($member->is_admin) selected @endif>{!! __('client.all_administrator_permissions') !!}</option>
                                                <option value="0" @if (!$member->is_admin) selected @endif>{!! __('client.select_member_permissions') !!}</option>
                                            </select>
                                        </div>
                                        <div class="@if ($member->is_admin) hidden @endif mb-6"
                                            id="permissions-{{ $member->id }}">
                                            <label for="permissions"
                                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{!! __('client.permissions') !!}</label>

                                            <div style="height: 400px; overflow: scroll; padding: 5px;">
                                                @foreach ($order->getService()->permissions()->all() as $key => $permission)
                                                    <div class="mb-3 flex">
                                                        <div class="flex h-5 items-center">
                                                            <input id="permission-{{ $key }}"
                                                                @if (array_key_exists($key, $member->permissions)) checked="" @endif
                                                                name="permissions[{{ $key }}]"
                                                                aria-describedby="permission-{{ $key }}-text" type="checkbox"
                                                                value="@if (isset($permission['contains']) and $permission['contains']) contains @endif"
                                                                class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600">
                                                        </div>
                                                        <div class="ml-2 text-sm">
                                                            <label for="permission-{{ $key }}"
                                                                class="font-medium text-gray-900 dark:text-gray-300">{{ str_replace('_', ' ', $key) }}</label>
                                                            <p id="permission-{{ $key }}-text"
                                                                class="text-xs font-normal text-gray-500 dark:text-gray-300">
                                                                {{ $permission['description'] }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                        <button type="submit"
                                            class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mb-2 mr-2 flex w-full items-center justify-center rounded-lg px-5 py-2.5 text-sm font-medium text-white focus:outline-none focus:ring-4">{{ __('client.update') }}</button>
                                    </form>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <nav class="flex flex-col items-start justify-between space-y-3 p-4 md:flex-row md:items-center md:space-y-0"
                    aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        {!! __('client.showing_span') !!}
                        <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                        {!! __('client.of') !!}
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $order->members()->count() }}</span>
                    </span>
                </nav>
            </div>
        </div>
    </section>

    <!-- invite member drawer component -->
    <div id="drawer-invite-member"
        class="fixed left-0 top-0 z-40 h-screen w-80 -translate-x-full overflow-y-auto bg-white p-4 transition-transform dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-invite-member-label">
        <h5 id="drawer-label" class="mb-6 inline-flex items-center text-base font-semibold uppercase text-gray-500 dark:text-gray-400">
            <svg class="mr-2.5 h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                <path
                    d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z" />
            </svg>
            {!! __('client.invite_member') !!}
        </h5>
        <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">{!! __('client.invite_member_desc') !!}</p>

        <button type="button" data-drawer-hide="drawer-invite-member" aria-controls="drawer-invite-member"
            class="absolute right-2.5 top-2.5 inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">{!! __('client.close_menu') !!}</span>
        </button>
        <form action="{{ route('service', ['page' => 'invite-member', 'order' => $order->id]) }}" class="mb-6">
            <div class="relative mb-6">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 16">
                        <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                        <path
                            d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                    </svg>
                </div>
                <input type="email" name="email" id="email"
                    class="datepicker-input block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                    placeholder="john@example.com">
            </div>
            <div class="mb-6">
                <label for="is_admin-0" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{!! __('client.user_role') !!}</label>
                <select id="is_admin-0" onchange="hidePermissions(0)" name="is_admin"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                    <option value="1">{!! __('client.all_administrator_permissions') !!}</option>
                    <option value="0" selected>{!! __('client.select_member_permissions') !!}</option>
                </select>
            </div>
            <div class="mb-6" id="permissions-0">
                <label for="permissions" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{!! __('client.permissions') !!}</label>
                <div style="height: 400px; overflow: scroll; padding: 5px;">
                    @foreach ($order->getService()->permissions()->all() as $key => $permission)
                        <div class="mb-3 flex">
                            <div class="flex h-5 items-center">
                                <input id="permission-{{ $key }}" name="permissions[{{ $key }}]"
                                    aria-describedby="permission-{{ $key }}-text" type="checkbox"
                                    value="@if (isset($permission['contains']) and $permission['contains']) contains @endif"
                                    class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600">
                            </div>
                            <div class="ml-2 text-sm">
                                <label for="permission-{{ $key }}"
                                    class="font-medium text-gray-900 dark:text-gray-300">{{ str_replace('_', ' ', $key) }}</label>
                                <p id="permission-{{ $key }}-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">
                                    {{ $permission['description'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit"
                class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mb-2 mr-2 flex w-full items-center justify-center rounded-lg px-5 py-2.5 text-sm font-medium text-white focus:outline-none focus:ring-4">{!! __('client.send_invite') !!}
            </button>
        </form>
    </div>

    <script>
        function hidePermissions(id) {
            var is_admin = document.getElementById('is_admin-' + id).value;

            console.log(is_admin);

            if (is_admin == '1') {
                document.getElementById('permissions-' + id).classList.add('hidden');
            } else {
                document.getElementById('permissions-' + id).classList.remove('hidden');
            }
        }
    </script>
@endsection
