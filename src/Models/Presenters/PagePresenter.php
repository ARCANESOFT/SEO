<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Models\Presenters;

use Illuminate\Support\HtmlString;

/**
 * Trait     PagePresenter
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  \Illuminate\Support\HtmlString  content_html
 * @property  string[]                        content_placeholders
 */
trait PagePresenter
{
    /* -----------------------------------------------------------------
     |  Accessors & Mutators
     | -----------------------------------------------------------------
     */

    /**
     * Get the `content_html` attribute.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function getContentHtmlAttribute(): HtmlString
    {
        return markdown()->parse($this->content);
    }

    /**
     * Get the `content_placeholders` attribute.
     *
     * @return array
     */
    public function getContentPlaceholdersAttribute(): array
    {
        preg_match_all("/\[([^]]*)]/", $this->content, $matches);

        return array_unique($matches[1]);
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the content has placeholders.
     *
     * @return bool
     */
    public function hasContentPlaceholders(): bool
    {
        return ! empty($this->getContentPlaceholdersAttribute());
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the parsed content with the given replacers.
     *
     * @param  array  $placeholders
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function parsedContentWithReplacers(array $placeholders): HtmlString
    {
        $content = $this->content;

        if ($this->hasContentPlaceholders()) {
            $search = array_map(function ($str) :string { return "[{$str}]"; }, array_keys($placeholders));
            $content = str_replace($search, array_values($placeholders), $content);
        }

        return markdown()->parse($content);
    }
}
