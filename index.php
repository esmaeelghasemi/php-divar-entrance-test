<?php

use App\Facades\Advertise;
use App\Facades\Auth;
use App\Facades\FavoriteAdvertise;

require __DIR__ . '/vendor/autoload.php';

/*===================
پیاده سازی تست دیوار
برای اجرای هر فاز کد هایش را از حالت کامنت خارج کنید
esmaeel.ghasemi.org@gmail.com
===================*/


/* فاز اول */
echo Auth::register('user1') . PHP_EOL;
echo Auth::register('user2') . PHP_EOL;
echo Advertise::add('user1', 'car') . PHP_EOL;
echo Advertise::add('user2', 'laptop') . PHP_EOL;
echo Advertise::add('user2', 'laptop') . PHP_EOL;
echo Advertise::myAdvertises('user1') . PHP_EOL;
echo Advertise::myAdvertises('user2') . PHP_EOL;
echo Advertise::remove('user2', 'phone') . PHP_EOL;
echo Advertise::myAdvertises('user2') . PHP_EOL;


/* فاز دوم */
//echo Auth::register('user1') . PHP_EOL;
//echo Auth::register('user2') . PHP_EOL;
//echo Advertise::add('user1', 'car') . PHP_EOL;
//echo Advertise::add('user2', 'laptop') . PHP_EOL;
//echo FavoriteAdvertise::add('user1', 'laptop') . PHP_EOL;
//echo FavoriteAdvertise::add('user1', 'phone') . PHP_EOL;
//echo FavoriteAdvertise::add('user2', 'laptop') . PHP_EOL;
//echo FavoriteAdvertise::add('user1', 'phone') . PHP_EOL;
//echo FavoriteAdvertise::myFavorites('user1') . PHP_EOL;
//echo FavoriteAdvertise::myFavorites('user2') . PHP_EOL;


/* فاز سوم */
//echo Auth::register('user1') . PHP_EOL;
//echo Auth::register('user2') . PHP_EOL;
//echo Advertise::add('user1', 'car', 'automotive') . PHP_EOL;
//echo Advertise::add('user2', 'laptop', 'electronics') . PHP_EOL;
//echo Advertise::add('user2', 'phone', 'electronics') . PHP_EOL;
//echo Advertise::add('user1', 'laptop', 'electronics') . PHP_EOL;
//echo Advertise::myAdvertises('user1', 'electronics') . PHP_EOL;
//echo FavoriteAdvertise::myFavorites('user1') . PHP_EOL;
//echo Advertise::myAdvertises('user1') . PHP_EOL;
