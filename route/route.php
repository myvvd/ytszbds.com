<?php

use think\facade\Route;

Route::alias('enroll', 'home/enroll/index');
Route::alias('enroll_agreement', 'home/enroll/agreement');
Route::alias('news', 'home/news/index');
Route::alias('view', 'home/news/view');
Route::alias('login', 'home/user/login');
Route::alias('expertlogin', 'home/user/expertlogin');
Route::alias('logout', 'home/user/logout');
Route::alias('reg', 'home/user/reg');
Route::alias('forgetpwd', 'home/user/forgetpwd');
Route::alias('ucenter', 'home/user/ucenter');
