@extends('layouts.default')
@section('title','校友')

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <h1>校友</h1>
        <ul class="users">
            @foreach($users as $user)
                @include('users._user')
            @endforeach
        </ul>

        {!! $users->render() !!}
    </div>
@stop