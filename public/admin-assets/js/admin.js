SUCCESS = 0;
ERROR = 1;
$ = layui.$;

function ajax(url, method, data, callback) {
    $.ajax({
        url:  url,
        type: method,
        dataType: 'json',
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function (data) {
            callback['beforeSend'] ? callback['beforeSend'].call(this) : '';
        },
        success: function(data) {
            if(data['code'] === SUCCESS) {
                callback['success'] ? callback['success'].call(this) : '';
            } else {
                layer.msg(data['message']);
            }
        },
        error: function(data) {
            console.log(data);
            layer.msg('请求失败');
        }
    });
}