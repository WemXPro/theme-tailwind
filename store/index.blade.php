@extends(Theme::wrapper())

@section('title')
    {!! __('client.services') !!}
@endsection

@section('container')
<section class="antialiased">
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <div class="mb-4 flex items-center justify-between gap-4 md:mb-8">
      <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">{{ __('admin.categories') }}</h2>
    </div>

    @if(settings('theme:default:categories_structure', 'grid') == 'grid')
    <div class="grid grid-cols-1 gap-4 sm:mt-8 sm:grid-cols-2 lg:grid-cols-3 xl:gap-8">
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

      <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <a href="{{ route('store.service', ['service' => $category->link]) }}">
          <img class="mx-auto mb-4 h-48 md:mb-6 rounded" src="{{ $category->icon() }}" alt="icon" />
        </a>

        <a href="{{ route('store.service', ['service' => $category->link]) }}" class="text-lg font-semibold text-gray-900 dark:text-white">{{ $category->name }}</a>


        @if($category->description)
          <a href="{{ route('store.service', ['service' => $category->link]) }}" class="mt-4 block font-medium text-gray-900 hover:underline dark:text-white">{{ $category->description }}</a>
        @endif

        <a href="{{ route('store.service', ['service' => $category->link]) }}" title="" class="mt-4 inline-flex items-center gap-1.5 font-medium text-primary-700 hover:text-primary-600 hover:underline dark:text-primary-500 dark:hover:text-primary-400">
          {{ __('client.pricing') }}
          <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"></path>
          </svg>
        </a>
      </div>
      @endforeach
    </div>
    @elseif(settings('theme:default:categories_structure', 'grid') == 'block')
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
    <div class="mt-1 mb-6 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-800 flex flex-col relative">
        <div class="flex justify-between">
            <a href="{{ route('store.service', ['service' => $category->link]) }}" class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $category->name }}
            </a>
        </div>

        @if($category->description)
          <a href="{{ route('store.service', ['service' => $category->link]) }}" class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $category->description }}</a>
        @endif

        <div class="mt-auto text-right">
            <a
                href="{{ route('store.service', ['service' => $category->link]) }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
            >
              {{ __('client.pricing') }}
              <svg class="h-5 w-5 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"></path>
              </svg>
            </a>
        </div>
    </div>
    @endforeach

    @else
    <div class="mb-4 grid grid-cols-1 gap-4 text-center sm:grid-cols-2 lg:mb-0 lg:grid-cols-4 xl:gap-8">
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
        <img class="mx-auto h-14 rounded" src="{{ $category->icon() }}" alt="icon" />
        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $category->name }}</p>
      </a>
      @endforeach
    </div>
    @endif


  </div>
</section>
@endsection
