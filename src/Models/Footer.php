<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Models;

use Arcanesoft\Seo\Models\Presenters\FooterPresenter;
use Arcanesoft\Seo\Seo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class     Footer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int                         id
 * @property  int                         page_id
 * @property  int                         order
 * @property  string                      url
 * @property  string                      name
 * @property  string                      placeholder
 * @property  string                      title
 * @property  string                      description
 * @property  string                      keywords
 * @property  \Illuminate\Support\Carbon  created_at
 * @property  \Illuminate\Support\Carbon  updated_at
 *
 * @property  \Arcanesoft\Seo\Models\Page  page
 */
class Footer extends Model
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use FooterPresenter;

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
        'page_id',
        'order',
        'url',
        'name',
        'placeholder',

        // TODO: Use a dynamic SEO metas
        'title',
        'description',
        'keywords',
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
        $this->setTable(Seo::table('footers'));

        parent::__construct($attributes);
    }

    /* -----------------------------------------------------------------
     |  Relationships
     | -----------------------------------------------------------------
     */

    /**
     * Page's relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Seo::model('page', Page::class));
    }
}
