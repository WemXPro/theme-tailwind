@extends(Theme::path('auth.wrapper'))

@section('title', __('auth.reset_password'))

@section('container')
    <section class="bg-white dark:bg-gray-900">
        <div class="grid lg:h-screen lg:grid-cols-2">
            <div class="flex items-center justify-center px-4 py-6 sm:px-0 lg:py-0">
                <form method="POST" action="{{ route('reset-password.update', $password_reset->token) }}"
                    class="w-full max-w-md space-y-4 md:space-y-6 xl:max-w-xl">
                    @csrf
                    <h1 class="text-xl font-bold text-gray-900 dark:text-white">{!! __('auth.reset_password') !!}</h1>

                    {{-- include alerts --}}
                    @include(Theme::path('layouts.alerts'))

                    <div>
                        <label for="password"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-gray-300">{!! __('auth.new_password') !!}</label>
                        <input type="password" name="password" id="password"
                            class="focus:ring-primary-500 focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                            placeholder="{!! __('auth.enter_password') !!}" required="">
                    </div>

                    <div>
                        <label for="password_confirmation"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-gray-300">{!! __('auth.confirm_new_password') !!}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="focus:ring-primary-500 focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                            placeholder="{!! __('auth.enter_confirm_password') !!}" required="">
                    </div>

                    <button type="submit"
                        class="bg-primary-600 hover:bg-primary-700 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 w-full rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">
                        {!! __('auth.reset_password') !!}
                    </button>
                </form>
            </div>
            <div class="bg-primary-600 flex items-center justify-center px-4 py-6 sm:px-0 lg:py-0">
                <div class="max-w-md xl:max-w-xl">
                    <a href="#" class="mb-4 flex items-center text-2xl font-semibold text-white">
                        <img class="mr-2 h-8 w-8" src="@settings('logo', '/assets/core/img/logo.png')" alt="logo">
                        @settings('app_name', 'WemX')
                    </a>
                    <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-white xl:text-5xl">
                        {!! __('auth.leading_design_portfolios') !!}
                    </h1>
                    <p class="text-primary-200 mb-4 font-light lg:mb-8">
                        {!! __('auth.reset_pass_desc', ['company' => settings('app_name', 'WemX')]) !!}
                    </p>
                    <div class="divide-primary-500 flex items-center divide-x">
                        <div class="flex -space-x-4 pr-3 sm:pr-5">
                            <img class="h-10 w-10 rounded-full border-2 border-white"
                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png" alt="bonnie avatar">
                            <img class="h-10 w-10 rounded-full border-2 border-white"
                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="jese avatar">
                            <img class="h-10 w-10 rounded-full border-2 border-white"
                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/roberta-casas.png" alt="roberta avatar">
                            <img class="h-10 w-10 rounded-full border-2 border-white"
                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/thomas-lean.png" alt="thomas avatar">
                        </div>
                        <a href="#" class="pl-3 text-white dark:text-white sm:pl-5">
                            <span class="text-primary-200 text-sm">{!! __('auth.over') !!} <span class="font-medium text-white">15.7k</span>
                                {!! __('auth.happy_customers') !!}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
