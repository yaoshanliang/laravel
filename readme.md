## A php framework based on laravel.
**演示地址:[http://laravel.sshmt.com](http://laravel.sshmt.com)**
### 功能说明

#### 后台

* 整合[gentelella](https://github.com/puikinsh/gentelella)前端框架
* 登录、忘记密码、重置密码
* 用户管理
* 角色管理
* 管理员管理
* 日志记录
* 日志管理
* 错误页面

#### 前台

* 登录
* 日志记录

#### api

* api封装
* 日志记录

### 安装说明

1、clone代码

    git clone https://github.com/yaoshanliang/laravel.git

    # git clone https://git.coding.net/iat/community.git
     
2、修改权限

    chmod -R 777 storage
    chmod -R 777 bootstrap
    
3、安装依赖

    composer install
    npm install
    
4、构建js

    gulp
    
5、数据迁移
    
    cp .env.example .env
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
   
6、nginx配置
    
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
    
7、访问

* 首页 http://laravel.dev
    
* 后台: http://laravel.dev/admin

  * 账号: admin
  * 密码: admin
