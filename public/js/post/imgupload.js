$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(".like-button").click(function(event){
    target = $(event.target)
    var current_like = target.attr("like-value");
    var user_id = target.attr("like-user");
    //var _token = target.attr("_token");
    // 已经关注了
    if (current_like == 1) {
        // 取消关注
        $.ajax({
                url: "/user/" + user_id + "/unfan",
                method: "POST",
                //data: {"_token": _token},
                dataType: "json",
                success: function(data) {
                    if (data.error != 0) {
                        alert(data.msg);
                        return;
                    }

                    target.attr("like-value", 0);
                    target.text("关注")
                }
            }
        );
    } else {
        // 取消关注
        $.ajax({
                url: "/user/" + user_id + "/fan",
                method: "POST",
                //data: {"_token": _token},
                dataType: "json",
                success: function(data) {
                    if (data.error != 0) {
                        alert(data.msg);
                        return;
                    }

                    target.attr("like-value", 1);
                    target.text("取消关注")
                }
            }
        );
    }
});






var E = window.wangEditor
var editor = new E('#editor')
editor.customConfig.uploadImgServer = '/posts/img/upload'
editor.customConfig.uploadFileName = 'postsimg'
editor.customConfig.uploadImgHeaders = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
// 或者 var editor = new E( document.getElementById('editor') )
var $text1 = $('#content')
editor.customConfig.onchange = function (html) {
    // 监控变化，同步更新到 textarea
    $text1.val(html)
}
editor.create()
// 初始化 textarea 的值
$text1.val(editor.txt.html())







