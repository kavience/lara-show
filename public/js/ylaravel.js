$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
});
$(".like-button").click(function (event) {
    // alert('zzz');
    var target = $(event.target);
    var current_like = target.attr("like-value");
    var user_id = target.attr("like-user");
    if (current_like == 1) {
        //current_like == 1,则取消关注
        $.ajax({
            url:"/user/"+user_id+"/unfan",
            method:"POST",
            dataType:"JSON",
            success:function (data) {
                if (data.error != 0) {
                    alert(data.message);
                    return ;
                }
                target.attr("like-value", 0);
                target.text("关注");
                target.addClass('btn-primary');
            }
        })
    } else {
        //增加关注
        $.ajax({
            url:"/user/"+user_id+"/fan",
            method:"POST",
            dataType:"JSON",
            success:function (data) {
                if (data.error != 0) {
                    alert(data.message);
                    return ;
                }
                target.attr("like-value", 1);
                target.text("取消关注");
                target.removeClass('btn-primary');
            }
        })
    }
});

var editor = new wangEditor('content');

editor.config.uploadImgUrl = '/article/image/upload';

// 设置 headers（举例）
editor.config.uploadHeaders = {
    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
};

editor.create();

