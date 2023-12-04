@extends(Theme::path('auth.registration.layout'))

@section('content')
    <div class="w-full">


        <h1 class="mb-2 text-2xl font-extrabold tracking-tight text-gray-900 leding-tight dark:text-white">
            {!! __('Change Email') !!}</h1>

        {{-- Include alerts --}}
        @include(Theme::path('layouts.alerts'))

        <form action="{{ route('verification.change-email') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="new-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {!! __('auth.new_email') !!}
                </label>
                <input type="email" id="new-email" name="new_email" autocomplete="email"
                    class="mt-1 p-2 block w-full border border-gray-300 dark:border-gray-600 rounded-md
                    shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
            </div>

            <div class="flex space-x-3">
                <button type="submit"
                    class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4
                        focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5
                        py-2.5 sm:py-3.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    {!! __('Change Email') !!}
                </button>
            </div>
        </form>
    </div>
@endsection
