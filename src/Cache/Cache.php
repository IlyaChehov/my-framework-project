<?php

namespace Ilya\MyFrameworkProject\Cache;

class Cache
{
    public function set($key, $data, $seconds = 3600): void
    {
        $content['data'] = $data;
        $content['endTime'] = time() + $seconds;
        $cacheFile = CACHE . '/' . md5($key) . '.txt';
        file_put_contents($cacheFile, serialize($content));
    }

    public function get($key, $default = null)
    {
        $cacheFile = CACHE . '/' . md5($key) . '.txt';
        if (file_exists($cacheFile)) {
            $content = unserialize(file_get_contents($cacheFile));
            if (time() <= $content['endTime']) {
                return $content['data'];
            }
            unlink($cacheFile);
        }

        return $default;
    }

    public function remove($key): void
    {
        $cacheFile = CACHE . '/' . md5($key) . '.txt';
        if (file_exists($cacheFile)) {
            unlink($cacheFile);
        }
    }
}
