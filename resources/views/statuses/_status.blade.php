<li id="status-{{ $status->id }}">
    <a href="{{ route('users.show', $user->id )}}">
        <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="gravatar"/>
    </a>
    <span class="user">
    <a href="{{ route('users.show', $user->id )}}">{{ $user->name }}</a>
    </span>
    <span class="timestamp">
    {{ $status->created_at->diffForHumans() }}
    </span>
    <span class="content">{{ $status->content }}</span>

    @can('destroy', $status)
        <form action="{{ route('statuses.destroy', $status->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-danger status-delete-btn">删除</button>
        </form>
    @endcan

    {{-- 评论列表 --}}
    <div class="panel panel-default status-comment">
        <div class="panel-body">
            @includeWhen(Auth::check(),'statuses._comment_box', ['status' => $status])
            @include('statuses._comment_list', ['comments' => $status->comments()->with('user')->get()])
        </div>
    </div>

    {{--@if (Auth::check())
    <form class="comment-form" id="comment-form" action="{{ route('comments.store', $user->id) }}" method="POST">

        {{ csrf_field() }}
        <input type="hidden" name="username" value="{{ Auth::user()->name }}">
        <input type="hidden" name="#" value="#">
        <input type="hidden" class="reply_author" name="#" value="">
        <input type="hidden" class="reply_author_name" name="#" value="">
        <a href="{{ route('users.show', Auth::user()->id )}}">
            <img src="{{ Auth::user()->gravatar() }}" alt="{{ Auth::user()->name }}" class="gravatar-reply"/>
        </a>
        <fieldset class="comment-field-style">
            <div class="comment-field">
                <textarea class="text-field" rows="7" name="content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary comment_btn" title="登陆后才能评论">发表评论</button>

            <div class="col-md-12">
                @if (count($comments) > 0)
                    <ol class="statuses">
                        @foreach ($comments as $comment)
                            @include('comments._comment')
                        @endforeach
                    </ol>
                    {!! $comments->render() !!}
                @endif
            </div>

        </fieldset>
    </form>
    @endif--}}
</li>

