<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">


        <title>Laravel</title>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0px;
            }
            .container{
                width: 75%;
                height: auto;
                overflow: hidden;
                margin: 0px auto;
            }
            .header{
                width: 100%;
                display: flex;
                justify-content: flex-end;
            }
            .header a{
                display: inline-block;
                width: 74px;
                height: 40px;
                text-align: center;
                color: #636b6f;
                font-size: 16px;
                text-decoration: none;
                margin-left: 40px;
                margin-top: 34px;
                border-radius: 5px;
                line-height: 40px;
            }
            a:hover{
                color: #97b3c6;
            }
            .body{
                width: 100%;
                height: auto;
                overflow: hidden;
                margin: 50px 0px;
            }
            .details{
                display: flex;
                align-items: center;
                min-height: 20vh;
            }
            .ul{
                display: flex;
                flex-wrap: wrap;
                list-style: none;
                margin-left: 40px !important;
            }
            .ul li{
                margin-right: 46px;
                line-height: 3;
            }
            .title{
                height: 40px;
                line-height: 2.7;
                border-radius: 5px;
                padding-left: 20px;
                color: #97b3c6;
                font-size: 18px;
            }
            .left-section{
                width: 30%;
                float: left;
                height: 40vh;
            }
            .right-section{
                width: 70%;
                float: left;
            }
            .right-section-body{
                width: 98%;
                height: 40vh;
                margin: 0px auto 40px;
            }
            .font-title{
                margin-left: 10px;
            }
            image{
                width: 100%;
                height: 100%;
            }
            .slider .indicators .indicator-item.active {
                background-color: #97b3c6 !important;
            }
            .slider .indicators .indicator-item {
                height: 6px !important;
                width: 50px !important;
                border-radius: 20px !important;
            }

            @media only screen and (max-width:1440px){
                .slider .indicators {
                    top: 266px;
                    z-index: 9999;
            }
            }

        </style>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
    </head>
    <body>
        <div class="container">
            <div class="header">
                <a href="{{ url('/web') }}">前台页面</a>
                <a href="{{ url('/admin') }}">后台管理</a>
            </div>
            <div class="body">
                <div class="section-all" id="section-all">
                    
                </div>
                <section class="left-section" id="left-section">
                
                </section>
                <section class="right-section">
                <div class="right-section-body">
                            <div class="slider">
    <ul class="slides" id="slides">
      
    </ul>
  </div>
      
                        </div>
                    </section>
                
            </div>
        </div>
    
    <script type="text/javascript" src="{{asset('web-assets/js/jquery-1.9.1.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
    <script type="text/javascript">
    $(function(){
        
        var data = [
        {
            'id': '1',
            'font-awesome': 'bookmark',
            'title': '后台功能简介',
            'list': [{
                'function': '整合gentelella前端框架'
            },{
                'function': '登录、忘记密码、重置密码'
            },{
                'function': '用户管理'
            },{
                'function': '角色管理'
            },{
                'function': '管理员管理'
            },{
                'function': '日志记录'
            },{
                'function': '日志管理'
            },{
                'function': '错误页面'
            }]
        }]
        var dataNext = [
            {
            'id': '2',
            'font-awesome': 'window-maximize',
            'title': '前台功能简介',
            'list': [{
                'function': '登录'
            },{
                'function': '日志记录'
                }]
            },{
            'id': '3',
            'font-awesome': 'database',
            'title': 'api功能简',
            'list': [{
                'function': 'api封装'
            },{
                'function': '日志记录'
            }]
        }]

        $.each(data, function($key, $val){
            var html = '<div class="title">' +
            '<i class="fa fa-' + $val['font-awesome'] + '"></i><font class="font-title">' +   $val['title']  + '</font></div><div class="details">' +
                        '<ul class="ul">'
                        $.each($val['list'], function($k, $v){
                            html += '<li>' + $v['function'] + '</li>'
                        })
                        '</ul>' +
                    '</div>'
            $('#section-all').append(html);
        })

        $.each(dataNext, function($key, $val){
            var htmlNext = '<div class="title">' +
            '<i class="fa fa-' + $val['font-awesome'] + '"></i><font class="font-title">' +   $val['title']  + '</font></div><div class="details">' +
                        '<ul class="ul">'
                        $.each($val['list'], function($k, $v){
                            htmlNext += '<li>' + $v['function'] + '</li>'
                        })
                        '</ul>' +
                    '</div>'
            $('#left-section').append(htmlNext);
        })

        var imageList = [{
            'id' : '1',
            'src' : '{{asset("web-assets/image/background1.png")}}',
            'title' : 'More powerful!',
            'details' : 'Contains a variety of functions'
        },{
            'id' : '2',
            'src' : '{{asset("web-assets/image/background0.png")}}',
            'title' : 'Easier to use!',
            'details' : 'The use of more humane.'
        },{
            'id' : '3',
            'src' : '{{asset("web-assets/image/background1.png")}}',
            'title' : 'Simplified code!',
            'details' : 'Code is easier.'
        }]

        $.each(imageList, function($kay, $val){
            var image  = '<li>' +
            '<img src="' + $val['src'] + '">' + 
        '<div class="caption center-align">' +
          '<h3>' + $val['title'] + '</h3>' +
          '<h5 class="light grey-text text-lighten-3">' + $val['details'] + '</h5>' +
        '</div>' +
      '</li>'

      $('#slides').append(image);
        })

        $('.slider').slider();



    })
    </script>
        
    </body>
</html>
