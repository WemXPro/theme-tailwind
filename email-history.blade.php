@extends(Theme::wrapper())
@section('title', __('client.email_history'))
@section('container')
    <div class="my-2 mx-auto">
        <div class="mb-2">
            <h1 class="inline-block text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">{!! __('client.email_history') !!}</h1>
            <p class="mt-1 text-lg text-gray-500 dark:text-gray-400">{!! __('client.email_history_desc') !!}</p>
        </div>
        <section class="dark:bg-gray-900 py-3 sm:py-5">
            <div class="mx-auto max-w-screen-2xl">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div
                        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-b dark:border-gray-700">
                        <div class="w-full flex items-center space-x-3">
                            <h5 class="dark:text-white font-semibold">{!! __('client.your_services') !!}</h5>
                            <div class="text-gray-400 font-medium">{{ $emails->count() }} {!! __('client.results') !!}</div>
                            <div data-tooltip-target="results-tooltip">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">{!! __('client.more_info') !!}</span>
                            </div>
                            <div id="results-tooltip" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
                                data-popper-placement="bottom"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(118px, 50px);">
                                {!! __('client.showing', ['count' => '1-10', 'all' => $emails->count()]) !!}
                                <div class="tooltip-arrow" data-popper-arrow=""
                                    style="position: absolute; left: 0px; transform: translate(94px, 0px);"></div>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">{!! __('client.expand_collapse_row') !!}</span>
                                    </th>
                                    <th scope="col" class="px-4 py-3 min-w-[14rem]">{!! __('client.subject') !!}</th>
                                    <th scope="col" class="px-4 py-3 min-w-[10rem]">
                                        {!! __('client.sender') !!}
                                        <svg class="h-4 w-4 ml-1 inline-block" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z">
                                            </path>
                                        </svg>
                                    </th>
                                    <th scope="col" class="px-4 py-3 min-w-[7rem]">
                                        {!! __('admin.create_at') !!}
                                        <svg class="h-4 w-4 ml-1 inline-block" fill="currentColor" viewBox="0 0 20 20"
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
                                    <tr class="border-b dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700 cursor-pointer transition text-gray-500 dark:text-gray-400"
                                        id="table-column-header-0"
                                        data-accordion-target="#table-column-body-{{ $email->id }}" aria-expanded="false"
                                        aria-controls="table-column-body-{{ $email->id }}">
                                        <td class="p-3 w-4">
                                            <svg data-accordion-icon="" class="w-6 h-6 shrink-0" fill="currentColor"
                                                viewBox="0 0 20 20" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </td>
                                        <th scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white flex items-center">
                                            {{ $email->subject }}
                                        </th>
                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $email->sender }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $email->created_at->translatedFormat(settings('date_format', 'd M Y')) }}</td>
                                    </tr>
                                    <tr class="flex-1 overflow-x-auto w-full hidden"
                                        id="table-column-body-{{ $email->id }}" aria-labelledby="table-column-header-0">
                                        <td class="p-4 border-b dark:border-gray-700" colspan="9">
                                            <div>
                                                <h6
                                                    class="mb-2 text-base leading-none font-medium text-gray-900 dark:text-white">
                                                    @include(EmailTemplate::view(), [
                                                        'name' => $email->user->username,
                                                        'subject' => $email->subject,
                                                        'intro' => $email->content,
                                                        'button' => $email->button,
                                                    ])
                                                </h6>
                                            </div>
                                            @if($email->attachment)
                                            <div class="flex justify-start items-center mt-4 cursor-pointer">
                                                @foreach($email->attachment as $key => $attachment)
                                                <a href="{{ route('email.download', ['email' => $email->id, 'attachment_id' => $key]) }}" class="p-2 h-12  mr-4 bg-gray-100 rounded-lg dark:bg-gray-700 flex items-center justify-center">
                                                    <div class="text-gray-500 dark:text-gray-400 text-3xl">
                                                        @if(Str::endsWith($attachment['name'], '.pdf'))
                                                            <i class='bx bxs-file-pdf' ></i>
                                                        @elseif(Str::endsWith($attachment['name'], ['.zip', '.tar', '.gz']))
                                                            <i class='bx bxs-file-archive' ></i>
                                                        @elseif(Str::endsWith($attachment['name'], ['.png', '.jpg', '.jpeg', '.gif', '.svg']))
                                                            <i class='bx bxs-file-image' ></i>
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
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 px-4 pt-3 pb-4"
                        aria-label="Table navigation">
                        {{ $emails->links(Theme::pagination()) }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
