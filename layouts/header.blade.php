{{-- header  --}}
<header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-900">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 md:px-6">
            <div class="flex justify-start items-center">
                <a href="" class="flex mr-6 xl:mr-8">
                    @if (Settings::has('logo'))
                        <img src="@settings('logo')" class="mr-3 h-8 rounded"
                            alt="@settings('app_name', 'WemX') Logo" />
                    @endif
                    <span
                        class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">@settings('app_name',
                        'WemX')</span>
                </a>

            </div>
            @include(Theme::path('layouts.widgets.user-dropdown'))
        </div>
    </nav>

    <div class="border-t border-b border-gray-100 bg-gray-50 dark:border-gray-800 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 md:px-6">
            <ul class="flex flex-wrap -mb-px -ml-4">
                <li class="mr-2">
                    <a class="inline-flex text-gray-500 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-b-2 dark:text-gray-400 group border-gray-50 dark:border-gray-800 {{ is_active('dashboard') }} "
                        href="{{ route('dashboard') }}">
                        <span class="mr-2" style="font-size: 20px;">
                            <i class='bx bxs-dashboard'></i>
                        </span>
                        {!! __('client.dashboard') !!}
                    </a>
                </li>

                <li class="mr-2">
                    <a class="inline-flex text-gray-500 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-b-2 dark:text-gray-400 group border-gray-50 dark:border-gray-800 {{ is_active('news.index') }} "
                        href="{{ route('news.index') }}">
                        <span class="mr-2" style="font-size: 20px;">
                            <i class='bx bxs-news'></i>
                        </span>
                        {{ __('client.news') }}
                    </a>
                </li>

                <li class="mr-2">
                    <a class="inline-flex text-gray-500 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-b-2 dark:text-gray-400 group border-gray-50 dark:border-gray-800 {{ is_active('store.index') }} "
                        href="{{ route('store.index') }}">
                        <span class="mr-2" style="font-size: 20px;">
                            <i class='bx bxs-server'></i>
                        </span>
                        {!! __('client.services') !!}
                    </a>
                </li>

                @foreach(Page::getActive() as $page)
                    @if(in_array('navbar', $page->placement))
                    <li class="mr-2">
                        <a class="inline-flex text-gray-500 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-b-2 dark:text-gray-400 group border-gray-50 dark:border-gray-800 {{ is_active('page', ['page' => $page->path]) }}"
                            href="{{ route('page', $page->path) }}" @if($page->new_tab) target="_blank" @endif>
                            <span class="mr-2" style="font-size: 20px;">
                                {!! $page->icon !!}
                            </span>
                            {{ __($page->name) }}
                        </a>
                    </li>
                    @endif
                @endforeach

                {{-- load module nav items  --}}
                @foreach (Module::allEnabled() as $module)
                    @if(config($module->getLowerName() . '.elements.main_menu'))
                        @foreach (config($module->getLowerName() . '.elements.main_menu') as $key => $menu)
                            <li class="mr-2">
                                <a class="inline-flex text-gray-500 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-b-2 dark:text-gray-400 group border-gray-50 dark:border-gray-800 {{ is_active($menu['href'], ['module' => true]) }}"
                                    href="{{ $menu['href'] }}">
                                    <span class="mr-2" style="font-size: 20px; {{ $menu['style'] }}">
                                        {!! $menu['icon'] !!}
                                    </span>
                                    {!! __($menu['name']) !!}
                                </a>
                            </li>
                        @endforeach
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

</header>
{{-- end header --}}
