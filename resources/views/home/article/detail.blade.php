@extends('home.layouts.default')

@section('main')

<div class="col-sm-8 blog-main">
    <div class="blog-post">
        <div style="display:inline-flex">
            <h2 class="blog-post-title">{{ $article->title }}</h2>
            @can('update', $article)
            <a style="margin: auto"  href="/article/{{ $article->id }}/edit">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </a>
            @endcan
            @can('delete', $article)
            <a style="margin: auto"  href="/article/{{ $article->id }}/delete">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </a>
            @endcan
        </div>
        <p class="blog-post-meta">{{ $article->created_at }} <a href="/user/{{ $article->user->id }}">{{ $article->user->nickname }}</a></p>
        <p>{!! $article->content !!}</p>
        <div>
            @if(!(\Auth::guest()))
                @if($article->zan(\Auth::id())->exists())
                <a href="/article/{{ $article->id }}/unzan" type="button" class="btn btn-default btn-lg">取消赞</a>
                @else
                <a href="/article/{{ $article->id }}/zan" type="button" class="btn btn-primary btn-lg">赞</a>
                @endif
            @endif
        </div>
    </div>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">评论</div>

        <!-- List group -->
        <ul class="list-group">
            @foreach($comments as $comment)
            <li class="list-group-item">
                <h5>{{ $comment->created_at }} by <a href="/user/{{ $comment->user->id }}">{{ $comment->user->nickname }}</a></h5>
                <div>
                    {{ $comment->content }}
                </div>
            </li>
            @endforeach
        </ul>

        {{ $comments->links() }}
    </div>

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">发表评论</div>

        <!-- List group -->
        <ul class="list-group">
            <form action="/article/comment/{{ $article->id }}" method="post">
                {{ csrf_field() }}
                <li class="list-group-item">
                    @if(!(\Auth::guest()))
                    <textarea name="content" class="form-control" rows="10"></textarea>
                    <button class="btn btn-default" type="submit">提交</button>
                    @else
                    <textarea name="content" class="form-control" rows="10" disabled>你还没有登录</textarea>
                    <button class="btn btn-danger" disabled>未登录</button>
                    @endif
                </li>
            </form>

        </ul>
    </div>
</div><!-- /.blog-main -->

@endsection