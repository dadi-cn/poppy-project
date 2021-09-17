# 说明

本项目是基于 Laravel 6.0 lts 的模块化开发框架, 项目为了便于管理分为 框架, 核心, 管理, 组件, 使用 composer 进行模块化安装

- 项目文档 : https://poppy.wulicode.com/doc/
- V3 Demo : https://v3.wulicode.com

## 介绍

使用本项目可以快速的完成项目业务逻辑的开发, 其中包含

- RBAC权限管理
- 完整的后台管理框架
- 用户管理
- 接口验签
- 接口开发工具
- 快速表单生成

项目是在公司内部的业务逻辑的基础之上剥离出来, 并且应用在公司快速开发的项目中, 内涵丰富的功能，可满足日常 80% 的开发需求

## 安装

```
# install
$ composer create-project poppy/project poppy_v3 3.1.x-dev  

# 内部安装
$ composer create-project poppy/project poppy_v3 3.1.x-dev --repository=https://packagist.sour-lemon.com

# run server
$ cd poppy_v3
$ php artisan serve

# test demo && api
$ curl http://127.0.0.1:8000/demo
Demo Web Request Success
$ curl http://127.0.0.1:8000/api/demo
Demo Api Request Success%
```

## 初始化数据库

## 反馈

[Github Issues](https://github.com/imvkmark/poppy-project/issues)
