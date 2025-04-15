<?php

use App\Facades\Auth;

require __DIR__ . '/vendor/autoload.php';

echo Auth::register('user1');
echo PHP_EOL;
echo Auth::register('user1');