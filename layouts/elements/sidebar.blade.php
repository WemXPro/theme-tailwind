{{-- Sidebar --}}
<aside class="h-screen bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 w-64 fixed left-0 top-0 transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0"
       id="sidebar">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
            <a href="/" class="flex items-center">
                @if (Settings::has('logo'))
                    <img src="@settings('logo')" class="h-8 mr-2 rounded" alt="@settings('app_name', 'WemX')" />
                @endif
                <span class="text-2xl font-semibold dark:text-white">@settings('app_name', 'WemX')</span>
            </a>
            <!-- Closing button (for mobile version) -->
            <button class="lg:hidden text-gray-500 dark:text-gray-400" onclick="toggleSidebar()">
                <i class="bx bx-x text-3xl"></i>
            </button>
        </div>

        <!-- Menu -->
        <nav class="flex-1 overflow-y-auto">
            <ul class="space-y-2 p-4">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ is_active('dashboard') }} flex items-center px-3 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                        <i class='bx bxs-dashboard text-xl mr-3'></i>
                        {!! __('client.dashboard') !!}
                    </a>
                </li>
                <li>
                    <a href="{{ route('news.index') }}" class="{{ is_active('news.index') }} flex items-center px-3 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                        <i class='bx bxs-news text-xl mr-3'></i>
                        {{ __('client.news') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('store.index') }}" class="{{ is_active('store.index') }} flex items-center px-3 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                        <i class='bx bxs-server text-xl mr-3'></i>
                        {!! __('client.services') !!}
                    </a>
                </li>

                @foreach (Page::getActive() as $page)
                    @if (in_array('navbar', $page->placement))
                        <li>
                            <a href="{{ route('page', $page->path) }}"
                               class="{{ is_active('page', ['page' => $page->path]) }} flex items-center px-3 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded"
                               @if ($page->new_tab) target="_blank" @endif>
                                <span class="text-xl mr-3">{!! $page->icon !!}</span>
                                {{ __($page->name) }}
                            </a>
                        </li>
                    @endif
                @endforeach

                {{-- Loading the menu from modules --}}
                @foreach (enabledExtensions() as $module)
                    @if (config($module->getLowerName() . '.elements.main_menu'))
                        @foreach (config($module->getLowerName() . '.elements.main_menu') as $key => $menu)
                            <li>
                                <a href="{{ $menu['href'] }}"
                                   class="{{ is_active($menu['href'], ['module' => true]) }} flex items-center px-3 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                                    <span class="text-xl mr-3" style="{{ $menu['style'] }}">{!! $menu['icon'] !!}</span>
                                    {!! __($menu['name']) !!}
                                </a>
                            </li>
                        @endforeach
                    @endif
                    @includeIf(Theme::moduleView($module->getLowerName(), 'elements.sidebar-menu'))
                @endforeach
            </ul>
        </nav>

        <!--Use menu -->
        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
            @include(Theme::path('layouts.elements.user-dropdown'))
        </div>
    </div>
</aside>

<!-- Sidebar opening button (mobile version) -->
<button class="lg:hidden fixed top-4 left-4 bg-gray-700 text-white p-2 rounded" onclick="toggleSidebar()">
    <i class="bx bx-menu text-2xl"></i>
</button>


<script>
    function toggleSidebar() {
        let sidebar = document.getElementById('sidebar');
        if (sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.remove('-translate-x-full');
        } else {
            sidebar.classList.add('-translate-x-full');
        }
    }
</script>
