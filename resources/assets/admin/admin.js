SUCCESS = 0;
ERROR = 1;

/**
 * 显示操作成功信息
 *
 * @param  string 提示信息, float 显示时间
 * @return null
 */
function showProcessingTip(tip, time){
    var tip = arguments[0] || '请求中...';
     var time = arguments[1] || 3;
     var background = '#337ab7';
     var bordercolor = '#2e6da4';

    var windowWidth = document.documentElement.clientWidth;
    var height = 10;
    var width = 200;
    var tipsDiv = '<div class="tipsClass">' + tip + '</div>';

    $('body').append(tipsDiv);
    $('div.tipsClass').css({
        'z-index': 9999,
        'top': height + 'px',
        'min-width': width + 'px',
        'max-width': '900px',
        'height': '30px',
        'left': (windowWidth / 2) - (width / 2) + 'px',
        'position': 'fixed',
        'padding': '3px 5px',
        'background': background,
        'border': '1px solid transparent',
        'border-color': bordercolor,
        'border-radius':'4px',
        'font-size': 14 + 'px',
        'margin': '0 auto',
        'text-align': 'center',
        'color': '#fff',
        'opacity': '0.8'
    }).show();
}

/**
 * 显示操作成功信息
 *
 * @param  string 提示信息, float 显示时间
 * @return null
 */
function showSuccessTip(tip, time){
    var tip = arguments[0] || '操作成功';
    var time = arguments[1] || 3;
    var background = '#5cb85c';
    var bordercolor = '#4cae4c';

    showTip(tip, time, background, bordercolor);
}

/**
 * 显示操作失败信息
 * @param string 提示信息, float 显示时间
 * @return null
 */
function showFailTip(tip, time){
    var tip = arguments[0] || '操作失败';
    var time = arguments[1] || 3;
    var background = '#c9302c';
    var bordercolor = '#ac2925';

    showTip(tip, time, background, bordercolor);
}

/**
 * 显示信息，供成功、失败调用
 * @param string 提示信息, float 显示时间, string 背景颜色, string 边框颜色
 * @return null
 */
function showTip(tip, time, background, bordercolor) {
    var windowWidth = document.documentElement.clientWidth;
    var height = 10;
    var width = 200;
    var tipsDiv = '<div class="tipsClass">' + tip + '</div>';

    $('div.tipsClass').fadeOut();
    $('div.tipsClass').remove();

    $('body').append(tipsDiv);
    $('div.tipsClass').css({
        'z-index': 9999,
        'top': height + 'px',
        'min-width': width + 'px',
        'max-width': '900px',
        'height': '30px',
        'left': (windowWidth / 2) - (width / 2) + 'px',
        'position': 'fixed',
        'padding': '3px 5px',
        'background': background,
        'border': '1px solid transparent',
        'border-color': bordercolor,
        'border-radius':'4px',
        'font-size': 14 + 'px',
        'margin': '0 auto',
        'text-align': 'center',
        'color': '#fff',
        'opacity': '0.8'
    }).show();
    setTimeout(function(){$('div.tipsClass').fadeOut(); $('div.tipsClass').remove()}, (time * 1000));
}

function datatable_base() {
    if ("undefined" == typeof(datatable_default_length)) {
        datatable_default_length = 10;
    }

    $.extend( $.fn.dataTable.defaults, {
        "dom":
        "<'row'<'col-sm-6'><'col-sm-6'>r>"+
        "t"+
        "<'row'<'pull-left'l><'pull-left'i><'col-sm-7 pull-right'p>>",
        "pagingType": "full_numbers",
        "iDisplayLength": datatable_default_length,
        "lengthMenu": [[datatable_default_length, 20, 100], [datatable_default_length, 20, 100]],
        "language": {
            "processing" : "<img src=" + siteUrl + "/admin-assets/images/loading.gif>",
            "lengthMenu": "每页 _MENU_ 条 ",
            "zeroRecords": "没有找到记录",
            "info": "，共 _PAGES_ 页，共 _TOTAL_ 条",
            "infoEmpty": "无记录",
            "infoFiltered": "(从 _MAX_ 条记录过滤)",
            "search":"搜索：",
            "loadingRecords": "载入中...",
            "paginate":{
                "first":"首页",
                "previous":"上一页",
                "next":"下一页",
                "last":"尾页"
            }
        },
        "processing": true,
        "serverSide": true,
        "responsive": true,
        'stateSave': false
    } );
}

if(typeof(datatable_id) != "undefined") {
    var table;
    $(document).ready(function() {
        datatable_base();
        table = $('#' + datatable_id).DataTable({
            "sServerMethod": "POST",
            "columnDefs": [{
                "orderable": false,// 禁用排序列
                "targets": columnDefsTargets
            }, {
                "visible": false,// 隐藏列
                "targets": invisibleColumns
            }],
            //默认排序列
            "order": order,
            "ajax": {
                "url": ajaxUrl,
                "type": 'GET',
                "dataType": 'json',
                "headers": {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
            },
            "columns": columns,
            "initComplete": initComplete,
            "fnDrawCallback": function(table){
                $(".dataTables_paginate").prepend(" " +
                    "<div style='float:right;margin-top: 5px;'>&nbsp;跳转至第 <input type='text' id='changePage' class='input-text' style='width:50px;height:27px;border-radius: 5px;border: 1px solid #ccc;'> 页 " +
                    "<button class='paginate_button' id='goto' style='border-radius: 5px;border: 1px solid #ccc; background: #fafafa !important'>跳转</button></div>");
                var oTable = $('#' + datatable_id).dataTable();
                var tableSetings=$('#' + datatable_id).dataTable().fnSettings();
                var paging_length=tableSetings._iDisplayLength;//当前每页显示多少
                var page_start=tableSetings._iDisplayStart;//当前页开始
                var n1 = Math.round(page_start); //四舍五入
                var n2 = Math.round(paging_length); //四舍五入

                var rslt = n1 / n2; //除
                if (rslt >= 0) {
                    rslt = Math.floor(rslt); //返回小于等于原rslt的最大整数。
                }
                else {
                    rslt = Math.ceil(rslt); //返回大于等于原rslt的最小整数。
                }

                $('#goto').click(function(e) {
                    //$('#changePage').keyup(function(e) {
                    if($("#changePage").val() && $("#changePage").val() > 0) {
                        var redirectpage = $("#changePage").val() - 1;
                    } else {
                        var redirectpage = 0;
                    }
                    oTable.fnPageChange(redirectpage);
                });
                $('#changePage').val(rslt + 1);
            }
        });
    });
}

function initComplete() {
    // table.state.clear();
    $("#search").on('keyup', function () {
        table.search(this.value)
            .draw();
    });

    // 全选反选
    $("#check_all").click(function() {
        $('input[name="checkbox_id"]').prop("checked",this.checked);
    });
    var $subBox = $("input[name='checkbox_id']");
    $subBox.click(function(){
        $("#check_all").prop("checked", $subBox.length == $subBox.filter(":checked").length ? true :false);
    });
}

// 提示框
function alertModal(function_name, function_params, alert_message) {
    $('#alert_modal_confirm').one("click", function () {
        $('#alert_modal').modal('hide');
        function_name(function_params);
    });
    var alert_message = arguments[2] || '确定吗?';
    $('#alert_message').text(alert_message);
    $('#alert_modal').modal('show');
}

// 警告框
function warningModal(function_name, function_params, warning_title, warning_message) {
    $('#warning_modal_confirm').one("click", function () {
        $('#warning_modal').modal('hide');
        function_name(function_params);
    });
    $('#warning_title').text(warning_title);
    $('#warning_message').html(warning_message);
    $('#warning_modal').modal('show');
}

// ajax
function ajax(url, method, data, successCallback) {
    $.ajax({
        url:  url,
        type: method,
        dataType: 'json',
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function (data) {
            showProcessingTip();
        },
        success: function(data) {
            if(data['code'] === SUCCESS) {
                showSuccessTip(data['message']);
                if ("undefined" != typeof(datatable_id)) {
                    $('#' + datatable_id).DataTable().draw(false);
                }

                if ("function" == typeof(successCallback)) {
                    successCallback();
                }
            } else {
                showFailTip(data['message']);
            }
        },
        error: function(data) {
            console.log(data);
            showFailTip(data.responseJSON.message);
        }
    });

}
