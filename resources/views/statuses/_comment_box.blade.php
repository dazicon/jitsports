{{--@include('common.error')--}}
<div class="comment-box">
    <form action="{{ route('comments.store') }}" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="status_id" value="{{ $status->id }}">
        <div class="form-group">
            <textarea class="form-control" rows="3" placeholder="分享你的想法" name="comment"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-share"></i>评论</button>
    </form>
</div>
<hr>