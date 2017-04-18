<?php namespace Arcanesoft\Seo\Console;

use Arcanedev\Support\Bases\Command;
use Arcanesoft\Seo\Seeds\DatabaseSeeder;

/**
 * Class     InstallCommand
 *
 * @package  Arcanesoft\Seo\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class InstallCommand extends Command
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature   = 'seo:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the SEO module.';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('db:seed', ['--class' => DatabaseSeeder::class]);
    }
}
