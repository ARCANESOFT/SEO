<?php

namespace Arcanesoft\Seo\Http\Transformers;

use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
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
        ];
    }
}
