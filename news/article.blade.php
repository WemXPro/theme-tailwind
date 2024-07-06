@extends(Theme::wrapper(), ['meta_description' => $article->short_desc])

@section('title', $article->title)

@section('header')
    <link rel="stylesheet" href="{{ Theme::get('Default')->assets }}assets/css/typography.min.css">
@endsection

@section('header')
    <link rel="stylesheet" href="{{ Theme::get('Default')->assets }}assets/css/typography.min.css">
@endsection

@section('container')
    @php($article->translate())
    <main class="pb-16 antialiased dark:bg-gray-900 lg:pb-24">
        <div class="mx-auto flex max-w-screen-xl justify-between px-4">
            <article class="format format-sm sm:format-base lg:format-lg format-blue dark:format-invert mx-auto w-full max-w-5xl">
                <header class="not-format mb-4 lg:mb-6">
                    @if ($article->show_author)
                        <address class="mb-6 flex items-center not-italic">
                            <div class="mr-3 inline-flex items-center text-sm text-gray-900 dark:text-white">
                                <img class="mr-4 h-16 w-16 rounded-full" src="{{ $article->user->avatar() }}" alt="{{ __('client.author') }}">
                                <div>
                                    <a href="#" rel="author"
                                        class="text-xl font-bold text-gray-900 dark:text-white">{{ $article->user->username }}</a>
                                    <p class="text-base text-gray-500 dark:text-gray-400">
                                        @if ($article->user->is_admin())
                                            {{ __('client.administrator') }}
                                        @endif
                                    </p>
                                    <p class="text-base text-gray-500 dark:text-gray-400">
                                        <time pubdate>{{ $article->created_at->translatedFormat('M d, Y') }}</time>
                                    </p>
                                </div>
                            </div>
                        </address>
                    @endif
                    <div class="mb-4 flex">
                        @foreach ($article->labels as $label)
                            <span
                                class="bg-{{ config("article.labels.$label.theme") }}-100 text-{{ config("article.labels.$label.theme") }}-800 dark:bg-{{ config("article.labels.$label.theme") }}-900 dark:text-{{ config("article.labels.$label.theme") }}-300 mr-2 rounded px-2.5 py-0.5 text-sm font-medium">
                                <span class="mr-1 mt-1 text-sm">{!! config("article.labels.$label.icon") !!}</span>
                                {{ config("article.labels.$label.name") }}
                            </span>
                        @endforeach
                    </div>
                    <div class="flex items-end justify-between">
                        <h1 class="text-3xl font-extrabold leading-tight text-gray-900 dark:text-white lg:text-4xl">{{ $article->title }}</h1>
                        <div class="flex items-center justify-between">
                            <button type="button" class="rounded-lg px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-800"
                                onclick="window.location.replace('{{ route('news.react', ['article' => $article->id, 'emoji' => 'fire']) }}')">
                                <svg aria-hidden="true" class="mb-1 h-6" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M24 14.1907C24 12.7352 23.7409 11.3397 23.2659 10.0486C22.9412 13.8526 20.9132 15.8065 18.7941 14.8966C16.8092 14.0439 18.1468 10.7199 18.2456 9.13377C18.4122 6.44506 18.2372 3.36742 13.3532 0.808594C15.3826 4.69095 13.5882 7.10295 11.7064 7.24977C9.61835 7.41283 7.70612 5.45542 8.412 2.27895C6.12635 3.96318 6.06 6.79801 6.76518 8.63189C7.50071 10.5434 6.73553 12.1317 4.94188 12.3081C2.93718 12.5058 1.82329 10.1615 2.85035 6.42601C1.07294 8.51895 0 11.2295 0 14.1907C0 20.8182 5.37247 26.1907 12 26.1907C18.6275 26.1907 24 20.8182 24 14.1907Z"
                                        fill="#F4900C"></path>
                                    <path
                                        d="M19.3349 17.7211C19.4393 19.8981 17.5271 20.7515 16.4979 20.3393C15.0113 19.7442 15.4102 18.7221 15.0276 16.6044C14.645 14.4868 13.1746 13.0164 10.9984 12.3691C12.5866 16.8395 10.1182 18.487 8.82428 18.7814C7.50287 19.0821 6.17511 18.7807 6.02334 15.9529C4.4817 17.4875 3.52734 19.6108 3.52734 21.9571C3.52734 22.2169 3.54358 22.4724 3.56617 22.7266C5.73323 24.8682 8.70993 26.1924 11.9979 26.1924C15.2859 26.1924 18.2626 24.8682 20.4297 22.7266C20.4523 22.4724 20.4685 22.2169 20.4685 21.9571C20.4685 20.4134 20.0563 18.967 19.3349 17.7211Z"
                                        fill="#FFCC4D"></path>
                                </svg>
                                <span
                                    class="@if (auth()->check() and
                                            $article->reactions()->where('user_id', auth()->user()->id)->where('emoji', 'fire')->exists()) text-primary-500 dark:text-primary-400 @else text-gray-500 dark:text-gray-400 @endif text-sm font-medium">
                                    {{ $article->reactions()->where('emoji', 'fire')->count() }}
                                </span>
                            </button>
                            <button type="button" class="rounded-lg px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-800"
                                onclick="window.location.replace('{{ route('news.react', ['article' => $article->id, 'emoji' => 'medal']) }}')">
                                <svg aria-hidden="true" class="mb-1 h-6" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.333 5.83236L7.66634 0.499023H0.333008L9.66634 11.8324L17.347 8.66569L12.333 5.83236Z"
                                        fill="#55ACEE"></path>
                                    <path d="M16.9997 0.499023L12.333 5.83236L15.9263 10.707L16.7443 9.71436L24.333 0.499023H16.9997Z"
                                        fill="#3B88C3"></path>
                                    <path
                                        d="M15.8401 11.184C15.8934 11.0393 15.9274 10.8853 15.9274 10.722C15.9274 9.98601 15.3301 9.38867 14.5941 9.38867H10.1494C9.41274 9.38867 8.81608 9.98601 8.81608 10.722C8.81608 10.8853 8.84941 11.0393 8.90341 11.184C6.73141 12.4013 5.26074 14.722 5.26074 17.3887C5.26074 21.316 8.44408 24.5 12.3721 24.5C16.2994 24.5 19.4834 21.316 19.4834 17.3887C19.4827 14.722 18.0127 12.4013 15.8401 11.184Z"
                                        fill="#FFAC33"></path>
                                    <path
                                        d="M12.3724 22.7214C15.3179 22.7214 17.7057 20.3335 17.7057 17.388C17.7057 14.4425 15.3179 12.0547 12.3724 12.0547C9.42688 12.0547 7.03906 14.4425 7.03906 17.388C7.03906 20.3335 9.42688 22.7214 12.3724 22.7214Z"
                                        fill="#FFD983"></path>
                                    <path
                                        d="M14.5202 20.9199C14.4255 20.9199 14.3308 20.8906 14.2495 20.8326L12.3348 19.4599L10.4208 20.8326C10.2575 20.9493 10.0388 20.9493 9.87682 20.8306C9.71482 20.7133 9.64682 20.5046 9.70682 20.3146L10.4208 18.0106L8.52415 16.6739C8.36282 16.5553 8.29615 16.3459 8.35748 16.1553C8.41948 15.9653 8.59615 15.8359 8.79682 15.8346L11.1461 15.8313L11.8942 13.5846C11.9575 13.3946 12.1348 13.2666 12.3355 13.2666C12.5355 13.2666 12.7135 13.3946 12.7768 13.5846L13.5122 15.8313L15.8735 15.8346C16.0742 15.8359 16.2515 15.9653 16.3128 16.1553C16.3748 16.3459 16.3075 16.5546 16.1462 16.6739L14.2488 18.0106L14.9628 20.3146C15.0242 20.5053 14.9548 20.7133 14.7935 20.8306C14.7115 20.8906 14.6155 20.9199 14.5202 20.9199Z"
                                        fill="#FFAC33"></path>
                                </svg>
                                <span
                                    class="@if (auth()->check() and
                                            $article->reactions()->where('user_id', auth()->user()->id)->where('emoji', 'medal')->exists()) text-primary-500 dark:text-primary-400 @else text-gray-500 dark:text-gray-400 @endif text-sm font-medium">
                                    {{ $article->reactions()->where('emoji', 'medal')->count() }}
                                </span>
                            </button>
                            <button type="button" class="rounded-lg px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-800"
                                onclick="window.location.replace('{{ route('news.react', ['article' => $article->id, 'emoji' => 'moneybag']) }}')">
                                <svg aria-hidden="true" class="mb-1 h-6" viewBox="0 0 25 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M23.0905 17.9535C22.642 12.99 20.167 10.5 20.167 10.5L15.667 4.5H9.66699L5.16699 10.5C5.16699 10.5 4.10274 11.5747 3.24174 13.7062C1.74999 14.2013 0.666992 15.5918 0.666992 17.25C0.666992 18.336 1.13574 19.3065 1.87374 19.9913C1.59174 20.5177 1.41699 21.1103 1.41699 21.75C1.41699 23.2185 2.26899 24.477 3.49824 25.092C4.46049 26.5335 5.74599 27 6.66699 27H18.667C19.7012 27 21.1967 26.4157 22.1755 24.5175C23.6237 23.9992 24.667 22.6275 24.667 21C24.667 19.7415 24.0415 18.6345 23.0905 17.9535ZM12.667 4.5C13.0795 4.5 13.4605 4.3815 13.792 4.188C14.1242 4.3815 14.5052 4.5 14.917 4.5C16.1597 4.5 17.917 2.742 17.917 1.5C17.917 1.5 17.917 0 16.417 0C15.826 0 15.667 0.75 14.917 0.75C14.167 0.75 14.167 0 12.667 0C11.167 0 11.167 0.75 10.417 0.75C9.66699 0.75 9.50874 0 8.91699 0C7.41699 0 7.41699 1.5 7.41699 1.5C7.41699 2.742 9.17499 4.5 10.417 4.5C10.8287 4.5 11.2097 4.3815 11.542 4.188C11.8742 4.3815 12.2552 4.5 12.667 4.5Z"
                                        fill="#FDD888"></path>
                                    <path
                                        d="M17.167 4.5C17.167 4.914 16.8317 5.25 16.417 5.25H8.91699C8.50299 5.25 8.16699 4.914 8.16699 4.5C8.16699 4.086 8.50299 3.75 8.91699 3.75H16.417C16.8317 3.75 17.167 4.086 17.167 4.5Z"
                                        fill="#BF6952"></path>
                                    <path
                                        d="M17.0925 18.4065C17.0925 15.0487 10.6568 15.2677 10.6568 13.242C10.6568 12.261 11.6325 11.7817 12.765 11.7817C14.6685 11.7817 15.0075 12.9585 15.8693 12.9585C16.479 12.9585 16.773 12.5887 16.773 12.174C16.773 11.211 15.255 10.482 13.7993 10.23V9.3C13.7993 8.72025 13.3118 8.25 12.7088 8.25C12.105 8.25 11.6168 8.72025 11.6168 9.3V10.2622C10.0298 10.6095 8.66402 11.6685 8.66402 13.3942C8.66402 16.6185 15.0983 16.488 15.0983 18.753C15.0983 19.5382 14.2148 20.3227 12.765 20.3227C10.5893 20.3227 9.86477 18.906 8.98127 18.906C8.55077 18.906 8.16602 19.254 8.16602 19.779C8.16602 20.6137 9.61952 21.6172 11.6183 21.897L11.6175 21.9045V22.953C11.6175 23.532 12.1065 24.003 12.7095 24.003C13.3125 24.003 13.8008 23.532 13.8008 22.953V21.9045C13.8008 21.8917 13.7948 21.882 13.794 21.8707C15.5925 21.5482 17.0925 20.4217 17.0925 18.4065Z"
                                        fill="#67757F"></path>
                                </svg>
                                <span
                                    class="@if (auth()->check() and
                                            $article->reactions()->where('user_id', auth()->user()->id)->where('emoji', 'moneybag')->exists()) text-primary-500 dark:text-primary-400 @else text-gray-500 dark:text-gray-400 @endif text-sm font-medium">
                                    {{ $article->reactions()->where('emoji', 'moneybag')->count() }}
                                </span>
                            </button>
                            <button type="button" class="rounded-lg px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-800"
                                onclick="window.location.replace('{{ route('news.react', ['article' => $article->id, 'emoji' => 'party']) }}')">
                                <svg aria-hidden="true" class="mb-1 h-6" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.75255 5.29787C7.67789 5.37254 7.62122 5.46254 7.57388 5.56121L7.56855 5.55587L0.0910439 22.4003L0.0983774 22.4076C-0.0402924 22.6763 0.191713 23.223 0.667057 23.699C1.1424 24.1743 1.68908 24.4063 1.95775 24.2676L1.96442 24.2743L18.8088 16.7961L18.8035 16.7901C18.9015 16.7435 18.9915 16.6868 19.0668 16.6108C20.1082 15.5694 18.4195 12.1927 15.2961 9.06862C12.1713 5.94455 8.79458 4.25651 7.75255 5.29787Z"
                                        fill="#DD2E44"></path>
                                    <path
                                        d="M8.66858 8.30273L0.279048 21.9737L0.0910439 22.3971L0.0983774 22.4044C-0.0402924 22.6731 0.191713 23.2197 0.667057 23.6958C0.821728 23.8504 0.982398 23.9678 1.13973 24.0671L11.3353 11.6361L8.66858 8.30273Z"
                                        fill="#EA596E"></path>
                                    <path
                                        d="M15.3439 9.01304C18.4573 12.1278 20.186 15.4479 19.2033 16.4292C18.2213 17.4119 14.9012 15.6839 11.7858 12.5705C8.67174 9.45572 6.9437 6.13431 7.92573 5.15228C8.90841 4.17026 12.2285 5.8983 15.3439 9.01304Z"
                                        fill="#A0041E"></path>
                                    <path
                                        d="M12.3913 9.37694C12.2587 9.48427 12.0853 9.54028 11.902 9.52028C11.3233 9.45761 10.8366 9.25627 10.496 8.93826C10.1353 8.60159 9.95727 8.14958 10.0059 7.6969C10.0913 6.90221 10.8886 6.17286 12.248 6.31953C12.7767 6.3762 13.0127 6.2062 13.0207 6.12486C13.03 6.04419 12.836 5.82752 12.3073 5.77019C11.7286 5.70752 11.242 5.50618 10.9006 5.18817C10.54 4.8515 10.3613 4.39949 10.4106 3.94681C10.4973 3.15213 11.294 2.42278 12.652 2.57011C13.0373 2.61145 13.2407 2.53211 13.3267 2.48078C13.3954 2.43878 13.4227 2.39878 13.4254 2.37544C13.4334 2.29477 13.242 2.0781 12.712 2.02077C12.346 1.98077 12.0807 1.65276 12.1213 1.28608C12.1607 0.920076 12.488 0.655404 12.8553 0.695405C14.2134 0.841408 14.8374 1.72343 14.7514 2.51878C14.6647 3.3148 13.868 4.04281 12.5087 3.89681C12.1233 3.85481 11.922 3.93481 11.8353 3.98615C11.7666 4.02748 11.7386 4.06815 11.736 4.09082C11.7273 4.17215 11.92 4.38816 12.45 4.44549C13.808 4.59216 14.432 5.47351 14.346 6.26887C14.26 7.06355 13.4634 7.7929 12.1047 7.64557C11.7193 7.60423 11.5166 7.68423 11.43 7.7349C11.3606 7.77757 11.334 7.81757 11.3313 7.84024C11.3226 7.9209 11.5153 8.13758 12.0447 8.19491C12.41 8.23491 12.676 8.56359 12.6353 8.92959C12.6167 9.11226 12.524 9.27027 12.3913 9.37694Z"
                                        fill="#AA8DD8"></path>
                                    <path
                                        d="M20.4411 15.5411C21.7565 15.1698 22.6638 15.7565 22.8798 16.5265C23.0958 17.2958 22.6278 18.2699 21.3131 18.6399C20.7998 18.7839 20.6458 19.0292 20.6665 19.1072C20.6891 19.1859 20.9498 19.3152 21.4618 19.1706C22.7765 18.8005 23.6839 19.3872 23.8999 20.1566C24.1172 20.9266 23.6479 21.8993 22.3325 22.27C21.8198 22.414 21.6651 22.66 21.6878 22.738C21.7098 22.816 21.9698 22.9453 22.4825 22.8013C22.8358 22.702 23.2052 22.908 23.3045 23.262C23.4032 23.6167 23.1972 23.9847 22.8425 24.0847C21.5285 24.4547 20.6205 23.8693 20.4031 23.0986C20.1871 22.3293 20.6558 21.3566 21.9718 20.9859C22.4852 20.8413 22.6392 20.5966 22.6165 20.5179C22.5952 20.4399 22.3352 20.3099 21.8232 20.4539C20.5071 20.8246 19.6004 20.2392 19.3838 19.4679C19.1671 18.6985 19.6358 17.7259 20.9511 17.3545C21.4631 17.2112 21.6171 16.9645 21.5958 16.8872C21.5731 16.8085 21.3138 16.6792 20.8011 16.8232C20.4465 16.9232 20.0791 16.7165 19.9791 16.3625C19.8798 16.0092 20.0864 15.6411 20.4411 15.5411Z"
                                        fill="#77B255"></path>
                                    <path
                                        d="M15.3333 13.7449C15.1373 13.7449 14.9439 13.6589 14.8119 13.4949C14.5819 13.2069 14.6292 12.7875 14.9159 12.5575C15.0612 12.4409 18.528 9.71812 23.4274 10.4188C23.7921 10.4708 24.0455 10.8081 23.9935 11.1728C23.9415 11.5368 23.6068 11.7928 23.2388 11.7382C18.91 11.1235 15.7806 13.5742 15.7499 13.5989C15.6259 13.6975 15.4793 13.7449 15.3333 13.7449Z"
                                        fill="#AA8DD8"></path>
                                    <path
                                        d="M3.83539 10.9697C3.77205 10.9697 3.70739 10.9604 3.64338 10.9417C3.29071 10.8357 3.0907 10.4643 3.19671 10.1117C3.95206 7.59628 4.63674 3.58219 3.79539 2.5355C3.70138 2.41683 3.55938 2.30016 3.23404 2.32483C2.60869 2.37283 2.66803 3.69219 2.66869 3.70552C2.69669 4.07287 2.42069 4.39287 2.05401 4.42021C1.68134 4.44287 1.36666 4.1722 1.33933 3.80486C1.27066 2.8855 1.55667 1.1148 3.13404 0.995461C3.83805 0.942127 4.42273 1.1868 4.83541 1.70014C6.41611 3.66752 4.81141 9.37099 4.47407 10.495C4.3874 10.7837 4.12206 10.9697 3.83539 10.9697Z"
                                        fill="#77B255"></path>
                                    <path
                                        d="M16.999 7.63774C17.5513 7.63774 17.9991 7.19002 17.9991 6.63772C17.9991 6.08542 17.5513 5.6377 16.999 5.6377C16.4467 5.6377 15.999 6.08542 15.999 6.63772C15.999 7.19002 16.4467 7.63774 16.999 7.63774Z"
                                        fill="#5C913B"></path>
                                    <path
                                        d="M1.33336 13.6355C2.06976 13.6355 2.66673 13.0385 2.66673 12.3021C2.66673 11.5657 2.06976 10.9688 1.33336 10.9688C0.596967 10.9688 0 11.5657 0 12.3021C0 13.0385 0.596967 13.6355 1.33336 13.6355Z"
                                        fill="#9266CC"></path>
                                    <path
                                        d="M21.666 14.3047C22.2183 14.3047 22.6661 13.857 22.6661 13.3047C22.6661 12.7524 22.2183 12.3047 21.666 12.3047C21.1137 12.3047 20.666 12.7524 20.666 13.3047C20.666 13.857 21.1137 14.3047 21.666 14.3047Z"
                                        fill="#5C913B"></path>
                                    <path
                                        d="M15.666 22.3038C16.2183 22.3038 16.6661 21.856 16.6661 21.3037C16.6661 20.7514 16.2183 20.3037 15.666 20.3037C15.1137 20.3037 14.666 20.7514 14.666 21.3037C14.666 21.856 15.1137 22.3038 15.666 22.3038Z"
                                        fill="#5C913B"></path>
                                    <path
                                        d="M18.6683 4.30052C19.4047 4.30052 20.0017 3.70355 20.0017 2.96715C20.0017 2.23076 19.4047 1.63379 18.6683 1.63379C17.9319 1.63379 17.335 2.23076 17.335 2.96715C17.335 3.70355 17.9319 4.30052 18.6683 4.30052Z"
                                        fill="#FFCC4D"></path>
                                    <path
                                        d="M21.6699 6.9688C22.2222 6.9688 22.67 6.52107 22.67 5.96877C22.67 5.41648 22.2222 4.96875 21.6699 4.96875C21.1176 4.96875 20.6699 5.41648 20.6699 5.96877C20.6699 6.52107 21.1176 6.9688 21.6699 6.9688Z"
                                        fill="#FFCC4D"></path>
                                    <path
                                        d="M19.668 9.63384C20.2203 9.63384 20.668 9.18611 20.668 8.63381C20.668 8.08151 20.2203 7.63379 19.668 7.63379C19.1157 7.63379 18.668 8.08151 18.668 8.63381C18.668 9.18611 19.1157 9.63384 19.668 9.63384Z"
                                        fill="#FFCC4D"></path>
                                    <path
                                        d="M5.00198 16.9668C5.55427 16.9668 6.002 16.5191 6.002 15.9668C6.002 15.4145 5.55427 14.9668 5.00198 14.9668C4.44968 14.9668 4.00195 15.4145 4.00195 15.9668C4.00195 16.5191 4.44968 16.9668 5.00198 16.9668Z"
                                        fill="#FFCC4D"></path>
                                </svg>

                                <span
                                    class="@if (auth()->check() and
                                            $article->reactions()->where('user_id', auth()->user()->id)->where('emoji', 'party')->exists()) text-primary-500 dark:text-primary-400 @else text-gray-500 dark:text-gray-400 @endif text-sm font-medium">
                                    {{ $article->reactions()->where('emoji', 'party')->count() }}
                                </span>
                            </button>
                        </div>
                    </div>
                </header>
                {!! $article->content !!}

                <div class="flex justify-start">
                    <i class='bx bxs-help-circle bx-sm text-primary-600 dark:text-primary-500 mr-3 shrink-0'></i>
                    <div>
                        <h3 class="mb-1 text-lg font-semibold leading-tight text-gray-900 dark:text-white">
                            {{ __('client.was_this_article_helpful') }}</h3>
                        @if (!Cookie::has($article->id . 'feedback'))
                            <button type="button" class="rounded-lg px-3 py-2 pb-4 text-4xl hover:bg-gray-100 dark:hover:bg-gray-800"
                                onclick="window.location.replace('{{ route('news.helpful', ['article' => $article->id, 'rating' => 'like']) }}')">
                                👍
                            </button>
                            <button type="button" class="rounded-lg px-3 py-2 pb-4 text-4xl hover:bg-gray-100 dark:hover:bg-gray-800"
                                onclick="window.location.replace('{{ route('news.helpful', ['article' => $article->id, 'rating' => 'dislike']) }}')">
                                👎
                            </button>
                        @else
                            <p class="font-light text-gray-500 dark:text-gray-400">{{ __('client.thank_you_your_feedback') }}❤️</p>
                        @endif
                    </div>
                </div>
            </article>
        </div>

        @if ($article->allow_comments)
            <section class="py-8 antialiased dark:bg-gray-900 lg:py-8">
                <div class="mx-auto max-w-5xl px-4">
                    <div class="mb-6 flex items-center justify-between">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white lg:text-2xl">{{ __('client.discussion') }}
                            ({{ $article->comments()->count() }})
                        </h2>
                    </div>
                    @auth
                        <div class="flex">
                            <div class="mr-3 hidden shrink-0 sm:block">
                                <img class="h-9 w-9 rounded-full" src="{{ auth()->user()->avatar() }}" alt="{{ auth()->user()->username }}">
                            </div>
                            <form action="{{ route('news.comment', $article->id) }}" method="POST" class="mb-6 w-full">
                                @csrf
                                <div class="mb-4 w-full rounded-lg border border-gray-200 bg-gray-50 dark:border-gray-600 dark:bg-gray-700">
                                    <div class="rounded-t-lg bg-white px-4 py-2 dark:bg-gray-800">
                                        <label for="comment" class="sr-only">{{ __('client.your_comment') }}</label>
                                        <textarea name="comment" id="comment" rows="4"
                                            class="w-full border-0 bg-white px-0 text-sm text-gray-900 focus:ring-0 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400"
                                            placeholder="{{ __('client.write_a_comment') }}" required></textarea>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="bg-primary-700 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800 inline-flex items-center rounded-lg px-4 py-2.5 text-center text-xs font-medium text-white focus:ring-4">
                                    {{ __('client.post_comment') }}
                                </button>
                            </form>
                        </div>
                    @endauth

                    @foreach ($article->comments()->latest()->paginate(5) as $comment)
                        <article
                            class="mb-6 rounded-lg border border-gray-100 bg-white p-4 text-base dark:border-gray-700 dark:bg-gray-800 lg:p-6">
                            <div class="flex">
                                <div class="mr-4">
                                    <div
                                        class="flex w-9 flex-col items-center justify-center rounded-lg bg-gray-100 font-medium dark:bg-gray-700">
                                        <a href="{{ route('news.comments.upvote', $comment->id) }}"
                                            class="w-full rounded-t-lg py-1 text-gray-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-50 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                            style="display: flex;justify-content: center;">+</a>
                                        <span
                                            class="px-2 py-1 text-xs font-medium text-gray-900 dark:text-white lg:px-0 lg:text-sm">{{ $comment->upvotes }}</span>
                                        <a href="{{ route('news.comments.downvote', $comment->id) }}"
                                            class="w-full rounded-b-lg py-1 text-gray-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-50 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                            style="display: flex;justify-content: center;">-</a>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <footer class="mb-2 flex w-full items-center justify-between">
                                        <a href="#" class="flex items-center">
                                            <img class="mr-2 h-6 w-6 rounded-full" src="{{ $comment->user->avatar() }}"
                                                alt="{{ $comment->user->username }}">
                                            <p class="mr-3 inline-flex flex-col items-start text-sm text-gray-900 dark:text-white md:flex-row">
                                                <span class="font-semibold">{{ $comment->user->username }}</span>
                                                <time class="text-sm text-gray-600 dark:text-gray-400 md:ml-2" pubdate
                                                    title="{{ $comment->created_at->diffForHumans() }}">{{ $comment->created_at->diffForHumans() }}</time>
                                            </p>
                                        </a>
                                        @auth
                                            <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                                                class="inline-flex items-center rounded-lg bg-white p-2 text-center text-sm font-medium text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                                type="button">
                                                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 16 3">
                                                    <path
                                                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                                </svg>
                                                <span class="sr-only">{{ __('client.comment_settings') }}</span>
                                            </button>

                                            <!-- Dropdown menu -->
                                            <div id="dropdownComment1"
                                                class="z-10 hidden w-36 divide-y divide-gray-100 rounded bg-white shadow dark:divide-gray-600 dark:bg-gray-700">
                                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                    aria-labelledby="dropdownMenuIconHorizontalButton">
                                                    @if (
                                                        $article->user->id == auth()->user()->id or
                                                            auth()->user()->is_admin())
                                                        <li>
                                                            <a href="{{ route('news.comments.remove', $comment->id) }}"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('client.remove') }}</a>
                                                        </li>
                                                    @endif
                                                    @if (
                                                        $article->user->id !== auth()->user()->id or
                                                            auth()->user()->is_admin())
                                                        <li>
                                                            <a href="{{ route('news.comments.report', $comment->id) }}"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('client.report') }}</a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        @endauth
                                    </footer>
                                    <p class="text-gray-500 dark:text-gray-400">{{ $comment->body }}</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                    <div class="mt-2">
                        {{ $article->comments()->latest()->paginate(5)->links(Theme::pagination()) }}
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection
