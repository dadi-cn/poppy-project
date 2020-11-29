# 扩展 : Core 说明

### 权限操作

```
php artisan py-core:permission {slug}
{slug}:
    - list   : 获取权限列表
    - init   : 权限初始化
    - menus  : 检查菜单[todo Undefined index: children]
    - assign : 将权限赋值给指定的用户组
    - check  : 权限检测
```

### 生成 api 文档


```
php artisan py-core:doc {slug}
{slug}:
    - api   : 生成api文档[apidoc 生成目录]
    - cs    : code style - fix , 代码格式修复(todo 以后IDE 来做)
    - cs-pf : 
    - lint  : 安装检测PHP语法错误的工具
    - php   : 生成 php api 文档
    - log   : 查看当天的 storage 日志
```

### 检查代码

```
php artisan py-core:inspect {slug}
{slug} :
    - apidoc     : 检查api文档(需要指定目录)
    - class      : 方法检测
    - pages      : 检测页面Key[todo 以后会删掉]
    - file       : 检测文件命名[文件类和文件位置不匹配]
    - database   : 检测数据库配置
    - controller : 列出所有功能点
    - action     : 列出所有业务逻辑
    - seo        : 生成 seo 项目
    - db_seo     : 生成数据库SEO 数据
```

### 维修工具

```
php artisan py-core:op {slug}
{slug} : 
    - mail   : 发送运维邮件
```
