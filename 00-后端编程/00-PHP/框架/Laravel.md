[

Laravel5.5 + Vue2 + Element 环境搭建](http://mrzhouxiaofei.com/2017/09/17/Laravel5.5%20+%20Vue2%20+%20Element%20%E7%8E%AF%E5%A2%83%E6%90%AD%E5%BB%BA/)

[laravel学院](http://laravelacademy.org/)



https://github.com/kevinyan815/Learning_Laravel_Kernel

https://implode.io/



查看版本

```
\Illuminate\Foundation\Application.php
```





## 安装

```shell
composer create-project laravel/laravel --prefer-dist
```

## 关闭CSRF token

### 方法一

打开文件：app\Http\Kernel.php

把这行注释掉：

```
'App\Http\Middleware\VerifyCsrfToken'
```

# 安装Laravel 5 IDE Helper Generator

1. `composer require barryvdh/laravel-ide-helper  `

2. 下载完成后加入 **config/app.php** 中的 **providers** 数组中

   `Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,`

3. 仅在开发系统中安装提示包

   `composer require --dev barryvdh/laravel-ide-helper`

4. 在 **app/Providers/AppServiceProvider.php **文件中注册

   ```php
   public function register()
   {
       if ($this->app->environment() !== 'production') {
           $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
       }
   ```

5. 生成代码跟踪支持

   `php artisan ide-helper:generate`

# 目录说明

![](https://youpaiyun.zongqilive.cn/image/2018-1-8-下午8:12:01.png)

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fn7u402do9j31260den19.jpg)

# 路由

`\Illuminate\Support\Facades\Route`



![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fn7u4wje4uj310w0ly449.jpg)

```php
Route::match(['GET','POST'],'/match',function (){
    return "get || post hello world";
});

Route::any('/any',function (){
    return "回响应所有的http请求";
});

// 传参
Route::any('/goods/{id}',function ($id = null) {
    return $id;
});

//路由别名
Route::any('/hello/list',['as' =>'list',function () {
    return route('list');// 获得路由地址
}]);
//路由分组
Route::group(['prefix'=>'home'],function (){
    Route::any('/test1',function (){
        return "回响应home的test1 http请求";
    });
    Route::any('/test2',function (){
        return "回响应home的test2 http请求";
    });
});

```



# Artisan控制台
![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1ftpe0tlvy5j30us0ggtb7.jpg)

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fn7uz6j19gj312205igog.jpg)

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fn7uzrk6znj30v80j0wir.jpg)



## 创建控制器

控制器是保存在`app/Http/COntrollers`里面,而且所有的控制器都会继承基础控制器(`Controllers`)

`php artisan make:controller GoodsController`



## 控制器处理请求

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fn81nh5tqtj311g0iiter.jpg)

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fn82fx0xcej31260kkjvy.jpg)

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fn82iyyfcaj319i0q845z.jpg)



## 创建model

`php artisan make:model Goods`

# 使用session

session相关配置在`config/session.php`

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fn836eyhg1j30xo0iagqq.jpg)

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fn83a1vlo7j30n80eyq65.jpg)



# 数据库操作

## 配置文件

`config/database.php`

设置`.env`文件

```shell
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=zongqi
DB_USERNAME=zongqi
DB_PASSWORD=zongqi
```



## 数据库迁移

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fn851mbukoj313m0pa7b0.jpg)



## 数据库查询

### 查询构造器

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fn94uxo5rjj30ve0fq42h.jpg)

```php
DB::table('test_goods')->insert(['name'=>'诺基亚','price'=>100]);
        echo DB::table('test_goods')->insertGetId(['name'=>'小米手机','price'=>100]);
        echo DB::table('test_goods')->where('id',8)->update(['name'=>'小米手机','price'=>300]);
        // 字段减 默认减1
        echo DB::table('test_goods')->where('id',8)->decrement('price',2);
        //字段加 默认加1
        echo DB::table('test_goods')->where('id',8)->increment('price',2);
        // 删除记录
        echo DB::table('test_goods')->where('id',8)->delete();
```

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fn94w7q2a5j30mo0gq42e.jpg)

```php
//
echo DB::table('test_goods')->where('id',1)->update(['price' => 200]);
//
echo DB::table('test_goods')->get();
//
echo DB::table('test_goods')->where('id',5)->get();
//
echo DB::table('test_goods')->pluck('name'); // 只查询某个字段
//
echo DB::table('test_goods')->select('name')->get();
 //  chunk 之前需要排序 分段查询
echo DB::table('test_goods')->orderBy('price')->chunk(2,function($res){
            var_dump($res);
        });
```

![](https://youpaiyun.zongqilive.cn/image/2018-1-8-下午7:47:49.png)

```php
echo DB::table('test_goods')->count();
echo DB::table('test_goods')->max('price');
echo DB::table('test_goods')->min('price');
echo DB::table('test_goods')->avg('price');
echo DB::table('test_goods')->sum('price');
```

### Eloquent ORM操作数据表

O— Object , R— Relation, M —Map

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1fstclg00lxj30ze0bot9v.jpg)


一张表 —>一个对象

每一条记录 —>对象的属性

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fn9icpmc5cj30wc0ggdlk.jpg)



![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fn9if3tsy0j30ru0fi76f.jpg)

# 中间件

# 自动加载
实现自动加载需要一定的规范约束, 

![](https://youpaiyun.zongqilive.cn/image/006tNbRwly1fuiopjr4hsj30r20ksadf-20200226134218780.jpg)

![](https://youpaiyun.zongqilive.cn/image/006tNbRwly1fuiotxpjexj30rn0elgmh.jpg)

![](https://youpaiyun.zongqilive.cn/image/006tNbRwly1fuj8ytz89uj31jo0r6ai7.jpg)


# static 后期动态绑定
![](https://youpaiyun.zongqilive.cn/image/006tNbRwgy1fujtr6r8qqj30gz0ghdga-20200226140442049.jpg)

![](https://youpaiyun.zongqilive.cn/image/006tNbRwgy1fujtro3j2rj30fc0fbq3d.jpg)

# trait   实现代码复用
![](https://youpaiyun.zongqilive.cn/image/006tNbRwly1fuju3mjmp9j30r908w400.jpg)
![](https://youpaiyun.zongqilive.cn/image/006tNbRwly1fuju59vpe4j30rh0c4ju2.jpg)
https://www.jianshu.com/p/fc053b2d7fd1

# Ioc 和 依赖注入模式

![](https://youpaiyun.zongqilive.cn/image/006tNbRwly1fulo487d4mj31kw0brwjs.jpg)

![](https://youpaiyun.zongqilive.cn/image/006tNbRwly1fulo4p181gj30t20ymjti.jpg)

https://segmentfault.com/a/1190000008668208

# IoC容器