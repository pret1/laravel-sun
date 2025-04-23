<div>
    <div style="color: #2563eb"> From laravel</div>
    @if ($childComment)
        <div>{{ $childComment->content }}</div>
        <div><p>Someone answered for your comment</p></div>
    @endif
    <div>{{ $comment->content }}</div>
</div>
