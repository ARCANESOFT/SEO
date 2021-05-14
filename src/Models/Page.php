<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Models;

use Arcanesoft\Seo\Models\Presenters\PagePresenter;
use Arcanesoft\Seo\Seo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class     Page
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int                         id
 * @property  string                      name
 * @property  string                      content
 * @property  string                      lang
 * @property  \Illuminate\Support\Carbon  created_at
 * @property  \Illuminate\Support\Carbon  updated_at
 *
 * @property  \Illuminate\Database\Eloquent\Collection|\Arcanesoft\Seo\Models\Footer[]  $footers
 */
class Page extends Model
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use PagePresenter;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'content',
        'lang',
    ];

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(Seo::table('pages'));

        parent::__construct($attributes);
    }

    /* -----------------------------------------------------------------
     |  Relationships
     | -----------------------------------------------------------------
     */

    /**
     * Footers' relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function footers(): HasMany
    {
        return $this->hasMany(Seo::model('footer', Footer::class));
    }
}
