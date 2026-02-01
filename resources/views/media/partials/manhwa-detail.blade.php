@if($media->manhwaDetail)
    <div>Total Chapters: {{ $media->manhwaDetail->total_chapter }}</div>
    <div>Total Volumes: {{ $media->manhwaDetail->total_volume }}</div>
@endif
