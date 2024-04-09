@extends(Theme::wrapper())
@section('title', __('client.email_history'))
@section('container')
    <div class="mx-auto my-2">
        <div class="mb-2">
            <h1 class="inline-block text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                {!! __('client.email_history') !!}
            </h1>
            <p class="mt-1 text-lg text-gray-500 dark:text-gray-400">{!! __('client.email_history_desc') !!}</p>
        </div>
        <section class="py-3 dark:bg-gray-900 sm:py-5">
            <div class="mx-auto max-w-screen-2xl">
                <!-- Start coding here -->
                <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                    <div
                        class="flex flex-col items-center justify-between space-y-3 border-b p-4 dark:border-gray-700 md:flex-row md:space-x-4 md:space-y-0">
                        <div class="flex w-full items-center space-x-3">
                            <h5 class="font-semibold dark:text-white">{!! __('client.your_services') !!}</h5>
                            <div class="font-medium text-gray-400">{{ $emails->count() }} {!! __('client.results') !!}</div>
                            <div data-tooltip-target="results-tooltip">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">{!! __('client.more_info') !!}</span>
                            </div>
                            <div id="results-tooltip" role="tooltip"
                                class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
                                data-popper-placement="bottom"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(118px, 50px);">
                                {!! __('client.showing', ['count' => '1-10', 'all' => $emails->count()]) !!}
                                <div class="tooltip-arrow" data-popper-arrow=""
                                    style="position: absolute; left: 0px; transform: translate(94px, 0px);"></div>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                            <thead class="bg-gray-50 text-xs uppercase dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">{!! __('client.expand_collapse_row') !!}</span>
                                    </th>
                                    <th scope="col" class="min-w-[14rem] px-4 py-3">{!! __('client.subject') !!}</th>
                                    <th scope="col" class="min-w-[10rem] px-4 py-3">
                                        {!! __('client.sender') !!}
                                        <svg class="ml-1 inline-block h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z">
                                            </path>
                                        </svg>
                                    </th>
                                    <th scope="col" class="min-w-[7rem] px-4 py-3">
                                        {!! __('admin.create_at') !!}
                                        <svg class="ml-1 inline-block h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z">
                                            </path>
                                        </svg>
                                    </th>
                                </tr>
                            </thead>
                            <tbody data-accordion="table-column">
                                @foreach ($emails as $email)
                                    @if($email->isHidden())
                                        @continue
                                    @endif
                                    <tr class="cursor-pointer border-b text-gray-500 transition hover:bg-gray-200 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700"
                                        id="table-column-header-0" data-accordion-target="#table-column-body-{{ $email->id }}"
                                        aria-expanded="false" aria-controls="table-column-body-{{ $email->id }}">
                                        <td class="w-4 p-3">
                                            <svg data-accordion-icon="" class="h-6 w-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </td>
                                        <th scope="row"
                                            class="flex items-center whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">
                                            {{ $email->subject }}
                                        </th>
                                        <td class="whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">
                                            {{ $email->sender }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $email->created_at->translatedFormat(settings('date_format', 'd M Y')) }}
                                        </td>
                                    </tr>
                                    <tr class="hidden w-full flex-1 overflow-x-auto" id="table-column-body-{{ $email->id }}"
                                        aria-labelledby="table-column-header-0">
                                        <td class="border-b p-4 dark:border-gray-700" colspan="9">
                                            <div>
                                                <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">
                                                    @include(EmailTemplate::view(), [
                                                        'name' => $email->user->username,
                                                        'subject' => $email->subject,
                                                        'intro' => $email->content,
                                                        'button' => $email->button,
                                                    ])
                                                </h6>
                                            </div>
                                            @if ($email->attachment)
                                                <div class="mt-4 flex cursor-pointer items-center justify-start">
                                                    @foreach ($email->attachment as $key => $attachment)
                                                        <a href="{{ route('email.download', ['email' => $email->id, 'attachment_id' => $key]) }}"
                                                            class="mr-4 flex h-12 items-center justify-center rounded-lg bg-gray-100 p-2 dark:bg-gray-700">
                                                            <div class="text-3xl text-gray-500 dark:text-gray-400">
                                                                @if (Str::endsWith($attachment['name'], '.pdf'))
                                                                    <i class='bx bxs-file-pdf'></i>
                                                                @elseif(Str::endsWith($attachment['name'], ['.zip', '.tar', '.gz']))
                                                                    <i class='bx bxs-file-archive'></i>
                                                                @elseif(Str::endsWith($attachment['name'], ['.png', '.jpg', '.jpeg', '.gif', '.svg']))
                                                                    <i class='bx bxs-file-image'></i>
                                                                @else
                                                                    <i class='bx bxs-file'></i>
                                                                @endif
                                                            </div>
                                                            <small class="ml-2 mr-2">{{ $attachment['name'] }}</small>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex flex-col items-start justify-between space-y-3 px-4 pb-4 pt-3 md:flex-row md:items-center md:space-y-0"
                        aria-label="{{ __('admin.table_navigation') }}">
                        {{ $emails->links(Theme::pagination()) }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
