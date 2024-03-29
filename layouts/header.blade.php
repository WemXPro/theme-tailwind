{{-- header  --}}
<header>
    <nav class="border-gray-200 bg-white px-4 py-2.5 dark:bg-gray-900 lg:px-6">
        <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between px-4 md:px-6">
            <div class="flex items-center justify-start">
                <a href="/" class="mr-6 flex xl:mr-8">
                    @if (Settings::has('logo'))
                        <img src="@settings('logo')" class="mr-3 h-8 rounded" alt="@settings('app_name', 'WemX')"/>
                    @endif
                    <span class="self-center whitespace-nowrap text-2xl font-semibold dark:text-white">
                        @settings('app_name', 'WemX')
                    </span>
                </a>
            </div>
            @include(Theme::path('layouts.widgets.user-dropdown'))
        </div>
    </nav>

    <div class="border-b border-t border-gray-100 bg-gray-50 dark:border-gray-800 dark:bg-gray-800">
        <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between px-4 md:px-6">
            <ul class="-mb-px -ml-4 flex flex-wrap">
                <li class="mr-2">
                    <a class="{{ is_active('dashboard') }} group inline-flex rounded-t-lg border-b-2 border-gray-50 px-4 py-4 text-center text-sm font-medium text-gray-500 dark:border-gray-800 dark:text-gray-400"
                       href="{{ route('dashboard') }}">
                        <span class="mr-2" style="font-size: 20px;">
                            <i class='bx bxs-dashboard'></i>
                        </span>
                        {!! __('client.dashboard') !!}
                    </a>
                </li>
                <li class="mr-2">
                    <a class="{{ is_active('news.index') }} group inline-flex rounded-t-lg border-b-2 border-gray-50 px-4 py-4 text-center text-sm font-medium text-gray-500 dark:border-gray-800 dark:text-gray-400"
                       href="{{ route('news.index') }}">
                        <span class="mr-2" style="font-size: 20px;">
                            <i class='bx bxs-news'></i>
                        </span>
                        {{ __('client.news') }}
                    </a>
                </li>
                <li class="mr-2">
                    <a class="{{ is_active('store.index') }} group inline-flex rounded-t-lg border-b-2 border-gray-50 px-4 py-4 text-center text-sm font-medium text-gray-500 dark:border-gray-800 dark:text-gray-400"
                       href="{{ route('store.index') }}">
                        <span class="mr-2" style="font-size: 20px;">
                            <i class='bx bxs-server'></i>
                        </span>
                        {!! __('client.services') !!}
                    </a>
                </li>

                @foreach (Page::getActive() as $page)
                    @if (in_array('navbar', $page->placement))
                        <li class="mr-2">
                            <a class="{{ is_active('page', ['page' => $page->path]) }} group inline-flex rounded-t-lg border-b-2 border-gray-50 px-4 py-4 text-center text-sm font-medium text-gray-500 dark:border-gray-800 dark:text-gray-400"
                               href="{{ route('page', $page->path) }}" @if ($page->new_tab) target="_blank" @endif>
                                <span class="mr-2" style="font-size: 20px;">
                                    {!! $page->icon !!}
                                </span>
                                {{ __($page->name) }}
                            </a>
                        </li>
                    @endif
                @endforeach

                {{-- load module nav items  --}}
                @foreach (enabledModules() as $module)
                    @if (config($module->getLowerName() . '.elements.main_menu'))
                        @foreach (config($module->getLowerName() . '.elements.main_menu') as $key => $menu)
                            <li class="mr-2">
                                <a class="{{ is_active($menu['href'], ['module' => true]) }} group inline-flex rounded-t-lg border-b-2 border-gray-50 px-4 py-4 text-center text-sm font-medium text-gray-500 dark:border-gray-800 dark:text-gray-400"
                                   href="{{ $menu['href'] }}">
                                    <span class="mr-2" style="font-size: 20px; {{ $menu['style'] }}">
                                        {!! $menu['icon'] !!}
                                    </span>
                                    {!! __($menu['name']) !!}
                                </a>
                            </li>
                        @endforeach
                    @endif
                    @includeIf(Theme::moduleView($module->getLowerName(), 'elements.main-menu'))
                @endforeach
            </ul>
        </div>
    </div>
</header>
{{-- end header --}}
