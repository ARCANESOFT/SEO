<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Models;

use Arcanesoft\Seo\Seo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class     Meta
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int                         id
 * @property  string                      metable_type
 * @property  int                         metable_id
 * @property  array                       tags
 * @property  string                      lang
 * @property  \Illuminate\Support\Carbon  created_at
 * @property  \Illuminate\Support\Carbon  updated_at
 *
 * @property  \Illuminate\Database\Eloquent\Model|mixed  metable
 */
class Meta extends Model
{
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
        'tags',
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
        $this->setTable(Seo::table('metas'));

        parent::__construct($attributes);
    }

    /* -----------------------------------------------------------------
     |  Relationships
     | -----------------------------------------------------------------
     */

    /**
     * Get the parent metable model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function metable(): MorphTo
    {
        return $this->morphTo();
    }
}
