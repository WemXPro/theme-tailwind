@extends(Theme::wrapper())
@section('title', __('client.dashboard'))

{{-- Keywords for search engines --}}
@section('keywords', 'WemX Dashboard, WemX Panel')

@section('container')
    <div class="flex flex-wrap">
        <div class="w-full pl-2 pr-2 sm:w-1/2 md:w-1/3 lg:w-1/3">
            @include(Theme::path('layouts.widgets.user_balance'))
        </div>
        <div class="w-full pl-2 pr-2 sm:w-1/2 md:w-2/3 lg:w-2/3">
            @include(Theme::path('layouts.widgets.service_stats'))

            <section class="py-3 dark:bg-gray-900 sm:py-5">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="flex flex-col items-center justify-between space-y-3 p-4 dark:bg-gray-800 md:flex-row md:space-x-4 md:space-y-0">
                    </div>
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    {!! __('client.invited_by') !!}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {!! __('client.order') !!}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {!! __('client.status') !!}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        {!! __('client.user_role') !!}
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        {!! __('client.date') !!}
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-right">
                                    <span>{!! __('client.actions') !!}</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invites->get() as $invite)
                                <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                    <th scope="row" class="whitespace-nowrap px-4 py-4 font-medium text-gray-900 dark:text-white">
                                        <div class="flex items-center">
                                            <img class="mr-2 h-9 w-9 rounded-full" src="{{ $invite->inviter->avatar() }}" alt="Rounded avatar">

                                            {{ $invite->inviter->username }}
                                        </div>
                                    </th>
                                    <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $invite->order->name }}
                                    </th>
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white">
                                        <div class="flex items-center">
                                            <div
                                                class="@if ($invite->status == 'pending') bg-yellow-500 @elseif($invite->status == 'active') bg-green-500 @endif mr-2 h-2.5 w-2.5 rounded-full">
                                            </div>
                                            @if ($invite->status == 'pending')
                                                {!! __('client.pending') !!}
                                            @elseif($invite->status == 'active')
                                                {!! __('client.active') !!}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-2">
                                        <div
                                            class="@if ($invite->is_admin) bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300 @else bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300 @endif inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-3.5 w-3.5" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z">
                                                </path>
                                            </svg>
                                            @if ($invite->is_admin)
                                                {!! __('client.administrator') !!}
                                            @else
                                                {!! __('client.member') !!}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="pl-3">
                                            <div class="text-base text-sm font-semibold">{{ $invite->created_at->translatedFormat('d M Y') }}
                                            </div>
                                            <div class="font-normal text-gray-500">{{ $invite->created_at->diffForHumans() }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('invites.reject', $invite->id) }}"
                                            class="inline-flex items-center rounded-lg bg-red-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                            @if ($invite->status == 'pending')
                                                {!! __('client.reject') !!}
                                            @elseif($invite->status == 'active')
                                                {!! __('client.leave') !!}
                                            @endif
                                        </a>
                                        @if ($invite->status == 'pending')
                                            <a href="{{ route('invites.accept', $invite->id) }}"
                                                class="inline-flex items-center rounded-lg bg-green-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                {!! __('client.accept') !!}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-6">
                    @if ($invites->count() == 0)
                        @include(Theme::path('empty-state'), [
                            'title' => __('client.no_records_found'),
                            'description' => __('client.no_records_found_description', ['object' => __('client.invites')]),
                        ])
                    @endif
                </div>
            </section>
        </div>
    </div>
@endsection
