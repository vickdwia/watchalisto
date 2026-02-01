@if($media->dramaDetail)
    <div>Total Episodes: {{ $media->dramaDetail->total_episode }}</div>
    <div>Total Seasons: {{ $media->dramaDetail->total_season }}</div>
@endif
