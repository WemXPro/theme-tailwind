<!-- drawer component -->
<div id="drawer-example" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label">
    <h5 id="drawer-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg class="w-5 h-5 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>{!! __('client.info') !!}</h5>
    <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
       <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
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
                <input type="radio" id="5" value="5" onclick="preset(5)" name="preselected_amount" class="hidden peer" checked="">
                <label for="5" class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <div class="block">
                        <div class="w-full text-lg font-semibold">{{ currency('symbol') }}5.00</div>
                    </div>
                </label>
            </li>
            <li>
                <input type="radio" id="10" value="10" onclick="preset(10)" name="preselected_amount" class="hidden peer">
                <label for="10" class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <div class="block">
                        <div class="w-full text-lg font-semibold">{{ currency('symbol') }}10.00</div>
                    </div>
                </label>
            </li>
            <li>
                <input type="radio" id="20" value="20" onclick="preset(20)" name="preselected_amount" class="hidden peer">
                <label for="20" class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <div class="block">
                        <div class="w-full text-lg font-semibold">{{ currency('symbol') }}20.00</div>
                    </div>
                </label>
            </li>
            <li>
                <input type="radio" id="50" value="50" onclick="preset(50)" name="preselected_amount" class="hidden peer">
                <label for="50" class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <div class="block">
                        <div class="w-full text-lg font-semibold">{{ currency('symbol') }}50.00</div>
                    </div>
                </label>
            </li>
        </ul>

        <div class="relative mb-6 mt-6">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="12" cy="12" r="9" />  <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 0 0 0 4h2a2 2 0 0 1 0 4h-2a2 2 0 0 1 -1.8 -1" />  <path d="M12 6v2m0 8v2" /></svg>
        </div>
        <input type="number" id="amount" name="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="5">
        </div>

        <div class="">
            <select
            class="bg-gray-50 border border-gray-300 mb-6 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            name="gateway"
            tabindex="-1"
            aria-hidden="true"
            required>
            @foreach (App\Models\Gateways\Gateway::getActive() as $gateway)
                @if($gateway->driver == 'Balance')
                    @continue
                @endif
                <option value="{{ $gateway->id }}">{{ $gateway->name }}</option>
            @endforeach
        </select>
        </div>
    </div>


    <div class="">
        <button type="submit" class="w-full focus:outline-none text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">{!! __('client.pay_now') !!}</button>
    </div>
    </form>
</div>
<!-- drawer component -->

{{-- User Profile popup --}}
<div data-popover id="popover-user-profile" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
    <div class="p-3">
        <div class="flex items-center justify-between mb-2">
            <a href="#">
                <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Jese Leos">
            </a>
            <div>
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ __('client.follow') }}</button>
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

{{-- footer  --}}
<footer class="p-4 bg-white sm:p-6 dark:bg-gray-800" style="margin-top: auto;">
    <div class="mx-auto max-w-screen-xl">
        <div class="md:flex md:justify-between">
            <div class="mb-6 md:mb-0">
                <a href="/" class="flex items-center">
                    @if (Settings::has('logo'))
                        <img src="@settings('logo')" class="mr-3 h-8 rounded" alt="@settings('app_name', 'WemX')" />
                    @endif <span
                        class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">@settings('app_name',
                        'WemX')</span>
                </a>
            </div>
            <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">{!! __('client.resources') !!}</h2>
                    <ul class="text-gray-600 dark:text-gray-400">
                        @foreach(Page::getActive() as $page)
                            @if(in_array('footer_resources', $page->placement))
                                <li class="mb-4">
                                    <a href="{{ route('page', $page->path) }}" @if($page->new_tab) target="_blank" @endif class="hover:underline">{{ $page->name }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">{!! __('client.help_center') !!}</h2>
                    <ul class="text-gray-600 dark:text-gray-400">
                        @if(!settings('contact_us_enabled', true))
                        <li class="mb-4">
                            <a href="{{ route('contact') }}" class="hover:underline">{!! __('client.contact_us') !!}</a>
                        </li>
                        @endif
                        @foreach(Page::getActive() as $page)
                            @if(in_array('footer_help_center', $page->placement))
                                <li class="mb-4">
                                    <a href="{{ route('page', $page->path) }}" @if($page->new_tab) target="_blank" @endif class="hover:underline">{{ $page->name }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">{!! __('client.legal') !!}</h2>
                    <ul class="text-gray-600 dark:text-gray-400">
                        @foreach(Page::getActive() as $page)
                            @if(in_array('footer_legal', $page->placement))
                                <li class="mb-4">
                                    <a href="{{ route('page', $page->path) }}" @if($page->new_tab) target="_blank" @endif class="hover:underline">{{ $page->name }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
                {{ __('client.powered_by') }}
                <a href="https://wemx.net" target="_blank" class="hover:underline text-primary-600 dark:text-primary-500">WemX™</a>.
            </span>
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
                © {{ date('Y') }}
                <a href="/" class="hover:underline">@settings('app_name', 'WemX')™</a>.
                {!! __('client.all_rights_reserved') !!}
            </span>
            <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                @if(settings('socials::discord'))
                <a href="@settings('socials::discord')" target="_blank" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                    <i class='bx bxl-discord-alt' style="font-size: 1.25rem"></i>
                </a>
                @endif
                @if(settings('socials::twitter'))
                <a href="@settings('socials::twitter')" target="_blank" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                    </svg>
                </a>
                @endif
                @if(settings('socials::github'))
                <a href="@settings('socials::github')" target="_blank" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                @endif
            </div>
        </div>
    </div>
</footer>
{{-- end footer --}}

<!-- Place your JavaScript code here -->
@if(session('code'))
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
            setTimeout(function(){
                button.innerText = textToCopy;
            }, 3000);
            console.log('Text copied to clipboard');
        } catch (err) {
            console.error('Error in copying text: ', err);
        }
    }
</script>
