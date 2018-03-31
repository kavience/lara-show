@extends('home.layouts.default')

@section('main')
<div class="col-sm-8 blog-main">
    <div>
        <div id="carousel-example" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example" data-slide-to="1"></li>
                <li data-target="#carousel-example" data-slide-to="2"></li>
            </ol><!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="http://ww1.sinaimg.cn/large/44287191gw1excbq6tb3rj21400migrz.jpg" alt="..." />
                    <div class="carousel-caption">...</div>
                </div>
                <div class="item">
                    <img src="http://ww3.sinaimg.cn/large/44287191gw1excbq5iwm6j21400min3o.jpg" alt="..." />
                    <div class="carousel-caption">...</div>
                </div>
                <div class="item">
                    <img src="http://ww2.sinaimg.cn/large/44287191gw1excbq4kx57j21400migs4.jpg" alt="..." />
                    <div class="carousel-caption">...</div>
                </div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control" href="#carousel-example" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>
    </div>        <div style="height: 20px;">
    </div>
    <div>

        @foreach($articles as $article)
        <div class="blog-post">
            <h2 class="blog-post-title"><a href="/article/{{ $article->id }}" >{{ $article->title }}</a></h2>
            <p class="blog-post-meta">{{ $article->created_at }} by <a href="/user/{{ $article->user->id }}">{{ $article->user->nickname }}</a></p>

            <p>{!! str_limit($article->content, 150, '...') !!}
            <p class="blog-post-meta">赞 {{ $article->zans_count }}  | 评论 {{ $article->comments_count }}</p>
        </div>
        @endforeach

        {{ $articles->links() }}

    </div><!-- /.blog-main -->
</div>
@endsection


