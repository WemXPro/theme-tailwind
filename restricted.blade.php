@extends(Theme::wrapper())

@section('title', $title)

@section('container')
    <div class="mt-10 flex flex-col items-center">
        <div class="bg-primary-600 dark:bg-primary-900 mb-6 inline-flex h-24 w-24 items-center justify-center rounded-lg text-6xl text-white">
            {!! $icon !!}
        </div>
        <h3 class="mb-4 text-2xl font-bold dark:text-white">{{ $title }}</h3>
        <p class="mb-4 text-gray-500 dark:text-gray-400">{!! $desc !!}</p>
        <a href="/"
            class="mb-2 mr-2 mt-4 rounded-full bg-gray-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
            {!! __('admin.try_again') !!}
        </a>
    </div>
@endsection
