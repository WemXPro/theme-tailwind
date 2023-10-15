<div class="flex justify-between items-center lg:order-2">
    {{-- color selection menu  --}}
    <button id="dropdownPalleteButton" data-dropdown-toggle="dropdownPallete" aria-label="dropdownPallete"
        class="flex items-center p-2 text-xs font-medium mr-1 text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-500 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><svg
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
            </path>
        </svg><span class="w-6 h-4 rounded ml-2 bg-primary-600 dark:bg-primary-400"></span><span
            class="hidden">{!! __('client.change_color') !!}</span></button>
    <!-- Dropdown menu -->
    <div id="dropdownPallete"
         class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700"
         aria-labelledby="dropdownPalleteButton">
        <div
            class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
            {!! __('client.customize_your_preference') !!}
        </div>
        <div class="divide-y divide-gray-100 dark:divide-gray-800">
            <div
                class="z-50 p-3 text-base list-none bg-white rounded shadow top-10 -left-32 w-96 dark:bg-gray-800">
                <div class="grid grid-cols-3 gap-2">
                    <button onclick="setColor('rose')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-rose-600 dark:bg-rose-400"></span>{!! __('client.rose') !!}
                    </button>
                    <button onclick="setColor('pink')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-pink-600 dark:bg-pink-400"></span>{!! __('client.pink') !!}
                    </button>
                    <button onclick="setColor('fuchsia')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-fuchsia-600 dark:bg-fuchsia-400"></span>{!! __('client.fuchsia') !!}
                    </button>
                    <button onclick="setColor('purple')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-purple-600 dark:bg-purple-400"></span>{!! __('client.purple') !!}
                    </button>
                    <button onclick="setColor('violet')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-violet-600 dark:bg-violet-400"></span>{!! __('client.violet') !!}
                    </button>
                    <button onclick="setColor('indigo')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-indigo-600 dark:bg-indigo-400"></span>{!! __('client.indigo') !!}
                    </button>
                    <button onclick="setColor('blue')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-blue-600 dark:bg-blue-400"></span>{!! __('client.blue') !!}
                    </button>
                    <button onclick="setColor('sky')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-sky-600 dark:bg-sky-400"></span>{!! __('client.sky') !!}
                    </button>
                    <button onclick="setColor('cyan')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-cyan-600 dark:bg-cyan-400"></span>{!! __('client.cyan') !!}
                    </button>
                    <button onclick="setColor('teal')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-teal-600 dark:bg-teal-400"></span>{!! __('client.teal') !!}
                    </button>
                    <button onclick="setColor('emerald')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-emerald-600 dark:bg-emerald-400"></span>{!! __('client.emerald') !!}
                    </button>
                    <button onclick="setColor('green')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-green-600 dark:bg-green-400"></span>{!! __('client.green') !!}
                    </button>
                    <button onclick="setColor('lime')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-lime-600 dark:bg-lime-400"></span>{!! __('client.lime') !!}
                    </button>
                    <button onclick="setColor('yellow')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-yellow-600 dark:bg-yellow-400"></span>{!! __('client.yellow') !!}
                    </button>
                    <button onclick="setColor('amber')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-amber-600 dark:bg-amber-400"></span>{!! __('client.amber') !!}
                    </button>
                    <button onclick="setColor('orange')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-orange-600 dark:bg-orange-400"></span>{!! __('client.orange') !!}
                    </button>
                    <button onclick="setColor('red')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-red-600 dark:bg-red-400"></span>{!! __('client.red') !!}
                    </button>
                    <button onclick="setColor('stone')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-stone-600 dark:bg-stone-400"></span>{!! __('client.stone') !!}
                    </button>
                    <button onclick="setColor('neutral')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-neutral-600 dark:bg-neutral-400"></span>{!! __('client.neutral') !!}
                    </button>
                    <button onclick="setColor('zinc')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-zinc-600 dark:bg-zinc-400"></span>{!! __('client.zinc') !!}
                    </button>
                    <button onclick="setColor('gray')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-gray-600 dark:bg-gray-400"></span>{!! __('client.gray') !!}
                    </button>
                    <button onclick="setColor('slate')"
                            class="flex items-center p-2 text-gray-600 rounded dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600"><span
                            class="inline-block w-6 h-4 rounded mr-2 bg-slate-600 dark:bg-slate-400"></span>{!! __('client.slate') !!}
                    </button>
                </div>
            </div>

        </div>
    </div>
    <span class="hidden mx-2 w-px h-5 bg-gray-200 dark:bg-gray-600 lg:inline"></span>

    {{-- dark / light mode switch --}}
    <button data-tooltip-target="tooltip-dark" type="button" onclick="toggleDarkmode()" aria-label="{{ __('client.toggle_darkmode') }}"
            class="inline-flex items-center p-2 mr-1 text-sm font-medium text-gray-500 rounded-lg dark:text-gray-400 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
        </svg>
    </button>
    <span class="hidden mx-2 w-px h-5 bg-gray-200 dark:bg-gray-600 lg:inline"></span>

    @guest
        <a href="{{ route('login') }}"
           class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">{!! __('client.login') !!}</a>
        <a href="{{ route('register') }}"
           class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">{!! __('auth.sign_up') !!}</a>
    @endguest

    @auth
        <!-- Notifications -->
        <button type="button" data-dropdown-toggle="notification-dropdown"
                class="p-2 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
            <span class="sr-only">{!! __('client.view_notifications') !!}</span>
            <!-- Bell icon -->
            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                </path>
            </svg>
            @if (auth()->user()->notifications()->where('read_at', '=', null)->exists())
                <div class="relative flex" style="position: absolute">
                    <div
                        class="relative inline-flex w-3 h-3 bg-red-500 border-2 border-white rounded-full left-3 dark:border-gray-900"
                        style="top: -1.6rem;"></div>
                </div>
            @endif

        </button>

        <!-- Dropdown menu -->
        <div
            class="hidden overflow-hidden z-50 my-4 max-w-sm text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg dark:divide-gray-600 dark:bg-gray-700"
            id="notification-dropdown">
            <div
                class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                {!! __('client.notifications') !!}
            </div>
            <div class="grid">
                @foreach (auth()->user()->notifications()->latest()->paginate(5) as $notification)
                    <a @isset($notification->button_url) href="{{ $notification->button_url }}" @else href="#" @endisset
                    class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                    <span
                        class="text-primary-800 text-sm font-semibold inline-flex items-center p-1.5 rounded-full dark:text-primary-400">
                        <div class="text-3xl">
                            @php($fileInfo = pathinfo($notification->icon))
                            @if(isset($fileInfo['extension']))
                                <img class="mt-1 w-8 h-8 rounded-full" src="{{ $notification->icon }}" alt="">
                            @else
                                {!! $notification->icon !!}
                            @endif


                        </div>
                        <span class="sr-only">{!! __('client.icon_description') !!}</span>
                      </span>
                        <div class="pl-3 w-full">
                            <div
                                class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">{{ $notification->message }}</div>
                            <div
                                class="text-xs font-medium text-gray-700 dark:text-gray-400">{{ $notification->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </a>
                @endforeach
                {{--                <div class="mt-2 mb-2">--}}
                {{--                    {{ auth()->user()->notifications()->latest()->paginate(5)->links(Theme::pagination()) }}--}}
                {{--                </div>--}}
            </div>
            <a href="{{ route('notifications.mark-as-read') }}"
               class="block py-2 text-base font-normal text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:underline">
                <div class="inline-flex items-center ">
                    <svg aria-hidden="true" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                        <path fill-rule="evenodd"
                              d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                              clip-rule="evenodd"></path>
                    </svg>
                    {!! __('client.mark_as_read') !!}
                </div>
            </a>
        </div>

        <span class="hidden mx-2 w-px h-5 bg-gray-200 dark:bg-gray-600 lg:inline"></span>

        <!-- Apps -->
        <button type="button" data-dropdown-toggle="apps-dropdown"
                class="p-2 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
            <span class="sr-only">{!! __('client.view_notifications') !!}</span>
            <!-- Icon -->
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                </path>
            </svg>
        </button>
        <!-- Dropdown menu -->
        <div
            class="hidden overflow-hidden z-50 my-4 max-w-sm text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg dark:bg-gray-700 dark:divide-gray-600"
            id="apps-dropdown">
            <div
                class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                {!! __('client.apps') !!}
            </div>
            <div class="grid grid-cols-3 gap-4 p-4">

                <a href="{{ route('email.history') }}"
                   class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                    <div
                        class="mx-auto mb-1 text-3xl text-gray-400 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-400">
                        <i class='bx bxs-inbox'></i>
                    </div>
                    <div class="text-sm text-gray-900 dark:text-white">{!! __('client.email_history') !!}</div>
                </a>

                <a href="{{ route('invoices') }}"
                   class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                    <div
                        class="mx-auto mb-1 text-3xl text-gray-400 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-400">
                        <i class='bx bxs-wallet'></i>
                    </div>
                    <div class="text-sm text-gray-900 dark:text-white">{!! __('client.invoice_history') !!}</div>
                </a>

                @foreach (Module::allEnabled() as $module)
                    @if(config($module->getLowerName() . '.elements.apps'))
                        @foreach (config($module->getLowerName() . '.elements.apps') as $key => $menu)
                            <a href="{{ $menu['href'] }}"
                               class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                <div
                                    class="mx-auto mb-1 text-3xl text-gray-400 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-400"
                                    style="{{ $menu['style'] }}">
                                    {!! $menu['icon'] !!}
                                </div>
                                <div class="text-sm text-gray-900 dark:text-white">{!! __($menu['name']) !!}</div>
                            </a>
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
        @foreach (Module::allEnabled() as $module)
            @includeIf(Theme::moduleView($module->getLowerName(), 'elements.navbar-dropdown-right'))
        @endforeach

        <button type="button"
                class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                id="userMenuDropdownButton" aria-expanded="false" data-dropdown-toggle="userMenuDropdown">
            <span class="sr-only">{!! __('client.open_user_menu') !!}</span>
            @if (auth()->user()->avatar !== null)
                <img class="w-8 h-8 rounded-full" src="{{ auth()->user()->avatar() }}" alt="user photo">
            @else
                <div
                    class="relative inline-flex items-center justify-center w-8 h-8 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                <span
                    class="font-medium text-gray-600 dark:text-gray-300">{{ substr(auth()->user()->first_name, 0, 1) . substr(auth()->user()->last_name, 0, 1) }}</span>
                </div>
            @endif
        </button>
        <!-- Dropdown menu -->
        <div
            class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
            id="userMenuDropdown">
            <div class="py-3 px-4">
            <span
                class="block text-sm font-semibold text-gray-900 dark:text-white">{{ auth()->user()->first_name }}
                {{ auth()->user()->last_name }}</span>
                <span
                    class="block text-sm font-light text-gray-500 truncate dark:text-gray-400">{{ auth()->user()->email }}</span>
            </div>
            <ul class="py-1 font-light text-gray-500 dark:text-gray-400"
                aria-labelledby="userMenuDropdownButton">
                <li>
                    <a href="{{ route('user.settings') }}"
                       class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
                        <span class="flex items-center"><i class='bx bxs-user mr-1'></i> {!! __('client.account_settings') !!}</span></a>
                </li>
                <li aria-labelledby="dropdownNavbarLink">
                    <button id="doubleDropdownButton" data-dropdown-toggle="doubleDropdown"
                            data-dropdown-placement="right-start" type="button"
                            class="flex items-center justify-between w-full py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
                        @if(auth()->user()->visibility == 'online')
                            <span class="flex items-center"><i class='bx bxs-circle mr-1 text-green-600'></i> {!! __('client.online') !!}</span>
                        @elseif(auth()->user()->visibility == 'away')
                            <span class="flex items-center"><i class='bx bxs-circle text-yellow-500 mr-1'></i> {!! __('client.away') !!}</span>
                        @elseif(auth()->user()->visibility == 'busy')
                            <span class="flex items-center"><i class='bx bxs-minus-circle text-red-500 mr-1'></i> {!! __('client.busy') !!}</span>
                        @elseif(auth()->user()->visibility == 'offline')
                            <span class="flex items-center"><i class='bx bxs-circle text-gray-600 mr-1'></i> {!! __('client.appear_offline') !!}</span>
                        @endif
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div id="doubleDropdown"
                         class="z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 hidden"
                         style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(186px, 44px);"
                         data-popper-placement="right-start">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="doubleDropdownButton">
                            <li>
                                <a href="{{ route('user.visibility', 'online') }}"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
                                    <span class="flex items-center"><i class='bx bxs-circle text-green-600 mr-1'></i> {!! __('client.online') !!}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.visibility', 'away') }}"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
                                    <span class="flex items-center"><i class='bx bxs-circle text-yellow-500 mr-1'></i> {!! __('client.away') !!}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.visibility', 'busy') }}"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
                                    <span class="flex items-center"><i
                                            class='bx bxs-minus-circle text-red-500 mr-1'></i> {!! __('client.busy') !!}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.visibility', 'offline') }}"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
                                    <span class="flex items-center"><i class='bx bxs-circle text-gray-600 mr-1'></i> {!! __('client.appear_offline') !!}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="py-1 font-light text-gray-500 dark:text-gray-400"
                aria-labelledby="userMenuDropdownButton">
                {{-- load module nav items  --}}
                @foreach (Module::allEnabled() as $module)
                    @if(config($module->getLowerName() . '.elements.user_dropdown'))
                        @foreach (config($module->getLowerName() . '.elements.user_dropdown') as $key => $menu)
                            <li>
                                <a href="{{ $menu['href'] }}"
                                   class="flex items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <span class="mr-2 text-xl text-gray-400">
                                    <?php
                                        $icons = explode('></i>', $menu['icon']);
                                        $bxIcon = (count($icons) === 1) ? $icons[0] . '></i>' : collect($icons)->first(fn($i) => strpos($i, 'bx') !== false) . '></i>';
                                    ?>
                                    {!! $bxIcon !!}
                                </span>
                                    {{ $menu['name'] }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                @endforeach
            </ul>
            <ul class="py-1 font-light text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                @admin
                <li>
                    <a href="{{ route('admin.view') }}"
                       class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
                        <i class='bx bx-cog mr-1'></i>{!! __('client.admin') !!}</a>
                </li>
                @endadmin
                <li>
                    <a href="{{ route('logout') }}"
                       class="block py-2 px-4 text-sm text-red-500 dark:text-red-500 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <i class='bx bx-log-out mr-1'></i> {!! __('client.sign_out') !!}</a>
            </li>
        </ul>
    </div>
    @endauth

</div>
