@if (count($comment_feed_items))
    <ol class="comments">
        @foreach ($comment_feed_items as $comment)
            @include('statuses._comment', ['user' => $comment->user])
        @endforeach
        {!! $comment_feed_items->render() !!}
    </ol>
@endif