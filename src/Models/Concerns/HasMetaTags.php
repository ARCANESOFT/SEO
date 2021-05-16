<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Models\Concerns;

use Arcanesoft\Seo\Models\Meta;
use Arcanesoft\Seo\Seo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Trait     HasMetaTags
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @mixin  \Illuminate\Database\Eloquent\Concerns\HasRelationships
 */
trait HasMetaTags
{
    /* -----------------------------------------------------------------
     |  Relationships
     | -----------------------------------------------------------------
     */

    /**
     * Meta's relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function meta(): MorphOne
    {
        return $this->morphOne(Seo::model('meta', Meta::class), 'metable');
    }
}
