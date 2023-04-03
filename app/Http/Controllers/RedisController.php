<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    public function direct()
    {
        $storage = Redis::connection();
        $key = rand(1, 50);
        $storage->set($key, 'direct-' . $key, 'EX', 60);
        return $storage->get($key);
    }

    public function cacheImpl()
    {
        $key = rand(51, 100);
        Cache::put('cache-key-' . $key, 'cache-value-' . $key, 60);
        return 'The value: ' . Cache::get('cache-key-' . $key) . ' old:' . Cache::get('cache-key-' . 60);
    }

    public function sessionCache(Request $request)
    {
        $key = rand(101, 150);
        session([$key => 'session-' . $key]);
        return session($key);
    }
}
