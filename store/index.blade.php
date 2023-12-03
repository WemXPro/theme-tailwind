@extends(Theme::wrapper())

@section('title')
    {!! __('client.services') !!}
@endsection

@section('container')
    <div class="flex flex-wrap ">
        @foreach ($categories->all() as $category)
            @if (in_array($category->status, ['unlisted', 'inactive', 'restricted']))
                @if ($category->status == 'restricted')
                    @if (Auth::guest() or !Auth::user()->is_admin())
                        @continue
                    @endif
                @else
                    @continue
                @endif
            @endif
            <div class="md:w-1/4 pr-4 pl-4 w-full mb-6">
                <article
                    class="p-4 mx-auto max-w-sm bg-white rounded-lg shadow-md dark:bg-gray-800 border border-gray-200 dark:border-gray-800 flex flex-col h-full">
                    <a href="{{ route('store.service', ['service' => $category->link]) }}" class="block mb-5">
                        <div class="h-40 overflow-hidden">
                            <img class="w-full h-full rounded-lg object-contain" src="{{ $category->icon() }}"
                                alt="icon" />
                        </div>
                    </a>

                    <div class="flex-grow">
                        <h3
                            class="mb-2 text-xl font-bold tracking-tight text-gray-900 lg:text-2xl dark:text-white h-16 overflow-hidden">
                            <a href="{{ route('store.service', ['service' => $category->link]) }}"
                                class="block text-xl text-gray-900 lg:text-2xl dark:text-white line-clamp-3">
                                {{ $category->name }}
                            </a>
                        </h3>

                        <p id="categoryDescription_{{ $category->id }}"
                            data-truncated-description="{{ Str::limit($category->description, 80) }}"
                            data-full-description="{{ $category->description }}"
                            class="mb-3 overflow-hidden font-light text-gray-500 dark:text-gray-400 inline">
                            {{ Str::limit($category->description, 80) }}
                        </p>
                        @if (Str::length($category->description) > 80)
                            <a href="javascript:void(0);" onclick="toggleDescription('{{ $category->id }}', this)"
                                class="text-primary-600 hover:underline read-more-link inline">{{ __('Read More') }}</a>
                        @endif

                    </div>

                    <a href="{{ route('store.service', ['service' => $category->link]) }}"
                        class="flex justify-center text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-bue-200 dark:focus:ring-primary-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-4">
                        {!! __('client.pricing') !!}
                        <svg aria-hidden="true" class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </article>


            </div>
        @endforeach
    </div>
@endsection
