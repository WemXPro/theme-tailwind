@extends(Theme::wrapper())

@section('title')
    {!! __('client.services') !!}
@endsection

@section('container')
    <section class="antialiased">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
          <div class="sm:flex sm:items-center sm:justify-between sm:gap-4">
            <p class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Categories</p>
          </div>
      
          <div class="mb-4 mt-6 grid grid-cols-1 gap-4 text-center sm:mt-8 sm:grid-cols-2 lg:mb-0 lg:grid-cols-4 xl:gap-8">

            @foreach($categories->all() as $category)
            @if (in_array($category->status, ['unlisted', 'inactive', 'restricted']))
                @if ($category->status == 'restricted')
                    @if (Auth::guest() or !Auth::user()->is_admin())
                        @continue
                    @endif
                @else
                    @continue
                @endif
            @endif
            <a href="{{ route('store.service', ['service' => $category->link]) }}" class="grid place-content-center space-y-6 overflow-hidden rounded-lg border border-gray-200 bg-white p-6 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
              <img class="mx-auto h-14 w-14 rounded" src="{{ $category->icon() }}" alt="icon" />
              <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $category->name }}</p>
            </a>
            @endforeach
    
          </div>
      
        </div>
      </section>
@endsection
