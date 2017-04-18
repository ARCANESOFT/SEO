<?php namespace Arcanesoft\Seo\Bases;

use Arcanedev\Support\Bases\Migration as BaseMigration;

/**
 * Class     Migration
 *
 * @package  Arcanesoft\Seo\Bases
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Migration extends BaseMigration
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Migration constructor.
     */
    public function __construct()
    {
        $this->setConnection(config('arcanesoft.seo.database.connection'));
        $this->setPrefix(config('arcanesoft.seo.database.prefix', 'seo_'));
    }
}
