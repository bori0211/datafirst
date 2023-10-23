<?php
$redis = new Redis();
try {
    $redis->connect('bitboard.datafirst.co.kr','6379', 2.5, NULL, 150);
    $key = 'myKey';
    $value = '123';
    $ttl = 3600;
    $redis->setex( $key, $ttl, $value );
    $value = $redis->get($key);
    $redis->delete($key);
    var_dump($value);
} catch(RedisException $e) {
    var_dump($e);
}
$redis->close();