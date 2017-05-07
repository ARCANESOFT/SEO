<?php namespace Arcanesoft\Seo\Models\Presenters;

use Arcanesoft\Seo\Helpers\SeoChecker;
use Illuminate\Support\Arr;

/**
 * Class     MetaPresenter
 *
 * @package  Arcanesoft\Seo\Models\Presenters
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait MetaPresenter
{
    /* -----------------------------------------------------------------
     |  Accessors
     | -----------------------------------------------------------------
     */

    /**
     * Get the `title_status` attribute.
     *
     * @return string
     */
    public function getTitleStatusAttribute()
    {
        return SeoChecker::label(
            SeoChecker::checkTitle($this->title)
        );
    }

    /**
     * Get the `description_status` attribute.
     *
     * @return string
     */
    public function getDescriptionStatusAttribute()
    {
        return SeoChecker::label(
            SeoChecker::checkDescription($this->description)
        );
    }
}
