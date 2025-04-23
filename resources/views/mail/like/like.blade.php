<div>
    <div style="color: #2563eb"> From laravel</div>
        @if ($is_liked)
            <div><p>Someone like your </p></div>
        @else
            <div><p>Someone dislike your </p></div>
        @endif
    <div>{{ $likeable->content }}</div>
</div>
