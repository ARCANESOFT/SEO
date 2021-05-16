<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Http\Transformers;

use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Illuminate\Http\Request;

/**
 * Class     FooterTransformer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FooterTransformer implements Transformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the resource.
     *
     * @param  \Arcanesoft\Seo\Models\Footer|mixed  $resource
     * @param  \Illuminate\Http\Request             $request
     *
     * @return array
     */
    public function transform($resource, Request $request): array
    {
        return [
            'name'       => $resource->name,
            'url'        => $resource->url,
            'created_at' => $resource->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
