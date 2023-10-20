@extends(Theme::wrapper())

@section('title')
    {!! __('client.services') !!}
@endsection

@section('container')
    <div class="flex flex-wrap ">
        @foreach ($categories->all() as $category)
            @if(in_array($category->status, ['unlisted', 'inactive', 'restricted']))
                @if($category->status == 'restricted')
                    @if(Auth::guest() OR !Auth::user()->is_admin())
                        @continue
                    @endif
                @else
                    @continue
                @endif
            @endif
            <div class="md:w-1/4 pr-4 pl-4 w-full mb-6">
                <article
                    class="p-4 mx-auto max-w-sm bg-white rounded-lg shadow-md dark:bg-gray-800 border border-gray-200 dark:border-gray-800">
                    <a href="{{ route('store.service', ['service' => $category->link]) }}">
                        <img class="mb-5 rounded-lg" src="{{ $category->icon() }}" alt="icon"/>
                    </a>
                    <h3 class="mb-2 text-xl font-bold tracking-tight text-gray-900 lg:text-2xl dark:text-white">
                        <a href="{{ route('store.service', ['service' => $category->link]) }}">{{ $category->name }}</a>
                    </h3>
                    <p class="mb-3 font-light text-gray-500 dark:text-gray-400">{!! $category->description !!}</p>
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
