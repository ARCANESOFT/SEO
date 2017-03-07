<?php namespace Arcanesoft\Seo\Models\Presenters;

use Arcanesoft\Seo\Entities\Locales;

/**
 * Class     PagePresenter
 *
 * @package  Arcanesoft\Seo\Models\Presenters
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  string  locale
 * @property  string  locale_name
 * @property  string  content
 * @property  string  content_preview
 */
trait PagePresenter
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
     * Get the `content_preview` attribute.
     *
     * @return string
     */
    public function getContentPreviewAttribute()
    {
        return empty($pattern = $this->getReplacerPattern())
            ? $this->content
            : preg_replace($pattern, '<span class="label label-inverse">[\1]</span>', $this->content);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */
    /**
     * Get the content replacer pattern.
     *
     * @return string
     */
    protected function getReplacerPattern()
    {
        $replacer = config('arcanesoft.seo.pages.replacer', []);

        return empty($replacer) ? '' : '/\[('.implode('|', $replacer).')\]/';
    }
}
