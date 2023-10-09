<div class="p-6 mb-6 dark:bg-gray-800 text-gray-500 dark:text-gray-400 rounded-lg bg-white p-3 leading-6 text-slate-700 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
    <div class="text-center text-gray-500 dark:text-gray-400">
        @if (auth()->user()->avatar !== null)
        <img class="mx-auto mb-4 w-20 h-20 rounded-full" src="{{ auth()->user()->avatar() }}" alt="user photo" />
        @else
        <div class="relative inline-flex items-center justify-center w-20 h-20 mb-4 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
            <span class="font-medium text-gray-600 dark:text-gray-300">{{ substr(auth()->user()->first_name, 0, 1) . substr(auth()->user()->last_name, 0, 1) }}</span>
        </div>
        @endif
        <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
            <a href="#">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</a>
        </h3>
        <p class="font-light text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
        <a
            href="{{ route('user.settings') }}"
            class="inline-flex items-center justify-center w-full py-2.5 px-5 my-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
        >
            {!! __('client.update') !!}
        </a>
        <div class="leading-none text-gray-900 dark:text-gray-200 mb-4" style="display: flex; justify-content: space-between; align-items: center;">
            {!! __('client.visibility') !!}
            <span class="bg-gray-100 text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                @if(auth()->user()->visibility == 'online')
                <span class="flex items-center"><i class='bx bxs-circle mr-1 text-green-600'></i> {!! __('client.online') !!}</span>
                @elseif(auth()->user()->visibility == 'away')
                    <span class="flex items-center"><i class='bx bxs-circle text-yellow-500 mr-1'></i> {!! __('client.away') !!}</span>
                @elseif(auth()->user()->visibility == 'busy')
                    <span class="flex items-center"><i class='bx bxs-minus-circle text-red-500 mr-1'></i> {!! __('client.busy') !!}</span>
                @elseif(auth()->user()->visibility == 'offline')
                    <span class="flex items-center"><i class='bx bxs-circle text-gray-600 mr-1'></i> {!! __('client.appear_offline') !!}</span>
                @endif
            </span>
        </div>
        <div class="leading-none text-gray-900 dark:text-gray-200 mb-4" style="display: flex; justify-content: space-between; align-items: center;">
            {!! __('client.last_login_at') !!}
            <span class="bg-gray-100 text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                @if(auth()->user()->last_login_at == null)
                    {!! __('client.never') !!} @else
                    {{ auth()->user()->last_login_at->diffForHumans() }}
                @endif
            </span>
        </div>
        <div class="leading-none text-gray-900 dark:text-gray-200 mb-4" style="display: flex; justify-content: space-between; align-items: center;">
            {!! __('client.member_since') !!} <span class="bg-gray-100 text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ auth()->user()->created_at->translatedFormat(settings('date_format', 'd M Y')) }}</span>
        </div>
    </div>
</div>
