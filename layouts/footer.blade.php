@switch(settings('footer::type', 'default'))
    @case('minimal')
        <footer class="bg-white p-2 dark:bg-gray-800" style="margin-top: auto;">
            <div class="max-w-screen-xl mx-auto flex items-center justify-between">
                <!-- Left: Logo and App Name -->
                <div class="flex items-center space-x-2">
                    @if (Settings::has('logo'))
                        <a href="/">
                            <img src="@settings('logo')" alt="@settings('app_name', 'WemX')" class="h-6 rounded">
                        </a>
                    @endif
                    <a href="/" class="text-lg font-semibold dark:text-white">@settings('app_name', 'WemX')</a>
                </div>

                <!-- Center: Text in one row separated by "|" -->
                <div class="flex-1 text-center text-xs text-gray-500 dark:text-gray-400">
                    {!! __('client.powered_by') !!}
                    <a href="https://wemx.net" target="_blank"
                       class="text-primary-600 dark:text-primary-500 hover:underline">WemX™</a>
                    | © {{ date('Y') }}
                    <a href="/" class="hover:underline">@settings('app_name', 'WemX')™</a>
                    {!! __('client.all_rights_reserved') !!}
                </div>

                <!-- Right: Social Icons -->
                <div class="mt-4 flex space-x-6 sm:mt-0 sm:justify-center">
                    @foreach (Theme::active()->socials as $social)
                        @if (settings("socials::$social"))
                            <a href="{{ settings("socials::$social") }}" target="_blank"
                               class="text-gray-500 hover:text-gray-900 dark:hover:text-white text-2xl">
                                <i class='bx bxl-{{$social}}'></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </footer>
        @break
    @default
        <footer class="bg-white p-4 dark:bg-gray-800 sm:p-6" style="margin-top: auto;">
            <div class="mx-auto max-w-screen-xl">
                <div class="md:flex md:justify-between">
                    <div class="mb-6 md:mb-0">
                        <a href="/" class="flex items-center">
                            @if (Settings::has('logo'))
                                <img src="@settings('logo')" class="mr-3 h-8 rounded"
                                     alt="@settings('app_name', 'WemX')"/>
                            @endif
                            <span class="self-center whitespace-nowrap text-2xl font-semibold dark:text-white">
                        @settings('app_name', 'WemX')
                    </span>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-8 sm:grid-cols-3 sm:gap-6">
                        <div>
                            <h2 class="mb-6 text-sm font-semibold uppercase text-gray-900 dark:text-white">{!! __('client.resources') !!}</h2>
                            <ul class="text-gray-600 dark:text-gray-400">
                                @foreach (Page::getActive() as $page)
                                    @if (in_array('footer_resources', $page->placement))
                                        <li class="mb-4">
                                            <a href="{{ route('page', $page->path) }}"
                                               @if ($page->new_tab) target="_blank"
                                               @endif
                                               class="hover:underline">{{ $page->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                                @foreach (enabledExtensions() as $module)
                                    @includeIf(Theme::moduleView($module->getLowerName(), 'elements.footer-resources'))
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold uppercase text-gray-900 dark:text-white">{!! __('client.help_center') !!}</h2>
                            <ul class="text-gray-600 dark:text-gray-400">
                                @foreach (Page::getActive() as $page)
                                    @if (in_array('footer_help_center', $page->placement))
                                        <li class="mb-4">
                                            <a href="{{ route('page', $page->path) }}"
                                               @if ($page->new_tab) target="_blank"
                                               @endif
                                               class="hover:underline">{{ $page->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                                @foreach (enabledExtensions() as $module)
                                    @includeIf(Theme::moduleView($module->getLowerName(), 'elements.footer-help'))
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold uppercase text-gray-900 dark:text-white">{!! __('client.legal') !!}</h2>
                            <ul class="text-gray-600 dark:text-gray-400">
                                @foreach (Page::getActive() as $page)
                                    @if (in_array('footer_legal', $page->placement))
                                        <li class="mb-4">
                                            <a href="{{ route('page', $page->path) }}"
                                               @if ($page->new_tab) target="_blank"
                                               @endif
                                               class="hover:underline">
                                                {{ $page->name }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                                @foreach (enabledExtensions() as $module)
                                    @includeIf(Theme::moduleView($module->getLowerName(), 'elements.footer-legal'))
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="my-6 border-gray-200 dark:border-gray-700 sm:mx-auto lg:my-8"/>
                <div class="sm:flex sm:items-center sm:justify-between">
            <span class="text-sm text-gray-500 dark:text-gray-400 sm:text-center">
                {{ __('client.powered_by') }}
                <a href="https://wemx.net" target="_blank"
                   class="text-primary-600 dark:text-primary-500 hover:underline">WemX™</a>.
            </span>
                    <span class="text-sm text-gray-500 dark:text-gray-400 sm:text-center">
                © {{ date('Y') }}
                <a href="/" class="hover:underline">@settings('app_name', 'WemX')™</a>.
                {!! __('client.all_rights_reserved') !!}
            </span>

                    <div class="mt-4 flex space-x-6 sm:mt-0 sm:justify-center">
                        @foreach (Theme::active()->socials as $social)
                            @if (settings("socials::$social"))
                                <a href="{{ settings("socials::$social") }}" target="_blank"
                                   class="text-gray-500 hover:text-gray-900 dark:hover:text-white text-2xl">
                                    <i class='bx bxl-{{$social}}'></i>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </footer>
@endswitch


