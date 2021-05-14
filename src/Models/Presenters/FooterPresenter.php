<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Models\Presenters;

use Illuminate\Support\HtmlString;

/**
 * Trait     FooterPresenter
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait FooterPresenter
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
        // TODO: Replace the content placeholders.

        return markdown()->parse($this->page->content);
    }
}
