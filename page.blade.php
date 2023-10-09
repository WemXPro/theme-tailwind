@extends(Theme::wrapper())

@section('title', $page->title)

@section('header')
<link rel="stylesheet" href="{{ Theme::get('Default')->assets }}assets/css/typography.min.css">
@endsection

@section('container')

<main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900">
    <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
        <header class="mb-4 lg:mb-6 not-format">
            <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $page->title }}</h1>
        </header>
        {!! $page->content !!}
    </article>    
</main>
@endsection
