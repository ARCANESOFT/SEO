<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Models;

use Arcanesoft\Foundation\Support\Traits\Deletable;
use Arcanesoft\Seo\Models\Concerns\HasMetaTags;
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
 * @property  array                       placeholders
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
    use HasMetaTags;
    use Deletable;

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
        'placeholders',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id'           => 'int',
        'page_id'      => 'int',
        'placeholders' => 'array',
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

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the object is deletable.
     *
     * @return bool
     */
    public function isDeletable(): bool
    {
        // TODO: Add the deletion check
        return true;
    }
}
