<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Http\Transformers;

use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Arcanesoft\Foundation\Datatable\DataTypes\BadgeCount;
use Illuminate\Http\Request;

/**
 * Class     PageTransformer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PageTransformer implements Transformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the resource.
     *
     * @param  \Arcanesoft\Seo\Models\Page|mixed  $resource
     * @param  \Illuminate\Http\Request           $request
     *
     * @return array
     */
    public function transform($resource, Request $request): array
    {
        return [
            'name'       => $resource->name,
            'lang'       => $resource->lang,
            'created_at' => $resource->created_at->format('Y-m-d H:i:s'),
            'footers'    => (new BadgeCount)->transform($resource->footers_count),
        ];
    }
}
