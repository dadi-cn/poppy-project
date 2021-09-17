@extends('system::tpl.default')
@section('title', $_title ?? '')
@section('description', $_description ?? '')
@section('head-css')
    {!! Html::style(mix('assets/css/web.css')) !!}
@endsection
@section('head-script')
    <base target="_blank">
@endsection
@section('body-main')
    <div class="container">
        <h4>布局 - Web版</h4>
        <table class="table table-bordered">
            <tr>
                <th rowspan="2">第一版</th>
                <td><a href="{!! route('system:develop.layout.index', ['layout.v1.wheel']) !!}">首页</a></td>
                <td><a href="{!! route('system:develop.layout.index', ['layout.v1.team']) !!}">团队</a></td>
                <td><a href="{!! route('system:develop.layout.index', ['layout.v1.about']) !!}">关于我们</a></td>
                <td><a href="{!! route('system:develop.layout.index', ['layout.v1.join']) !!}">加入我们</a></td>
            </tr>
            <tr>
                <td><a href="{!! route('system:develop.layout.index', ['layout.v1.tmall']) !!}">产品 - 天猫</a></td>
                <td><a href="{!! route('system:develop.layout.index', ['layout.v1.dailian']) !!}">产品 - 易代练</a></td>
                <td><a href="{!! route('system:develop.layout.index', ['layout.v1.liex']) !!}">产品 - 猎象</a></td>
                <td></td>
            </tr>
            <tr>
                <th>第二版</th>
                <td><a href="{!! route('system:develop.layout.index', ['layout.v2.index']) !!}">首页(new)</a></td>
            </tr>
        </table>
        <h4>布局 - 手机版</h4>
        <table class="table table-bordered">
            <tr>
                <td><a href="{!! route('system:develop.layout.index', ['layout.m.h5']) !!}">猎象电竞</a></td>
                <td><a href="{!! route('system:develop.layout.index', ['layout.m.homepage']) !!}">H5首页</a></td>
                <td><a href="{!! route('system:develop.layout.index', ['layout.m.activity']) !!}">新人有礼活动页</a></td>
            </tr>
        </table>
        <h4>上线</h4>
        <table class="table table-bordered">
            <tr>
                <td><a href="{!! route('site:web.homepage.lxdj') !!}">猎象电竞(Mobile/Pc)</a></td>
                <td><a href="{!! route('site:web.homepage.index') !!}">主页(Mobile/Pc)</a></td>
                <td>
                    <a href="/api_v1/user/approve/question">答题(M)</a> <br>
                    <small>需要加入 `?token=xxx` 来访问</small>
                </td>
                <td>
                    <a href="/api_v1/user/approve/rule">认证规则(M)</a><br>
                    <small>需要加入 `?token=xxx` 来访问</small>
                </td>
                <td>
                    <a href="/api_v1/sundry/h5/coupon">优惠券说明(M)</a>
                </td>
            </tr>
            <tr>
                <td><a href="/api_v1/sundry/h5/about">关于我们(M)</a></td>
                <td>
                    <a href="/api_v1/sundry/activity/lists">活动列表(M)</a><br>
                    <small>需要加入 `?token=xxx` 来访问</small>
                </td>
                <td>
                    <a href="/api_v1/sundry/h5/help?parent_id=1">帮助列表(M)</a><br>
                    <small>需要加入 `?parent_id=xxx` 来访问</small>
                </td>
                <td>
                    <a href="/api_v1/sundry/h5/help?id=2">帮助详细(M)</a><br>
                    <small>需要加入 `?id=xxx` 来访问</small>
                </td>
                <td>
                    <a href="/api_v1/sundry/h5/disclaimer">法律声明(M)</a>
                </td>
            </tr>
            <tr>
                <td><a href="/api_v1/sundry/h5/agreement">猎手协议(M)</a></td>
                <td><a href="/api_v1/sundry/h5/question">钱包常见问题(M)</a></td>
                <td><a href="/api_v1/sundry/h5/protocol">用户协议(M)</a></td>
                <td>
                    <a href="/api_v1/sundry/activity/sign">签到(M)</a><br>
                    <small>需要加入 `?id=xxx` 来访问</small>
                </td>
                <td>
                    <a href="/api_v1/sundry/activity/lists">活动列表(未登录)</a><br>
                    <small>需要加入 `?id=xxx` 来访问</small>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="/api_v1/sundry/activity/new_register">新人有礼(M)</a>
                    <small>需要加入 `?token=xxx` 来访问</small>
                </td>
                <td>
                    <a href="/api_v1/sundry/h5/normal">标准单订单说明(M)</a>
                </td>
                <td>
                    <a href="/api_v1/sundry/h5/car">车队单订单说明(M)</a>
                </td>
                <td>
                    <a href="/api_v1/sundry/h5/custom">商户单订单说明(M)</a>
                </td>
                <td>
                    <a href="/api_v1/sundry/h5/room">车队说明(M)</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="/mobile/site/reward">抽奖(M)</a>
                    <small>需要加入 `?token=xxx` 来访问</small>
                </td>
                <td>
                    <a href="/api_v1/sundry/h5/first_yi">首单一元(M)</a>
                    <small>需要加入 `?token=xxx` 来访问</small>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
        </table>
    </div>
@endsection