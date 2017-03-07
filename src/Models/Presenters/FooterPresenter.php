<?php namespace Arcanesoft\Seo\Models\Presenters;

use Arcanesoft\Seo\Entities\Locales;

/**
 * Class     FooterPresenter
 *
 * @package  Arcanesoft\Seo\Models\Presenters
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  string  locale
 * @property  string  locale_name
 * @property  string  content
 *
 * @property  \Arcanesoft\Seo\Models\Page  page
 */
trait FooterPresenter
{
    /* -----------------------------------------------------------------
     |  Accessors
     | -----------------------------------------------------------------
     */
    /**
     * Get the `locale_name` attribute.
     *
     * @return string|null
     */
    public function getLocaleNameAttribute()
    {
        return Locales::get($this->locale);
    }

    /**
     * Get the `content` attribute.
     *
     * @return string
     */
    public function getContentAttribute()
    {
        return $this->page->renderContent([
            'footer_name'         => $this->name,
            'footer_localization' => $this->localization,
        ]);
    }
}
