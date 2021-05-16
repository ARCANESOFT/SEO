<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Database;

use Arcanedev\Support\Database\Migration as BaseMigration;
use Arcanesoft\Seo\Seo;

/**
 * Class     Migration
 *
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
        $this->setConnection(Seo::config('database.connection'));
        $this->setPrefix(Seo::config('database.prefix'));
    }
}
