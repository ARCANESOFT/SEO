<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Repositories;

use Arcanesoft\Seo\Models\Meta;
use Arcanesoft\Seo\Seo;

/**
 * Class     MetasRepository
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetasRepository extends Repository
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model FQN class.
     *
     * @return string
     */
    public static function modelClass(): string
    {
        return Seo::model('meta', Meta::class);
    }
}
