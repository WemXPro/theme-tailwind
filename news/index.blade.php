@extends(Theme::wrapper())

@section('title', 'Articles')

@section('header')
    <link rel="stylesheet" href="{{ Theme::get('Default')->assets }}assets/css/typography.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/2.0.3/showdown.min.js"></script>
@endsection

@section('container')
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto grid max-w-screen-lg gap-8 px-4 lg:gap-16 lg:px-6">
            <div>
                <h2 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">{{ __('client.latest_news') }}</h2>
                <p class="font-light text-gray-500 dark:text-gray-400 sm:text-xl">{{ __('client.latest_news_desc') }}</p>
            </div>
            <div class="">
                @if ($articles->count() == 0)
                    @include(Theme::path('empty-state'), [
                        'title' => __('client.no_new_articles'),
                        'description' => __('client.no_new_articles_desc'),
                    ])
                @endif
                @foreach ($articles as $article)
                    @php($article->translate())
                    @if ($article->status !== 'published')
                        @continue
                    @endif
                    @if (!in_array('pinned', $article->labels))
                        @continue
                    @endif
                    <article class="mb-6">
                        <div class="mb-5 flex items-center justify-between text-gray-500">
                            <div class="flex">
                                @foreach ($article->labels as $label)
                                    <span
                                        class="bg-{{ config("article.labels.$label.theme") }}-100 text-{{ config("article.labels.$label.theme") }}-800 dark:bg-{{ config("article.labels.$label.theme") }}-900 dark:text-{{ config("article.labels.$label.theme") }}-300 mr-2 rounded px-2.5 py-0.5 text-sm font-medium">
                                        <span class="mr-1 mt-1 text-sm">{!! config("article.labels.$label.icon") !!}</span>
                                        {{ config("article.labels.$label.name") }}
                                    </span>
                                @endforeach
                            </div>
                            <span class="text-sm">{{ $article->created_at->diffForHumans() }}</span>
                        </div>
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="{{ route('news.article', $article->path) }}">{{ $article->title }}</a>
                        </h2>
                        <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{!! Str::words($article->short_desc, 50, '...') !!}</p>
                        <div class="flex items-center justify-between">
                            <div class="mt-4 flex items-center space-x-4" data-popover-target="popover-user-profile-{{ $article->user->id }}">
                                @if ($article->show_author)
                                    <img class="h-7 w-7 rounded-full" src="{{ $article->user->avatar() }}" alt="">
                                    <span class="font-medium dark:text-white">
                                        {{ $article->user->username }}
                                    </span>
                                    <div data-popover id="popover-user-profile-{{ $article->user->id }}" role="tooltip"
                                        class="invisible absolute z-10 inline-block w-64 rounded-lg border border-gray-200 bg-white text-sm text-gray-500 opacity-0 shadow-sm transition-opacity duration-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                        <div class="p-3">
                                            <div class="mb-2 flex items-center justify-between">
                                                <a href="#">
                                                    <img class="h-10 w-10 rounded-full" src="{{ $article->user->avatar() }}"
                                                        alt="{{ $article->user->username }}">
                                                </a>
                                                <div>
                                                    @if ($article->user->is_admin())
                                                        <span
                                                            class="mr-2 rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                                            {{ __('client.administrator') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="text-base font-semibold leading-none text-gray-900 dark:text-white">
                                                <a href="#">{{ $article->user->username }}</a>
                                            </p>
                                            <p class="mb-3 text-sm font-normal">
                                                <a href="#" class="hover:underline">{{ '@' . $article->user->username }}</a>
                                            </p>
                                            <p class="mb-4 text-sm"></p>
                                            <ul class="flex text-sm">
                                                <li class="mr-2">
                                                    <a href="#" class="hover:underline">
                                                        <span>{{ __('client.member_since') }}</span>
                                                        <span class="font-semibold text-gray-900 dark:text-white">
                                                            {{ $article->user->created_at->translatedFormat('d M, Y') }}
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div data-popper-arrow></div>
                                    </div>
                                @endif
                            </div>
                            <a href="{{ route('news.article', $article->path) }}"
                                class="text-primary-600 dark:text-primary-500 inline-flex items-center font-medium hover:underline">
                                {{ __('client.read_more') }}
                                <svg class="ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                    <hr class="mb-6 border-gray-200 dark:border-gray-700">
                @endforeach
                @foreach ($articles as $article)
                    @if ($article->status !== 'published')
                        @continue
                    @endif
                    @if (in_array('pinned', $article->labels))
                        @continue
                    @endif
                    <article class="mb-6">
                        <div class="mb-5 flex items-center justify-between text-gray-500">
                            <div class="flex">
                                @foreach ($article->labels as $label)
                                    <span
                                        class="bg-{{ config("article.labels.$label.theme") }}-100 text-{{ config("article.labels.$label.theme") }}-800 dark:bg-{{ config("article.labels.$label.theme") }}-900 dark:text-{{ config("article.labels.$label.theme") }}-300 mr-2 rounded px-2.5 py-0.5 text-sm font-medium">
                                        <span class="mr-1 mt-1 text-sm">{!! config("article.labels.$label.icon") !!}</span>
                                        {{ config("article.labels.$label.name") }}
                                    </span>
                                @endforeach
                            </div>
                            <span class="text-sm">{{ $article->created_at->diffForHumans() }}</span>
                        </div>
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="{{ route('news.article', $article->path) }}">{{ $article->title }}</a>
                        </h2>
                        <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{!! Str::words($article->short_desc, 50, '...') !!}</p>
                        <div class="flex items-center justify-between">

                            <div class="mt-4 flex items-center space-x-4" data-popover-target="popover-user-profile-{{ $article->user->id }}">
                                @if ($article->show_author)
                                <img class="h-7 w-7 rounded-full" src="{{ $article->user->avatar() }}" alt="">
                                <span class="font-medium dark:text-white">
                                    {{ $article->user->username }}
                                </span>
                                <div data-popover id="popover-user-profile-{{ $article->user->id }}" role="tooltip"
                                    class="invisible absolute z-10 inline-block w-64 rounded-lg border border-gray-200 bg-white text-sm text-gray-500 opacity-0 shadow-sm transition-opacity duration-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                    <div class="p-3">
                                        <div class="mb-2 flex items-center justify-between">
                                            <a href="#">
                                                <img class="h-10 w-10 rounded-full" src="{{ $article->user->avatar() }}"
                                                    alt="{{ $article->user->username }}">
                                            </a>
                                            <div>
                                                @if ($article->user->is_admin())
                                                    <span
                                                        class="mr-2 rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                                        {{ __('client.administrator') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="text-base font-semibold leading-none text-gray-900 dark:text-white">
                                            <a href="#">{{ $article->user->username }}</a>
                                        </p>
                                        <p class="mb-3 text-sm font-normal">
                                            <a href="#" class="hover:underline">{{ '@' . $article->user->username }}</a>
                                        </p>
                                        <p class="mb-4 text-sm"></p>
                                        <ul class="flex text-sm">
                                            <li class="mr-2">
                                                <a href="#" class="hover:underline">
                                                    <span>{{ __('client.member_since') }}</span>
                                                    <span class="font-semibold text-gray-900 dark:text-white">
                                                        {{ $article->user->created_at->translatedFormat('d M, Y') }}
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                                @endif
                            </div>

                            <a href="{{ route('news.article', $article->path) }}"
                                class="text-primary-600 dark:text-primary-500 inline-flex items-center font-medium hover:underline">
                                {{ __('client.read_more') }}
                                <svg class="ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                    <hr class="mb-6 border-gray-200 dark:border-gray-700">
                @endforeach
                <div class="mt-2 flex items-center justify-end">
                    {{ $articles->links(Theme::pagination()) }}
                </div>
            </div>
        </div>
    </section>

    <style>
        body {
            color: #878c95 !important;
        }
    </style>

    <form class="mt-6">
        <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
            <div class="flex items-center justify-between px-3 py-2 border-b dark:border-gray-600">
                <div class="flex flex-wrap items-center divide-gray-200 sm:divide-x sm:rtl:divide-x-reverse dark:divide-gray-600">
                    <div class="flex flex-wrap items-center space-x-1 rtl:space-x-reverse sm:pe-4">
                        <button type="button" id="editor-text-h1" data-tooltip-target="text-h1-tooltip" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                            <strong>H1</strong>
                        </button>
                        <div id="text-h1-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Heading 1
                        </div>
                        <button type="button" id="editor-text-h2" data-tooltip-target="text-h2-tooltip" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                            <strong>H2</strong>
                        </button>
                        <div id="text-h2-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Heading 2
                        </div>
                        <button type="button" id="editor-text-h3" data-tooltip-target="text-h3-tooltip" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                            <strong>H3</strong>
                        </button>
                        <div id="text-h3-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Heading 3
                        </div>
                    </div>
                    <div class="flex items-center space-x-1 rtl:space-x-reverse sm:pe-4 sm:ps-4">
                        <button data-tooltip-target="text-bold-tooltip" type="button" id="editor-text-bold" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M8 5h4.5a3.5 3.5 0 1 1 0 7H8m0-7v7m0-7H6m2 7h6.5a3.5 3.5 0 1 1 0 7H8m0-7v7m0 0H6"/>
                            </svg>
                            <span class="sr-only">Text Bold</span>
                        </button>
                        <div id="text-bold-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Bold (Ctrl + B)
                        </div>
                        <button data-tooltip-target="text-italic-tooltip" type="button" id="editor-text-italic" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4" d="m8.874 19 6.143-14M6 19h6.33m-.66-14H18"/>
                            </svg>
                            <span class="sr-only">Text italic</span>
                        </button>
                        <div id="text-italic-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Italic (Ctrl + I)
                        </div>
                        <button data-tooltip-target="text-ul-tooltip" type="button" id="editor-text-ul" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2.4" d="M6 19h12M8 5v9a4 4 0 0 0 8 0V5M6 5h4m4 0h4"/>
                            </svg>
                            <span class="sr-only">Text Underline</span>
                        </button>
                        <div id="text-ul-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Italic (Ctrl + SHIFT + U)
                        </div>
                        <button data-tooltip-target="text-quote-tooltip" type="button" id="editor-text-quote" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M6 6a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a3 3 0 0 1-3 3H5a1 1 0 1 0 0 2h1a5 5 0 0 0 5-5V8a2 2 0 0 0-2-2H6Zm9 0a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a3 3 0 0 1-3 3h-1a1 1 0 1 0 0 2h1a5 5 0 0 0 5-5V8a2 2 0 0 0-2-2h-3Z" clip-rule="evenodd"/>
                            </svg>
                            <span class="sr-only">Text Quote</span>
                        </button>
                        <div id="text-quote-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Quote (Ctrl + Q)
                        </div>
                        <button data-tooltip-target="text-code-tooltip" type="button" id="editor-text-code" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4" d="m8 8-4 4 4 4m8 0 4-4-4-4m-2-3-4 14"/>
                            </svg>                              
                            <span class="sr-only">Text Code</span>
                        </button>
                        <div id="text-code-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Code (Ctrl + K)
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center space-x-1 rtl:space-x-reverse sm:ps-4 sm:pe-4">
                        <button type="button" id="editor-list-uo" data-tooltip-target="list-uo-tooltip" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                            <svg class="w-5 h-5 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M2.625 6.75a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0A.75.75 0 0 1 8.25 6h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75ZM2.625 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0ZM7.5 12a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12A.75.75 0 0 1 7.5 12Zm-4.875 5.25a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Unordered list</span>
                        </button>
                        <div id="list-uo-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Unordered list
                        </div>
                        <button type="button" id="editor-list-numbered" data-tooltip-target="list-numbered-tooltip" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" d="M12 6h8m-8 6h8m-8 6h8M4 16a2 2 0 1 1 3.321 1.5L4 20h5M4 5l2-1v6m-2 0h4"/>
                            </svg>
                            <span class="sr-only">Numbered list</span>
                        </button>
                        <div id="list-numbered-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Numbered list
                        </div>
                        <button type="button" id="editor-image" data-tooltip-target="image-tooltip" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M13 10a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2H14a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12c0 .556-.227 1.06-.593 1.422A.999.999 0 0 1 20.5 20H4a2.002 2.002 0 0 1-2-2V6Zm6.892 12 3.833-5.356-3.99-4.322a1 1 0 0 0-1.549.097L4 12.879V6h16v9.95l-3.257-3.619a1 1 0 0 0-1.557.088L11.2 18H8.892Z" clip-rule="evenodd"/>
                            </svg>                                                       
                            <span class="sr-only">Image</span>
                        </button>
                        <div id="image-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Image (Ctrl + SHIFT + I)
                        </div>
                        <button type="button" id="editor-link" data-tooltip-target="link-tooltip" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4" d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961"/>
                            </svg>                                                   
                            <span class="sr-only">Link</span>
                        </button>
                        <div id="link-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Link (Ctrl + SHIFT + L)
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-2 bg-white rounded-b-lg dark:bg-gray-800" id="editor-div">
                <label for="editor" class="sr-only">Publish post</label>
                <textarea id="editor" rows="8" class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" required ></textarea>
            </div>
        </div>
    </form>

    <script>
        document.getElementById('editor-text-bold').addEventListener('click', function() {
            wrapText('**');
        });
        
        document.getElementById('editor-text-italic').addEventListener('click', function() {
            wrapText('*');
        });
        
        document.getElementById('editor-text-ul').addEventListener('click', function() {
            wrapText('__');
        });

        document.getElementById('editor-text-quote').addEventListener('click', function() {
            createHeading('> ');
        });

        document.getElementById('editor-text-code').addEventListener('click', function() {
            wrapText('`');
        });

        document.getElementById('editor-text-h1').addEventListener('click', function() {
            createHeading('#');
        });

        document.getElementById('editor-text-h2').addEventListener('click', function() {
            createHeading('##');
        });

        document.getElementById('editor-text-h3').addEventListener('click', function() {
            createHeading('###');
        });
        
        document.getElementById('editor-list-numbered').addEventListener('click', function() {
            createList('1.');
        });
        
        document.getElementById('editor-list-uo').addEventListener('click', function() {
            createList('-');
        });

        document.getElementById('editor-image').addEventListener('click', function() {
            createImage();
        });

        document.getElementById('editor-link').addEventListener('click', function() {
            createLink();
        });
        
        document.getElementById('editor').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                addListItem();
                e.preventDefault(); // Prevent default behavior of Enter key
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.ctrlKey) {
                switch (event.key.toLowerCase()) {
                    case 'b':
                        event.preventDefault(); // Prevent default action
                        wrapText('**');
                        break;
                    case 'i':
                        if (event.shiftKey) { 
                            event.preventDefault();
                            createImage();
                        } else {
                            event.preventDefault();
                            wrapText('*');
                        }
                        break;
                    case 'u':
                        if (event.shiftKey) {
                            event.preventDefault();
                            wrapText('__');
                        }
                        break;
                    case 'l':
                        if (event.shiftKey) {
                            event.preventDefault();
                            createLink();
                        }
                        break;
                    case 'k':
                        if (event.shiftKey) {
                            event.preventDefault();
                            wrapText('`');
                        }
                        break;
                    case 'q':
                        event.preventDefault();
                        createHeading('> ');
                        break;
                }
            }
        });
        
        function wrapText(markdown) {
            const textarea = document.getElementById('editor');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);
            const beforeText = textarea.value.substring(0, start);
            const afterText = textarea.value.substring(end);
        
            // Check if the selected text itself is wrapped in markdown
            const isSelectedTextWrapped = selectedText.startsWith(markdown) && selectedText.endsWith(markdown);
            
            // Check if the text outside the selected text is wrapped in markdown
            const isOutsideWrapped = beforeText.endsWith(markdown) && afterText.startsWith(markdown);
        
            if (isSelectedTextWrapped) {
                // Unwrap selected text
                const unwrappedText = selectedText.slice(markdown.length, -markdown.length);
                textarea.value = beforeText + unwrappedText + afterText;
                textarea.selectionStart = start;
                textarea.selectionEnd = end - 2 * markdown.length;
            } else if (isOutsideWrapped) {
                // Unwrap outside text
                textarea.value = beforeText.slice(0, -markdown.length) + selectedText + afterText.slice(markdown.length);
                textarea.selectionStart = start - markdown.length;
                textarea.selectionEnd = end - markdown.length;
            } else {
                // Wrap selected text
                const wrappedText = markdown + selectedText + markdown;
                textarea.value = beforeText + wrappedText + afterText;
                textarea.selectionStart = start + markdown.length;
                textarea.selectionEnd = end + markdown.length;
            }
            textarea.focus();
        }

        function createHeading(markdown) {
            const textarea = document.getElementById('editor');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);
            const beforeText = textarea.value.substring(0, start);
            const afterText = textarea.value.substring(end);

            // If text is selected, add the markdown at the beginning of the selected text with a space
            // If no text is selected, add the markdown with a space
            // If selected text is already a heading, remove the markdown

            // Determine the start of the current line
            const lineStart = beforeText.lastIndexOf('\n') + 1;

            // Extract the current line
            const currentLine = textarea.value.substring(lineStart, end);

            // Check if the current line already starts with the markdown
            if (currentLine.startsWith(markdown + ' ')) {
                // Remove the markdown from the start of the line
                textarea.value = beforeText.substring(0, lineStart) + currentLine.substring(markdown.length + 1) + afterText;
                textarea.selectionStart = start - (markdown.length + 1);
                textarea.selectionEnd = end - (markdown.length + 1);
            } else {
                // Add the markdown to the start of the line
                const newLine = markdown + ' ' + currentLine;
                textarea.value = beforeText.substring(0, lineStart) + newLine + afterText;
                textarea.selectionStart = start + markdown.length + 1;
                textarea.selectionEnd = end + markdown.length + 1;
            }

            textarea.focus();
        }

        function createImage() 
        {
            const textarea = document.getElementById('editor');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end)|| 'Image description';
            const beforeText = textarea.value.substring(0, start);
            const afterText = textarea.value.substring(end);

            // if the selected text is a URL, then pre-fill the image URL in the prompt
            const selectedTextIsUrl = selectedText.match(/^https?:\/\/\S+$/);
            const imageUrl = selectedTextIsUrl ? selectedText : prompt('Enter the image URL:', 'https://');
            const imageAlt = selectedTextIsUrl ? 'Image description' : selectedText;
        
        
            if (!imageUrl) {
                return;
            }
        
            const image = `![${imageAlt}](${imageUrl})`;
        
            textarea.value = beforeText + image + afterText;
            textarea.selectionStart = start + 2;
            textarea.selectionEnd = start + 2 + imageAlt.length;
            textarea.focus();
        }

        function createLink() 
        {
            const textarea = document.getElementById('editor');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end) || 'Link text';
            const beforeText = textarea.value.substring(0, start);
            const afterText = textarea.value.substring(end);

            // if the selected text is a URL, then pre-fill the link URL in the prompt
            const selectedTextIsUrl = selectedText.match(/^https?:\/\/\S+$/);
            const linkUrl = selectedTextIsUrl ? selectedText : prompt('Enter the link URL:', 'https://');
            const linkText = selectedTextIsUrl ? 'Link text' : selectedText;
        
            if (!linkUrl) {
                return;
            }
        
            const link = `[${linkText}](${linkUrl})`;
        
            textarea.value = beforeText + link + afterText;
            textarea.selectionStart = start + 1;
            textarea.selectionEnd = start + 1 + linkText.length;
            textarea.focus();
        }
        
        function createList(prefix)
        {
            const textarea = document.getElementById('editor');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);
            const beforeText = textarea.value.substring(0, start);
            const afterText = textarea.value.substring(end);

            // if current line starts with the list prefix, remove it
            const currentLineStart = beforeText.lastIndexOf('\n') + 1;
            const currentLineEnd = afterText.indexOf('\n') === -1 ? textarea.value.length : end + afterText.indexOf('\n');
            const currentLine = textarea.value.substring(currentLineStart, currentLineEnd);
            const currentLinePrefix = currentLine.match(/^(\d+\.|-|\*\s)/);

            if (currentLinePrefix) {
                const currentLinePrefixLength = currentLinePrefix[0].length;
                const newLine = currentLine.slice(currentLinePrefixLength).trim(); // Remove the prefix and trim spaces
                const newBeforeText = beforeText.slice(0, currentLineStart);
                const newAfterText = afterText.trimStart(); // Remove leading spaces from afterText

                textarea.value = newBeforeText + newLine + newAfterText;
                textarea.selectionStart = currentLineStart + newLine.length;
                textarea.selectionEnd = textarea.selectionStart;
                return;
            }

        
            const lines = selectedText.split('\n');
            const list = lines.map(line => `${prefix} ${line}`).join('\n');
        
            textarea.value = beforeText + list + afterText;
            textarea.focus();
        }
        
        function addListItem()
        {
            const textarea = document.getElementById('editor');
            const start = textarea.selectionStart;
            const value = textarea.value;
            const beforeText = value.substring(0, start);
            const afterText = value.substring(start);
        
            const currentLineStart = beforeText.lastIndexOf('\n') + 1;
            const currentLineEnd = afterText.indexOf('\n') === -1 ? value.length : start + afterText.indexOf('\n');
            const currentLine = value.substring(currentLineStart, currentLineEnd).trim();
        
            const listItemMatch = currentLine.match(/^(\d+\.|-|\*\s)/);
        
            if (listItemMatch) {
                const listItemPrefix = listItemMatch[0];
        
                if (currentLine.length > listItemPrefix.length) {
                    let newListItemPrefix = listItemPrefix;
                    if (listItemPrefix.match(/^\d+\./)) {
                        const currentNumber = parseInt(listItemPrefix, 10);
                        newListItemPrefix = `${currentNumber + 1}. `;
                    }
        
                    const newListItem = `\n${newListItemPrefix} `;
                    textarea.value = beforeText + newListItem + afterText;
                    textarea.selectionStart = start + newListItem.length;
                    textarea.selectionEnd = textarea.selectionStart;
                } else {
                    // Remove the list item prefix if the current line is empty
                    textarea.value = beforeText.slice(0, currentLineStart) + afterText.trim();
                    textarea.selectionStart = currentLineStart;
                    textarea.selectionEnd = textarea.selectionStart;
                }
            } else {
                textarea.value = beforeText + '\n' + afterText;
                textarea.selectionStart = start + 1;
                textarea.selectionEnd = textarea.selectionStart;
            }
            textarea.focus();
        }
        </script>

@endsection
