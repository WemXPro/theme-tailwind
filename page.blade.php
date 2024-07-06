@extends(Theme::wrapper())

@section('title', $page->title)

@section('header')
    <link rel="stylesheet" href="{{ Theme::get('Default')->assets }}assets/css/typography.min.css">
@endsection

@section('container')
    <main class="pb-16 pt-8 lg:pb-24 lg:pt-16">
        <article class="format format-sm sm:format-base lg:format-lg format-blue dark:format-invert mx-auto w-full max-w-2xl">
            <header class="not-format mb-4 lg:mb-6">
                <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 dark:text-white lg:mb-6 lg:text-4xl">
                    {{ $page->title }}
                </h1>
            </header>
            {!! $page->content !!}
        </article>
    </main>
@endsection
