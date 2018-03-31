# lara-show
a simple project like https://www.jianshu.com/ based on laravel 5.5。(基于laravel5.5，创建的一个简单的简书网的项目)

根据视频http://coding.imooc.com/class/111.html 做好的一个项目

安装教程
1. 首先git clone  https://github.com/kavience/lara-show.git 到网站目录

2. 执行composer install（composer的安装使用请参考http://docs.phpcomposer.com/00-intro.html）

3. 给予storage 和 bootstrap/cache 权限（根据不同的系统修改文件所有者为Apache或者nginx用户，或者直接给个777权限也没关系），chmod 777 -R storage bootstrap/cache

4.配置网站根目录为 lara-show/public 目录下

5.安装数据库和填充数据： php artisan migrate --seed

6.打开网站即可访问。效果参考网站: http://lara-show.kavience.com/

项目总结点 ：
1.全局scope的方式；

2.ajaxSetup提交设置token,在meta里面设置csrf_token；

3.collection的diff()函数

4.门卫Gate的概念

5.视图合成器的概念

6.路由resource对应的8个操作方法

7.laravel中的队列
  1.驱动（"sync", "database", "beanstalkd", "sqs", "redis", "null"）
  2.定义任务
  3.分发任务
  4.启动队列
  5.系统通知队列的实际实现

8.模型之间个各个管理(一对多，多对一，多对多等等)

9.migration的操作以及seeder数据填充(包括工厂类方法的填充)的概念

10.注意服务提供者是最先执行，如果没有创建好数据库而在其它地方(例如routes，AuthServiceProvider等)引用了数据库，将引发一系列错误，最好利用try catch捕获异常。

11.代码风格一定要遵循php编码规范(https://psr.phphub.org/)

未完待续。。。

