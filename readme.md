# A php framework based on laravel.

**演示地址:[http://laravel.iat.net.cn](http://laravel.iat.net.cn)**

## 功能说明

### 后台

* 整合[gentelella](https://github.com/puikinsh/gentelella)前端框架
* 登录、忘记密码、重置密码
* 用户管理
* 角色管理
* 管理员管理
* 日志记录
* 日志管理
* 错误页面
* 图片上传、管理
* 微信公众号配置

### 前台

* 登录
* 日志记录

### api

* api封装
* 日志记录

### 微信公众号

* 授权登录
* 菜单
* 自定义回复

### 微信小程序

* 授权登录
* 开箱即用框架[weapp](https://github.com/yaoshanliang/weapp)

## 安装说明

1、clone代码

    git clone https://github.com/yaoshanliang/laravel.git

    # git clone https://git.coding.net/iat/laravel.git
     
2、修改权限

    chmod -R 777 storage
    chmod -R 777 bootstrap
    
3、安装依赖

    composer install
    
4、数据迁移
    
    cp .env.example .env
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
   
5、nginx配置
    
    server {
        listen 80;
    
        root /var/www/html/laravel/public; // 代码路径
        index index.php index.html;
    
        server_name laravel.dev; // 域名
    
        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }
    
        location ~ \.php$ {
            fastcgi_pass   unix:/var/run/php/php7.0-fpm.sock;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            include        fastcgi_params;
        }
    }
    
6、访问

* 首页 http://laravel.dev
    
* 后台: http://laravel.dev/admin

  * 账号: admin
  * 密码: admin
  
## TODO

1、数据改动日志记录插件

2、微信小程序基础功能接入

3、项目功能宣传页

4、微信用户同步公众平台

5、优化微信菜单配置（一个页面展示）、增加点击触发消息

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
