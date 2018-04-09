<li id="comment-{{ $comment->id }}">
    <a href="{{ route('users.show', $user->id )}}">
        <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="gravatar"/>
    </a>
    <span class="user">
    <a href="{{ route('users.show', $user->id )}}">{{ $user->name }}</a>
    </span>
    <span class="timestamp">
    {{ $comment->created_at->diffForHumans() }}
    </span>
    <span class="comment">{{ $comment->comment }}</span>

    @can('destroy', $comment)
        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-danger status-delete-btn">删除</button>
        </form>
    @endcan

</li>