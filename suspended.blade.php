@extends(Theme::wrapper())

@section('title', 'Suspended')

@section('header')
<link rel="stylesheet" href="{{ Theme::get('Default')->assets }}assets/css/typography.min.css">
@endsection

@section('container')
<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-16 lg:px-12">
        <a href="#" class="flex justify-center items-center mb-5 text-3xl font-semibold text-gray-900 dark:text-white">
            <img src="@settings('logo')" style="width: 40px;" class="mr-2 rounded" alt="">
            @settings('app_name')    
        </a>
        <h1 class="mb-4 text-4xl font-bold tracking-tight leading-none text-gray-900 lg:mb-6 md:text-5xl xl:text-6xl dark:text-white">{{ __('client.account_suspended') }}</h1>
        <p class="font-light text-gray-500 md:text-lg xl:text-xl dark:text-gray-400">{{ __('client.suspended_contact_for_information') }}</p>
        <p class="font-light text-gray-500 md:text-lg xl:text-xl dark:text-gray-400"><br>{{ __('client.reference_id') }} <span class="font-medium text-gray-900 dark:text-white">#{{ $ban->id }}</span></p>
        @isset($ban->expires_at) <p class="font-light text-gray-500 md:text-lg xl:text-xl dark:text-gray-400">{{ __('admin.expires_in') }}: {{ $ban->expires_at->diffForHumans() }}</p> @endisset
    </div>
  </section>
@endsection
