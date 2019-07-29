function countChecked(){"all"===checkState&&$(".bulk_action input[name='table_records']").iCheck("check"),"none"===checkState&&$(".bulk_action input[name='table_records']").iCheck("uncheck");var e=$(".bulk_action input[name='table_records']:checked").length;e?($(".column-title").hide(),$(".bulk-actions").show(),$(".action-cnt").html(e+" Records Selected")):($(".column-title").show(),$(".bulk-actions").hide())}
var CURRENT_URL=window.location.href.split("?")[0],$BODY=$("body"),$MENU_TOGGLE=$("#menu_toggle"),$SIDEBAR_MENU=$("#sidebar-menu"),$SIDEBAR_FOOTER=$(".sidebar-footer"),$LEFT_COL=$(".left_col"),$RIGHT_COL=$(".right_col"),$NAV_MENU=$(".nav_menu"),$FOOTER=$("footer");$(document).ready(function(){var e=function(){
    $RIGHT_COL.css("min-height",$(window).height());
    var e=$BODY.outerHeight(),t=$BODY.hasClass("footer_fixed")?0:$FOOTER.height(),n=$LEFT_COL.eq(1).height()+$SIDEBAR_FOOTER.height(),i=n>e?n:e;i-=$NAV_MENU.height()+t,
        //$RIGHT_COL.css("min-height",i),
        $RIGHT_COL.css("min-height",$(window).height())
};

    $SIDEBAR_MENU.find("a").on("click",function(t){var n=$(this).parent();n.is(".active")?(n.removeClass("active active-sm"),$("ul:first",n).slideUp(function(){e()})):(n.parent().is(".child_menu")||($SIDEBAR_MENU.find("li").removeClass("active active-sm"),$SIDEBAR_MENU.find("li ul").slideUp()),n.addClass("active"),$("ul:first",n).slideDown(function(){e()}))}),$MENU_TOGGLE.on("click",function(){$BODY.hasClass("nav-md")?($SIDEBAR_MENU.find("li.active ul").hide(),$SIDEBAR_MENU.find("li.active").addClass("active-sm").removeClass("active")):($SIDEBAR_MENU.find("li.active-sm ul").show(),$SIDEBAR_MENU.find("li.active-sm").addClass("active").removeClass("active-sm")),$BODY.toggleClass("nav-md nav-sm"),e()}),
    $SIDEBAR_MENU.find('a[href="'+CURRENT_URL+'"]').parent("li").addClass("current-page"),
    $SIDEBAR_MENU.find("a").filter(function(){
        var sidebar_href = this.href + '/';
        var current_href = CURRENT_URL + '/';
        if (current_href.indexOf(sidebar_href) == 0) {
            return true;
        }
        // return this.href==CURRENT_URL
    }).parent("li").addClass("current-page").parents("ul").slideDown(function(){e()}).parent().addClass("active"),
    $(window).smartresize(function(){e()}),e(),$.fn.mCustomScrollbar&&$(".menu_fixed").mCustomScrollbar({autoHideScrollbar:!0,theme:"minimal",mouseWheel:{preventDefault:!0}})}),$(document).ready(function(){$(".collapse-link").on("click",function(){var e=$(this).closest(".x_panel"),t=$(this).find("i"),n=e.find(".x_content");e.attr("style")?n.slideToggle(200,function(){e.removeAttr("style")}):(n.slideToggle(200),e.css("height","auto")),t.toggleClass("fa-chevron-up fa-chevron-down")}),$(".close-link").click(function(){var e=$(this).closest(".x_panel");e.remove()})}),$(document).ready(function(){$('[data-toggle="tooltip"]').tooltip({container:"body"})}),$(".progress .progress-bar")[0]&&$(".progress .progress-bar").progressbar(),$(document).ready(function(){if($(".js-switch")[0]){var e=Array.prototype.slice.call(document.querySelectorAll(".js-switch"));e.forEach(function(e){new Switchery(e,{color:"#26B99A"})})}}),$(document).ready(function(){$("input.flat")[0]&&$(document).ready(function(){$("input.flat").iCheck({checkboxClass:"icheckbox_flat-green",radioClass:"iradio_flat-green"})})}),$("table input").on("ifChecked",function(){checkState="",$(this).parent().parent().parent().addClass("selected"),countChecked()}),$("table input").on("ifUnchecked",function(){checkState="",$(this).parent().parent().parent().removeClass("selected"),countChecked()});var checkState="";$(".bulk_action input").on("ifChecked",function(){checkState="",$(this).parent().parent().parent().addClass("selected"),countChecked()}),$(".bulk_action input").on("ifUnchecked",function(){checkState="",$(this).parent().parent().parent().removeClass("selected"),countChecked()}),$(".bulk_action input#check-all").on("ifChecked",function(){checkState="all",countChecked()}),$(".bulk_action input#check-all").on("ifUnchecked",function(){checkState="none",countChecked()}),$(document).ready(function(){$(".expand").on("click",function(){$(this).next().slideToggle(200),$expand=$(this).find(">:first-child"),"+"==$expand.text()?$expand.text("-"):$expand.text("+")})}),"undefined"!=typeof NProgress&&($(document).ready(function(){NProgress.start()}),$(window).load(function(){NProgress.done()})),function(e,t){var n=function(e,t,n){var i;return function(){function c(){n||e.apply(a,o),i=null}var a=this,o=arguments;i?clearTimeout(i):n&&e.apply(a,o),i=setTimeout(c,t||100)}};jQuery.fn[t]=function(e){return e?this.bind("resize",n(e)):this.trigger(t)}}(jQuery,"smartresize");
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
    var time = arguments[1] || 30;
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
            "sEmptyTable": "没有找到记录",
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
