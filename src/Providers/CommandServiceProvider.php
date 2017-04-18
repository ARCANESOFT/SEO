<?php namespace Arcanesoft\Seo\Providers;

use Arcanedev\Support\Providers\CommandServiceProvider as ServiceProvider;
use Arcanesoft\Seo\Console;

/**
 * Class     CommandServiceProvider
 *
 * @package  Arcanesoft\Seo\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CommandServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        Console\InstallCommand::class,
    ];
}
