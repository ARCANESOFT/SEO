<?php namespace Arcanesoft\Seo\Models;

use Arcanedev\LaravelSeo\Traits\Seoable;

/**
 * Class     Footer
 *
 * @package  Arcanesoft\Seo\Models
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int             id
 * @property  int             page_id
 * @property  string          locale
 * @property  string          uri
 * @property  string          name
 * @property  string          localization
 * @property  \Carbon\Carbon  created_at
 * @property  \Carbon\Carbon  updated_at
 *
 * @property  \Arcanesoft\Seo\Models\Page  page
 */
class Footer extends AbstractModel
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use Seoable,
        Presenters\FooterPresenter;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_id', 'locale', 'uri', 'name', 'localization',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'      => 'integer',
        'page_id' => 'integer',
    ];

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Footer constructor.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setConnection(config('arcanesoft.seo.database.connection'));
        $this->setPrefix(config('arcanesoft.seo.database.prefix', 'seo_'));
    }

    /**
     * The "booting" method of the model.
     *
     * @todo: Refactor to dedicated observer
     */
    protected static function boot()
    {
        parent::boot();

        self::deleting(function (Footer $footer) {
            $footer->deleteSeo();
        });
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
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public static function createOne(array $attributes)
    {
        $footer = new self([
            'name'         => $attributes['name'],
            'localization' => $attributes['localization'],
            'uri'          => $attributes['uri'],
            'locale'       => $attributes['locale'],
            'page_id'      => $attributes['page'],
        ]);

        $footer->save();

        $footer->createSeo([
            'title'       => $attributes['seo_title'],
            'description' => $attributes['seo_description'],
            'keywords'    => $attributes['seo_keywords'],
        ]);

        return $footer;
    }

    public function updateOne(array $attributes)
    {
        $result = $this->update([
            'name'         => $attributes['name'],
            'localization' => $attributes['localization'],
            'uri'          => $attributes['uri'],
            'locale'       => $attributes['locale'],
            'page_id'      => $attributes['page'],
        ]);

        $this->updateSeo([
            'title'       => $attributes['seo_title'],
            'description' => $attributes['seo_description'],
            'keywords'    => $attributes['seo_keywords'],
        ]);

        return $result;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the show URL.
     *
     * @return string
     */
    public function getShowUrl()
    {
        return route('admin::seo.footers.show', [$this]);
    }

    /**
     * Get the edit URL.
     *
     * @return string
     */
    public function getEditUrl()
    {
        return route('admin::seo.footers.edit', [$this]);
    }
}
