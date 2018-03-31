@extends('home.layouts.default')

@section('main')

<div class="col-sm-8 blog-main">
    <form class="form-horizontal" action="/user/5/setting" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="RuzO8giZVe3C2PalHpxGydYXKvwqNxMwcxscznAb">
        <div class="form-group">
            <label class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-10">
                <input class="form-control" name="name" type="text" value="Kassandra Ankunding2">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">头像</label>
            <div class="col-sm-2">
                <input class=" file-loading preview_input" type="file" value="用户名" style="width:72px" name="avatar">
                <img  class="preview_img" src="image/user.jpeg" alt="" class="img-rounded" style="border-radius:500px;">
            </div>
        </div>
        <button type="submit" class="btn btn-default">修改</button>
    </form>
    <br>
</div>

@endsection()
