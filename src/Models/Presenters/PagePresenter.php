<?php namespace Arcanesoft\Seo\Models\Presenters;

use Arcanesoft\Seo\Entities\Locales;
use Arcanesoft\Seo\Helpers\TextReplacer;

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
        return $this->getContentReplacer()->highlight($this->content);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Render the content.
     *
     * @param  array  $replacements
     *
     * @return string
     */
    protected function renderContent(array $replacements)
    {
        return $this->getContentReplacer()->replace($this->content, array_merge([
            'app_name' => config('app.name'),
            'app_url'  => link_to(config('app.url'), config('app.name')),
            'mobile'   => html()->tel(config('cms.company.mobile')),
            'phone'    => html()->tel(config('cms.company.phone')),
            'email'    => html()->mailto(config('cms.company.email')),
        ], $replacements));
    }

    /**
     * Get the content replacer.
     *
     * @return \Arcanesoft\Seo\Helpers\TextReplacer
     */
    protected static function getContentReplacer()
    {
        return TextReplacer::make(
            config('arcanesoft.seo.pages.replacer', [])
        );
    }

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
