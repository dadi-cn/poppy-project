<?php

use Illuminate\Routing\Router;

Route::group([
    'namespace' => 'Poppy\MgrPage\Http\Request\Backend',
], function (Router $router) {
    $router->any('cp', 'HomeController@cp')
        ->name('py-mgr-page:backend.home.cp');
    $router->any('password', 'HomeController@password')
        ->name('py-mgr-page:backend.home.password');
    $router->any('clear_cache', 'HomeController@clearCache')
        ->name('py-mgr-page:backend.home.clear_cache');
    $router->any('logout', 'HomeController@logout')
        ->name('py-mgr-page:backend.home.logout');
    $router->any('setting/{path?}/{index?}', 'HomeController@setting')
        ->name('py-mgr-page:backend.home.setting');
    $router->any('easy-web/{type}', 'HomeController@easyWeb')
        ->name('py-mgr-page:backend.home.easy-web');

    $router->get('role', 'RoleController@index')
        ->name('py-mgr-page:backend.role.index');
    $router->any('role/establish/{id?}', 'RoleController@establish')
        ->name('py-mgr-page:backend.role.establish');
    $router->any('role/delete/{id?}', 'RoleController@delete')
        ->name('py-mgr-page:backend.role.delete');
    $router->any('role/menu/{id}', 'RoleController@menu')
        ->name('py-mgr-page:backend.role.menu');

    $router->get('pam', 'PamController@index')
        ->name('py-mgr-page:backend.pam.index');
    $router->any('pam/establish/{id?}', 'PamController@establish')
        ->name('py-mgr-page:backend.pam.establish');
    $router->any('pam/password/{id}', 'PamController@password')
        ->name('py-mgr-page:backend.pam.password');
    $router->any('pam/disable/{id}', 'PamController@disable')
        ->name('py-mgr-page:backend.pam.disable');
    $router->any('pam/enable/{id}', 'PamController@enable')
        ->name('py-mgr-page:backend.pam.enable');
    $router->any('pam/log', 'PamController@log')
        ->name('py-mgr-page:backend.pam.log');

    /* 发送测试邮件
     * ---------------------------------------- */
    $router->any('mail/store', 'MailController@store')
        ->name('py-mgr-page:backend.mail.store');
    $router->any('mail/test', 'MailController@test')
        ->name('py-mgr-page:backend.mail.test');

    $router->any('upload/store', 'UploadController@store')
        ->name('py-mgr-page:backend.upload.store');

    /* 操作
     * ---------------------------------------- */
    $router->any('handle/form', 'HandleController@form')
        ->name('py-mgr-page:backend.handle.form');
});