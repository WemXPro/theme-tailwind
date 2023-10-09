@extends(Theme::wrapper())

@section('title', 'Articles')

@section('header')
    <link rel="stylesheet" href="{{ Theme::get('Default')->assets }}assets/css/typography.min.css">
@endsection

@section('header')
    <link rel="stylesheet" href="{{ Theme::get('Default')->assets }}assets/css/typography.min.css">
@endsection

@section('container')
    <section class="bg-white dark:bg-gray-900">
        <div class="grid gap-8 px-4 mx-auto max-w-screen-lg lg:gap-16 lg:px-6 ">
            <div>
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">{{ __('client.latest_news') }}</h2>
                <p class="font-light text-gray-500 dark:text-gray-400 sm:text-xl">{{ __('client.latest_news_desc') }}</p>
            </div>
            <div class="">
                @foreach($articles as $article)
                    @if($article->status !== 'published')
                        @continue;
                    @endif
                    @if(!in_array('pinned', $article->labels))
                        @continue;
                    @endif
                    <article class="mb-6">
                        <div class="flex justify-between items-center mb-5 text-gray-500">
                            <div class="flex">
                                @foreach($article->labels as $label)
                                    <span
                                        class="bg-{{ config("article.labels.$label.theme") }}-100 text-{{ config("article.labels.$label.theme") }}-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-{{ config("article.labels.$label.theme") }}-900 dark:text-{{ config("article.labels.$label.theme") }}-300">
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
                        <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{!! Str::words($article->content, 50, '...') !!}</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-4 mt-4"
                                 data-popover-target="popover-user-profile-{{ $article->user->id }}">
                                @if($article->show_author)
                                    <img class="w-7 h-7 rounded-full" src="{{ $article->user->avatar() }}" alt="">
                                    <span class="font-medium dark:text-white">
                            {{ $article->user->username }}
                        </span>
                                    <div data-popover id="popover-user-profile-{{ $article->user->id }}" role="tooltip"
                                         class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
                                        <div class="p-3">
                                            <div class="flex items-center justify-between mb-2">
                                                <a href="#">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="{{ $article->user->avatar() }}"
                                                         alt="{{ $article->user->username }}">
                                                </a>
                                                <div>
                                                    @if($article->user->is_admin())
                                                        <span
                                                            class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ __('client.administrator') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="text-base font-semibold leading-none text-gray-900 dark:text-white">
                                                <a href="#">{{ $article->user->username }}</a>
                                            </p>
                                            <p class="mb-3 text-sm font-normal">
                                                <a href="#"
                                                   class="hover:underline">{{ '@' .$article->user->username }}</a>
                                            </p>
                                            <p class="mb-4 text-sm"></p>
                                            <ul class="flex text-sm">
                                                <li class="mr-2">
                                                    <a href="#" class="hover:underline">
                                                        <span>{{ __('client.member_since') }}</span>
                                                        <span
                                                            class="font-semibold text-gray-900 dark:text-white">{{ $article->user->created_at->format('d M, Y') }}</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div data-popper-arrow></div>
                                    </div>
                                @endif
                            </div>
                            <a href="{{ route('news.article', $article->path) }}"
                               class="inline-flex items-center font-medium text-primary-600 hover:underline dark:text-primary-500">
                                Read more
                                <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                    <hr class="mb-6 border-gray-200 dark:border-gray-700">
                @endforeach
                @foreach($articles as $article)
                    @if($article->status !== 'published')
                        @continue;
                    @endif
                    @if(in_array('pinned', $article->labels))
                        @continue;
                    @endif
                    <article class="mb-6">
                        <div class="flex justify-between items-center mb-5 text-gray-500">
                            <div class="flex">
                                @foreach($article->labels as $label)
                                    <span
                                        class="bg-{{ config("article.labels.$label.theme") }}-100 text-{{ config("article.labels.$label.theme") }}-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-{{ config("article.labels.$label.theme") }}-900 dark:text-{{ config("article.labels.$label.theme") }}-300">
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
                        <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{!! Str::words($article->content, 50, '...') !!}</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-4 mt-4"
                                 data-popover-target="popover-user-profile-{{ $article->user->id }}">
                                <img class="w-7 h-7 rounded-full" src="{{ $article->user->avatar() }}" alt="">
                                <span class="font-medium dark:text-white">
                            {{ $article->user->username }}
                        </span>
                                <div data-popover id="popover-user-profile-{{ $article->user->id }}" role="tooltip"
                                     class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
                                    <div class="p-3">
                                        <div class="flex items-center justify-between mb-2">
                                            <a href="#">
                                                <img class="w-10 h-10 rounded-full" src="{{ $article->user->avatar() }}"
                                                     alt="{{ $article->user->username }}">
                                            </a>
                                            <div>
                                                @if($article->user->is_admin())
                                                    <span
                                                        class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ __('client.administrator') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="text-base font-semibold leading-none text-gray-900 dark:text-white">
                                            <a href="#">{{ $article->user->username }}</a>
                                        </p>
                                        <p class="mb-3 text-sm font-normal">
                                            <a href="#" class="hover:underline">{{ '@' .$article->user->username }}</a>
                                        </p>
                                        <p class="mb-4 text-sm"></p>
                                        <ul class="flex text-sm">
                                            <li class="mr-2">
                                                <a href="#" class="hover:underline">
                                                    <span>{{ __('client.member_since') }}</span>
                                                    <span
                                                        class="font-semibold text-gray-900 dark:text-white">{{ $article->user->created_at->format('d M, Y') }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </div>
                            <a href="{{ route('news.article', $article->path) }}"
                               class="inline-flex items-center font-medium text-primary-600 hover:underline dark:text-primary-500">
                                {{ __('client.read_more') }}
                                <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                    <hr class="mb-6 border-gray-200 dark:border-gray-700">
                @endforeach
            </div>
        </div>
    </section>

    <style>
        body {
            color: #878c95 !important;
        }
    </style>
@endsection
