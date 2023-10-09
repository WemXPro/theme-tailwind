@extends(Theme::wrapper())
@section('title', $title)
@section('container')
    <div class="flex items-center flex-col mt-10">
        <div
            class="inline-flex justify-center items-center mb-6 w-24 h-24 rounded-lg bg-primary-600 dark:bg-primary-900 text-white text-6xl">
            {!! $icon !!}
        </div>
        <h3 class="mb-4 text-2xl font-bold dark:text-white">{{ $title }}</h3>
        <p class="mb-4 text-gray-500 dark:text-gray-400">{!! $desc !!}</p>
        <a href="/"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 mt-4">{!! __('admin.try_again') !!}</a>
    </div>
@endsection
