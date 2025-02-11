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
                    <a href="https://wemx.net" target="_blank" class="text-primary-600 dark:text-primary-500 hover:underline">WemX™</a>
                    | © {{ date('Y') }}
                    <a href="/" class="hover:underline">@settings('app_name', 'WemX')™</a>
                    {!! __('client.all_rights_reserved') !!}
                </div>

                <!-- Right: Social Icons -->
                <div class="flex items-center space-x-2">
                    @if (settings('socials::discord'))
                        <a href="@settings('socials::discord')" target="_blank" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                            <i class="bx bxl-discord-alt text-xl"></i>
                        </a>
                    @endif
                    @if (settings('socials::twitter'))
                        <a href="@settings('socials::twitter')" target="_blank" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                            </svg>
                        </a>
                    @endif
                    @if (settings('socials::github'))
                        <a href="@settings('socials::github')" target="_blank" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </a>
                    @endif
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
                        @if (settings('socials::discord'))
                            <a href="@settings('socials::discord')" target="_blank"
                               class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                <i class='bx bxl-discord-alt' style="font-size: 1.25rem"></i>
                            </a>
                        @endif
                        @if (settings('socials::twitter'))
                            <a href="@settings('socials::twitter')" target="_blank"
                               class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                </svg>
                            </a>
                        @endif
                        @if (settings('socials::github'))
                            <a href="@settings('socials::github')" target="_blank"
                               class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </footer>
@endswitch


