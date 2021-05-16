<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Models\Presenters;

use Illuminate\Support\{HtmlString, Str};

/**
 * Trait     FooterPresenter
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property-read  string                          lang
 * @property-read  \Illuminate\Support\HtmlString  content_html
 */
trait FooterPresenter
{
    /* -----------------------------------------------------------------
     |  Accessors & Mutators
     | -----------------------------------------------------------------
     */

    /**
     * Get the `lang` attribute.
     *
     * @return string
     */
    public function getLangAttribute(): string
    {
        return $this->page->lang;
    }

    /**
     * Get the `content_html` attribute.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function getContentHtmlAttribute(): HtmlString
    {
        return $this->page->parsedContentWithReplacers($this->placeholders);
    }

    /**
     * Set the `url` attribute.
     *
     * @param  string  $url
     */
    public function setUrlAttribute(string $url)
    {
        $this->attributes['url'] = Str::slug($url);
    }
}
