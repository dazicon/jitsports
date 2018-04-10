<div class="reply-list">
    @foreach ($comments as $index => $comment)
        <div class=" media"  name="comment{{ $comment->id }}" id="comment{{ $comment->id }}">
            <div class="avatar pull-left">
                <a href="{{ route('users.show', [$comment->user_id]) }}">
                    <img class="media-object gravatar-reply" alt="{{ $comment->user->name }}" src="{{ $comment->user->gravatar() }}"  style="width:48px;height:48px;"/>
                </a>
            </div>

            <div class="infos">
                <div class="media-heading">
                    <a href="{{ route('users.show', [$comment->user_id]) }}" title="{{ $comment->user->name }}">
                        {{ $comment->user->name }}
                    </a>
                    <span> •  </span>
                    <span class="meta" title="{{ $comment->created_at }}">{{ $comment->created_at->diffForHumans() }}</span>

                    {{-- 回复删除按钮 --}}
                    @can('destroy',$comment)
                    <span class="meta pull-right">
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-default btn-xs pull-left">
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>
                        </form>
                    </span>
                    @endcan
                </div>
                <div class="reply-content">
                    {!! $comment->comment !!}
                </div>
            </div>
        </div>
        <hr>
    @endforeach
</div>