@props([
    'backgroundImageUrl' => '',
    'badgeText' => '',
    'badgeClass' => '',
    'title' => '',
    'description' => '',
    'url' => '',
    'configureUrl' => '#',
    'titleUrl' => '',
    'btnName' => 'Review',
])

<article class="article article-style-b">
    <div class="article-header">
        <div class="article-image" data-background="{{ $backgroundImageUrl }}" style="background-image: url('{{ $backgroundImageUrl }}');">
        </div>
        @empty(!$badgeText)
            <div class="article-badge">
                <div class="article-badge-item {{ $badgeClass }}"><i class="fas fa-fire"></i> {{ $badgeText }}</div>
            </div>
        @endempty
    </div>
    <div class="article-details">
        <div class="article-title">
            <h2><a href="{{ $titleUrl }}">{{ $title }}</a></h2>
        </div>
        <p>{!! $description !!}</p>
        <div class="article-cta">
            <a href="{{ $url }}" class="btn btn-primary">{{ $btnName }}</a>
        </div>
    </div>
</article>
