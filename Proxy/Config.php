<?php

declare(strict_types=1);

namespace Leevel\Config\Proxy;

use Leevel\Config\Config as BaseConfig;
use Leevel\Di\Container;

/**
 * 代理 config.
 *
 * @method static bool  has(string $name = 'app\\')                   是否存在配置.
 * @method static mixed get(string $name = 'app\\', $defaults = null) 获取配置.
 * @method static array all()                                         返回所有配置.
 * @method static void  set($name, $value = null)                     设置配置.
 * @method static void  delete(string $name)                          删除配置.
 * @method static void  reset($namespaces = null)                     初始化配置参数.
 */
class Config
{
    /**
     * 实现魔术方法 __callStatic.
     */
    public static function __callStatic(string $method, array $args): mixed
    {
        return self::proxy()->{$method}(...$args);
    }

    /**
     * 代理服务.
     */
    public static function proxy(): BaseConfig
    {
        // @phpstan-ignore-next-line
        return Container::singletons()->make('config');
    }
}
