# 系统配置

> 本模块的配置是注入到 `poppy.php` 文件中, 以下的所有配置均可配置
> key 是 `poppy.system`

## enable_cross

- Type : `array`
- Default : `['origin' =>'*','headers'=> '']`

接口请求的时候可以对来源进行设定, 防止web端跨域访问资源

```
'enable_cross'      => [
    // 允许的来源
    // 这里的来源可以为 `*` 或者数组, 数组为类似于 `http://poppy.wulicode.com` 这种形式
    'origin'  => '*',
    
    // 允许的Header
    // 如果有自定义的Header 允许访问的, 可以通过设置此参数来定义比如`X-APP-VERSION`
    // 多个参数使用 `,` 分隔
    'headers' => '',
],
```


## Demo
- Type : `bool`
- Default : `false`

演示模式, 开启则无法上传文件, 修改密码


**CSRF 访问**

```
// 这里是数组模式
// 支持 laravel 的 csrf 格式来忽略固定的路由
'csrf_except'       => [

],
```

**Cookie 输出**

```
// 对这些数据进行 Cookie 原样输出
// 比如 `uid`, `order_no`
'uncrypt_cookies'   => [

],
```

**密码加载器**

```
// 为了兼容多个平台进行相应的密码校验算法  
// 需要实现PasswordContract
'password_provider' => DefaultPasswordProvider::class
```

**登录跳转地址**

当前台用户去做授权失败跳转时候的地址

```
'user_location'        => '/login',
```

**支付类型**

```
// 可根据支付的类型, 用于区分进行回调
payment_types' => [

],
```

**隐藏路由**

后台可以隐藏的路由, 写在这里, 后台列表不予显示

```
'route_hide'        => [

],
```

**ApiSign 验证**

```
'api_sign_provider' => '',
```

**是否进行签名验证**

```
'api_enable_sign'   => true,
```

**后台登录的地址**

```
'prefix'            => 'mgr-page',
```

