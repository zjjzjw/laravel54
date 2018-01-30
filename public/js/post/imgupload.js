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
