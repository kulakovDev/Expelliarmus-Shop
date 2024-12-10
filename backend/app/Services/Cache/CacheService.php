<?php

declare(strict_types=1);

namespace App\Services\Cache;

use Illuminate\Cache\Repository;
use Illuminate\Support\Facades\Cache;
use InvalidArgumentException;

readonly class CacheService
{
    public function __construct(
        public Repository $repository
    ) {
    }

    public function key(string $prefix, string|int|null $identifier = null)
    {
        $configKey = config('cache.keys.'.$prefix);

        if ($configKey === null) {
            throw new InvalidArgumentException('Cache key prefix must be defined in cache config in \'keys\' array');
        }

        return $identifier === null ? $configKey : sprintf($configKey, $identifier);
    }

    public static function forgetKey(string $prefix, string|int|null $identifier = null): void
    {
        if ($identifier === null) {
            Cache::forget('cache.keys'.$prefix);
        } else {
            Cache::forget(sprintf(config('cache.keys.'.$prefix), $identifier));
        }
    }
}