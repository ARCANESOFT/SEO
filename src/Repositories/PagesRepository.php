<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Repositories;

use Arcanesoft\Seo\Models\Page;
use Arcanesoft\Seo\Seo;

/**
 * Class     PagesRepository
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PagesRepository extends Repository
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model FQN class.
     *
     * @return string
     */
    public static function modelClass(): string
    {
        return Seo::model('page', Page::class);
    }

    /* -----------------------------------------------------------------
     |  CRUD Methods
     | -----------------------------------------------------------------
     */

    /**
     * Create a new post.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Seo\Models\Page
     */
    public function createOne(array $attributes): Page
    {
        return tap($this->model()->fill($attributes), function (Page $page) use ($attributes) : void {
            $page->save();
        });
    }

    public function updateOne(Page $page, array $attributes)
    {
        $page->fill($attributes);

        return $page->save();
    }

    /**
     * @param  \Arcanesoft\Seo\Models\Page  $page
     *
     * @return bool|null
     */
    public function deleteOne(Page $page)
    {
        return $page->delete();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the page's placeholders.
     *
     * @return \Illuminate\Support\Collection
     */
    public function pagePlaceholders()
    {
        return $this->all()->transform(function (Page $page) {
            return [
                'key'          => $page->getKey(),
                'name'         => $page->name,
                'placeholders' => $page->content_placeholders,
            ];
        });
    }
}
