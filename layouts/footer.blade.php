<!-- drawer component -->
<div id="drawer-example"
     class="fixed left-0 top-0 z-40 h-screen w-80 -translate-x-full overflow-y-auto bg-white p-4 transition-transform dark:bg-gray-800"
     tabindex="-1" aria-labelledby="drawer-label">
    <h5 id="drawer-label"
        class="mb-4 inline-flex items-center text-base font-semibold text-gray-500 dark:text-gray-400">
        <svg
            class="mr-2 h-5 w-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                  clip-rule="evenodd"></path>
        </svg>{!! __('client.info') !!}</h5>
    <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example"
            class="absolute right-2.5 top-2.5 inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
        <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
             xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">{!! __('client.close_menu') !!}</span>
    </button>
    <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">
        {!! __('client.balance_sidebar_desc') !!}
    </p>

    <form action="{{ route('balance.add') }}" method="POST">
        @csrf
        <div class="mb-4">
            <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">{!! __('client.balance_how_add') !!}</h3>
            <ul class="grid w-full gap-6 md:grid-cols-2">
                <li>
                    <input type="radio" id="5" value="5" onclick="preset(5)" name="preselected_amount"
                           class="peer hidden"
                           checked="">
                    <label for="5"
                           class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-600 peer-checked:border-blue-600 peer-checked:text-blue-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:peer-checked:text-blue-500">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">{{ currency('symbol') }}5.00</div>
                        </div>
                    </label>
                </li>
                <li>
                    <input type="radio" id="10" value="10" onclick="preset(10)" name="preselected_amount"
                           class="peer hidden">
                    <label for="10"
                           class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-600 peer-checked:border-blue-600 peer-checked:text-blue-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:peer-checked:text-blue-500">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">{{ currency('symbol') }}10.00</div>
                        </div>
                    </label>
                </li>
                <li>
                    <input type="radio" id="20" value="20" onclick="preset(20)" name="preselected_amount"
                           class="peer hidden">
                    <label for="20"
                           class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-600 peer-checked:border-blue-600 peer-checked:text-blue-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:peer-checked:text-blue-500">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">{{ currency('symbol') }}20.00</div>
                        </div>
                    </label>
                </li>
                <li>
                    <input type="radio" id="50" value="50" onclick="preset(50)" name="preselected_amount"
                           class="peer hidden">
                    <label for="50"
                           class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-600 peer-checked:border-blue-600 peer-checked:text-blue-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:peer-checked:text-blue-500">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">{{ currency('symbol') }}50.00</div>
                        </div>
                    </label>
                </li>
            </ul>

            <div class="relative mb-6 mt-6">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2"
                         stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 0 0 0 4h2a2 2 0 0 1 0 4h-2a2 2 0 0 1 -1.8 -1"/>
                        <path d="M12 6v2m0 8v2"/>
                    </svg>
                </div>
                <input type="number" id="amount" name="amount"
                       class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                       value="5">
            </div>

            <div class="">
                <select
                    class="mb-6 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                    name="gateway" tabindex="-1" aria-hidden="true" required>
                    @foreach (App\Models\Gateways\Gateway::getActive() as $gateway)
                        @if ($gateway->driver == 'Balance')
                            @continue
                        @endif
                        <option value="{{ $gateway->id }}">{{ $gateway->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="">
            <button type="submit"
                    class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mb-2 mr-2 w-full rounded-lg px-5 py-2.5 text-sm font-medium text-white focus:outline-none focus:ring-4">{!! __('client.pay_now') !!}</button>
        </div>
    </form>
</div>
<!-- drawer component -->

{{-- User Profile popup --}}
<div data-popover id="popover-user-profile" role="tooltip"
     class="invisible absolute z-10 inline-block w-64 rounded-lg border border-gray-200 bg-white text-sm text-gray-500 opacity-0 shadow-sm transition-opacity duration-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400">
    <div class="p-3">
        <div class="mb-2 flex items-center justify-between">
            <a href="#">
                {{--                <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Jese Leos"> --}}
            </a>
            <div>
                <button type="button"
                        class="rounded-lg bg-blue-700 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('client.follow') }}</button>
            </div>
        </div>
        <p class="text-base font-semibold leading-none text-gray-900 dark:text-white">
            <a href="#">Jese Leos</a>
        </p>
        <p class="mb-3 text-sm font-normal">
            <a href="#" class="hover:underline">@jeseleos</a>
        </p>
        <p class="mb-4 text-sm">{!! __('client.opensource_contributor_building_flowbitecom') !!}</p>
        <ul class="flex text-sm">
            <li class="mr-2">
                <a href="#" class="hover:underline">
                    <span class="font-semibold text-gray-900 dark:text-white">799</span>
                    <span>{{ __('client.following') }}</span>
                </a>
            </li>
            <li>
                <a href="#" class="hover:underline">
                    <span class="font-semibold text-gray-900 dark:text-white">3,758</span>
                    <span>{{ __('client.followers') }}</span>
                </a>
            </li>
        </ul>
    </div>
    <div data-popper-arrow></div>
</div>

<script>
    function preset(amount) {
        element = document.getElementById("amount").value = amount;
    }
</script>

@include(Theme::path('layouts.cookie'))

{{-- footer --}}
<footer class="bg-white p-4 dark:bg-gray-800 sm:p-6" style="margin-top: auto;">
    <div class="mx-auto max-w-screen-xl">
        <div class="md:flex md:justify-between">
            <div class="mb-6 md:mb-0">
                <a href="/" class="flex items-center">
                    @if (Settings::has('logo'))
                        <img src="@settings('logo')" class="mr-3 h-8 rounded" alt="@settings('app_name', 'WemX')"/>
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
                                    <a href="{{ route('page', $page->path) }}" @if ($page->new_tab) target="_blank"
                                       @endif
                                       class="hover:underline">{{ $page->name }}</a>
                                </li>
                            @endif
                        @endforeach
                        @foreach (enabledModules() as $module)
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
                                    <a href="{{ route('page', $page->path) }}" @if ($page->new_tab) target="_blank"
                                       @endif
                                       class="hover:underline">{{ $page->name }}</a>
                                </li>
                            @endif
                        @endforeach
                        @foreach (enabledModules() as $module)
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
                                    <a href="{{ route('page', $page->path) }}" @if ($page->new_tab) target="_blank"
                                       @endif
                                       class="hover:underline">
                                        {{ $page->name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                        @foreach (enabledModules() as $module)
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
{{-- end footer --}}

<!-- Place your JavaScript code here -->
@if (session('code'))
    {!! session('code') !!}
@endif

<script>
    function toggleDarkmode() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }
</script>

<script>
    async function copyToClipboard(button) {
        try {
            let textToCopy = button.textContent.trim();
            let tempInput = document.createElement("input");
            document.body.appendChild(tempInput);
            tempInput.value = textToCopy;
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            button.innerText = '{!! __('client.copied') !!}';
            setTimeout(function () {
                button.innerText = textToCopy;
            }, 3000);
            console.log('Text copied to clipboard');
        } catch (err) {
            console.error('Error in copying text: ', err);
        }
    }
</script>
