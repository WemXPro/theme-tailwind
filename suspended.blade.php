@extends(Theme::wrapper())

@section('title', 'Suspended')

@section('header')
    <link rel="stylesheet" href="{{ Theme::get('Default')->assets }}assets/css/typography.min.css">
@endsection

@section('container')
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-md px-4 py-8 text-center lg:px-12 lg:py-16">
            <a href="#" class="mb-5 flex items-center justify-center text-3xl font-semibold text-gray-900 dark:text-white">
                <img src="@settings('logo')" style="width: 40px;" class="mr-2 rounded" alt="">
                @settings('app_name')
            </a>
            <h1 class="mb-4 text-4xl font-bold leading-none tracking-tight text-gray-900 dark:text-white md:text-5xl lg:mb-6 xl:text-6xl">
                {{ __('client.account_suspended') }}</h1>
            <p class="font-light text-gray-500 dark:text-gray-400 md:text-lg xl:text-xl">
                {{ __('client.suspended_contact_for_information') }}</p>
            <p class="font-light text-gray-500 dark:text-gray-400 md:text-lg xl:text-xl"><br>{{ __('client.reference_id') }}
                <span class="font-medium text-gray-900 dark:text-white">#{{ $ban->id }}</span>
            </p>
            @isset($ban->expires_at)
                <p class="font-light text-gray-500 dark:text-gray-400 md:text-lg xl:text-xl">{{ __('admin.expires_in') }}:
                    {{ $ban->expires_at->diffForHumans() }}
                </p>
            @endisset
        </div>
    </section>
@endsection
