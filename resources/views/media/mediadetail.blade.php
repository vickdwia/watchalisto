@extends('layouts.usernav')

@push('styles')
<style>
body {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    color: #fff;
    font-family: 'Segoe UI', system-ui, sans-serif;
}

.glass-card {
    background: rgba(17, 25, 40, 0.5);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
    padding: 1.5rem;
}

.media-header {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.media-poster img {
    width: 240px;
    height: 340px;
    object-fit: cover;
    border-radius: 8px;
}

.media-info h2 {
    color: #14b8a6;
    margin-bottom: 0.5rem;
}

.genre-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 0.5rem;
}

.genre-tag {
    background: rgba(20,184,166,0.8);
    padding: 0.2rem 0.5rem;
    border-radius: 4px;
    font-size: 0.75rem;
}

.user-actions {
    margin-top: 1rem;
    display: flex;
    gap: 0.75rem;
}

.btn-watchlist {
    background: rgba(20,184,166,0.15);
    border: 1px solid #14b8a6;
    color: #14b8a6;
    border-radius: 6px;
    padding: 0.5rem 1rem;
    font-weight: 600;
    transition: all 0.2s;
}

.btn-watchlist:hover {
    background: rgba(20,184,166,0.25);
}

.synopsis {
    margin-top: 1.5rem;
    line-height: 1.5;
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    gap: 1rem;
    margin-top: 2rem;
}

.media-card {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.media-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    display: block;
}

.media-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 0.5rem;
    opacity: 0;
    transition: opacity 0.3s ease;
    color: white;
}

.media-card:hover .media-overlay {
    opacity: 1;
}
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="glass-card">

        <!-- Media Header -->
        <div class="media-header">
            <div class="media-poster">
                <img src="{{ Storage::url($media->poster) }}" alt="{{ $media->title }}">
            </div>
            <div class="media-info">
                <h2>{{ $media->title }}</h2>
                <div>★ {{ $media->user_media_lists_avg_rating ? number_format($media->user_media_lists_avg_rating,1) : 'N/A' }}</div>
                <div>Release Year: {{ $media->release_year }}</div>
                @includeWhen($media->type === 'drama', 'media.partials.drama-detail')
                @includeWhen($media->type === 'manhwa', 'media.partials.manhwa-detail')

                <div class="genre-tags">
                    @foreach($media->genres as $genre)
                        <span class="genre-tag">{{ $genre->name }}</span>
                    @endforeach
                </div>

                <!-- User Actions -->
                <div class="user-actions">
                    <form method="POST" action="{{ route('media.toggleList', $media->id) }}" 
                        onsubmit="return confirmRemove('{{ $media->title }}', '{{ ucfirst($media->type) }}');">
                        @csrf
                        <button type="submit" class="btn-watchlist">
                            {{ $media->isInUserList(auth()->id()) ? 'Remove from List' : 'Add to List' }}
                        </button>
                    </form>

                    {{-- Rate / Notes (link dummy sementara) --}}
                    <a href="#" class="btn-watchlist">Rate / Notes</a>
                </div>
            </div>
        </div>

        <!-- Synopsis -->
        <div class="synopsis">
            <h5 class="text-teal-400">Synopsis</h5>
            <p>{{ $media->synopsis ?? 'No synopsis available.' }}</p>
        </div>

        <!-- Related Media -->
        @if($related->count())
        <div class="related">
            <h5 class="mt-4 mb-2">Related {{ ucfirst($media->type) }}</h5>
            <div class="related-grid">
                @foreach($related as $item)
                    <a href="{{ route('media.show', $item->id) }}" class="media-card">
                        <img src="{{ Storage::url($item->poster) }}" alt="{{ $item->title }}">
                        <div class="media-overlay">
                            <h6>{{ $item->title }}</h6>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

@push('scripts')
<script>
    function confirmRemove(title, type) {
        const message = `Are you sure you want to remove "${title}" (${type}) from your list?`;
        return confirm(message);
    }
</script>
@endpush

@endsection
