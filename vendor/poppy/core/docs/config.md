# Core 配置

## 隐藏路由

```
// 后台可以隐藏的路由, 写在这里, 后台列表不予显示
'route_hide' => [
],
```

## api接口文档

```
// 接口文档的定义 需要运行 `php artisan py-core:doc api`来生成技术文档
'apidoc' => [
	'web' => [
        // 标题
        'title'            => '前台接口',   
        // 方法
        'method'           => 'post',    
        // 默认访问地址
        'default_url'      => 'api_v1/system/auth/login', 
        // 其他参数  签名验证
		'sign_certificate' => [
			'name'         => 'timestamp',
			'title'        => 'TimeStamp',
			'type'         => 'String',
			'is_required'  => 'Y',
		],
        // 签名生成
		'sign_generate'    => DefaultApiSignProvider::js(),  
        // 源文件夹
        'origin'           => 'modules',
        // 接口测试构建器
        'factory'          => WebApiFactory::class,
        // 生成目录
        'doc'              => 'public/docs/backend',
	],
]
```

## 维护邮箱地址

```
// 后台可支持发送测试邮件
// 发邮件需要在.env 设置发送人邮箱
'op_mail'    => env('CORE_OP_MAIL', ''),
```

## RBAC

```
// 设置 RBAC 模型以及外键 KEY 
    'rbac'       => [
        // 角色模型
        'role'            => \Poppy\System\Models\PamRole::class,
        // 账号模型
        'account'         => \Poppy\System\Models\PamAccount::class,
        // 角色账号模型
        'role_account'    => \Poppy\System\Models\PamRoleAccount::class,
        // 权限模型
        'permission'      => \Poppy\System\Models\PamPermission::class,
        // 角色权限模型
        'role_permission' => \Poppy\System\Models\PamPermissionRole::class,
        // 角色外键
        'role_fk'         => 'role_id',
        // 账号外键
        'account_fk'      => 'account_id',
        // 权限外键
        'permission_fk'   => 'permission_id',
    ],
```