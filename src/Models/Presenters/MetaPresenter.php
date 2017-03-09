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
        return SeoChecker::checkTitle($this->title);
    }

    /**
     * Get the `description_status` attribute.
     *
     * @return string
     */
    public function getDescriptionStatusAttribute()
    {
        return SeoChecker::checkDescription($this->description);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */
    /**
     * Get a label status by a given key.
     *
     * @param  string  $status
     *
     * @return string
     */
    protected function getLabelStatus($status)
    {
        $statuses = [
            SeoChecker::STATUS_DANGER  => 'danger',
            SeoChecker::STATUS_GOOD    => 'success',
            SeoChecker::STATUS_WARNING => 'warning',
        ];

        return Arr::get($statuses, $status, 'default');
    }
}
