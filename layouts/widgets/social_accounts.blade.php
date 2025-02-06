<div class="mb-4 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-6 xl:p-8">
    <div class="flow-root">
        <h3 class="text-xl font-bold dark:text-white">{!! __('client.social_accounts') !!}</h3>
        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
            @if (Settings::getJson('encrypted::oauth::google', 'is_enabled', false))
                <li class="pb-6 pt-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <i class='bx bxl-google dark:text-white' style="font-size: 1.75rem;"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                                        <span
                                            class="block truncate text-base font-semibold text-gray-900 dark:text-white">
                                            {!! __('client.google_account') !!}
                                        </span>
                            <span
                                class="block flex items-center truncate text-sm font-normal text-gray-500 dark:text-gray-400">
                                            @if (Auth::user()->oauthService('google')->exists())
                                    {{ Auth::user()->oauthService('google')->first()->email }} <i
                                        class='bx bxs-badge-check ml-1'></i>
                                @else
                                    {!! __('client.not_connected') !!}
                                @endif
                                        </span>
                        </div>
                        <div class="inline-flex items-center">
                            @if (Auth::user()->oauthService('google')->exists())
                                <a href="{{ route('oauth.remove', 'google') }}"
                                   class="mb-2 mr-3 rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-800 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">
                                    {!! __('client.remove') !!}
                                </a>
                            @else
                                <a href="{{ route('oauth.connect', 'google') }}"
                                   class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mr-3 rounded-lg px-3 py-2 text-center text-sm font-medium text-white focus:ring-4">
                                    {!! __('client.connect') !!}
                                </a>
                            @endif
                        </div>
                    </div>
                </li>
            @endif
            @if (Settings::getJson('encrypted::oauth::github', 'is_enabled', false))
                <li class="pb-6 pt-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <i class='bx bxl-github dark:text-white' style="font-size: 1.75rem;"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                                        <span
                                            class="block truncate text-base font-semibold text-gray-900 dark:text-white">
                                            {!! __('client.github_account') !!}
                                        </span>
                            <span
                                class="block truncate text-sm font-normal text-gray-500 dark:text-gray-400">
                                            @if (Auth::user()->oauthService('github')->exists())
                                    <a class="text-blue-500"
                                       href="{{ Auth::user()->oauthService('github')->first()->external_profile }}"
                                       target="_blank">{{ Auth::user()->oauthService('github')->first()->external_profile }}</a>
                                @else
                                    {!! __('client.not_connected') !!}
                                @endif
                                        </span>
                        </div>
                        <div class="inline-flex items-center">
                            @if (Auth::user()->oauthService('github')->exists())
                                <a href="{{ route('oauth.remove', 'github') }}"
                                   class="mb-2 mr-3 rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-800 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">
                                    {!! __('client.remove') !!}
                                </a>
                            @else
                                <a href="{{ route('oauth.connect', 'github') }}"
                                   class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mr-3 rounded-lg px-3 py-2 text-center text-sm font-medium text-white focus:ring-4">
                                    {!! __('client.connect') !!}
                                </a>
                            @endif
                        </div>
                    </div>
                </li>
            @endif
            @if (Settings::getJson('encrypted::oauth::discord', 'is_enabled', false))
                <li class="pb-6 pt-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <i class='bx bxl-discord-alt dark:text-white'
                               style="font-size: 1.75rem;"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                                        <span
                                            class="block truncate text-base font-semibold text-gray-900 dark:text-white">
                                            {!! __('client.discord_account') !!}
                                        </span>
                            <span
                                class="block flex items-center truncate text-sm font-normal text-gray-500 dark:text-gray-400">
                                            @if (Auth::user()->oauthService('discord')->exists())
                                    {{ Auth::user()->oauthService('discord')->first()->data->username }}
                                    <i
                                        class='bx bxs-badge-check ml-1'></i>
                                @else
                                    {!! __('client.not_connected') !!}
                                @endif
                                        </span>
                        </div>
                        <div class="inline-flex items-center">
                            @if (Auth::user()->oauthService('discord')->exists())
                                <a href="{{ route('oauth.remove', 'discord') }}"
                                   class="mb-2 mr-3 rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-800 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">
                                    {!! __('client.remove') !!}
                                </a>
                            @else
                                <a href="{{ route('oauth.connect', 'discord') }}"
                                   class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mr-3 rounded-lg px-3 py-2 text-center text-sm font-medium text-white focus:ring-4">
                                    {!! __('client.connect') !!}
                                </a>
                            @endif
                        </div>
                    </div>
                </li>
            @endif
            @foreach (enabledExtensions() as $module)
                @if(settings("widget:dashboard-sidebar:{$module->getLowerName()}", false))
                    @includeIf(theme()::moduleView($module->getLowerName(), 'widgets.dashboard-sidebar-widget'))
                @endif
            @endforeach
        </ul>
        <div></div>
    </div>
</div>
