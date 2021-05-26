<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Repositories;

use Arcanesoft\Seo\Models\Footer;
use Arcanesoft\Seo\Seo;

/**
 * Class     FootersRepository
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FootersRepository extends Repository
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
        return Seo::model('footer', Footer::class);
    }

    /* -----------------------------------------------------------------
     |  CRUD Methods
     | -----------------------------------------------------------------
     */

    /**
     * Create a new footer.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Seo\Models\Footer
     */
    public function createOne(array $attributes): Footer
    {
        $attributes = array_merge($attributes, [
            'page_id' => $attributes['page'], // TODO: Place this in form request
        ]);

        return tap($this->model()->fill($attributes), function (Footer $footer) use ($attributes) : void {
            $footer->save();

            if ($attributes['metas'])
                $footer->meta()->create([
                    'tags' => $attributes['metas'],
                ]);
        });
    }

    /**
     * Update the given footer.
     *
     * @param  \Arcanesoft\Seo\Models\Footer  $footer
     * @param  array                          $attributes
     *
     * @return bool
     */
    public function updateOne(Footer $footer, array $attributes): bool
    {
        $footer->fill(array_merge($attributes, [
            'page_id' => $attributes['page'], // TODO: Place this in form request
        ]));

        if ($attributes['metas'])
            $footer->meta->fill([
                'tags' => $attributes['metas'],
            ]);

        return $footer->push();
    }

    /**
     * @param  \Arcanesoft\Seo\Models\Footer  $footer
     *
     * @return bool|null
     */
    public function deleteOne(Footer $footer)
    {
        return $footer->delete();
    }
}
