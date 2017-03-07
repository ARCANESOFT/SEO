<?php namespace Arcanesoft\Seo\Models;

/**
 * Class     Page
 *
 * @package  Arcanesoft\Seo\Models
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int             id
 * @property  string          name
 * @property  string          content
 * @property  string          locale
 * @property  \Carbon\Carbon  created_at
 * @property  \Carbon\Carbon  updated_at
 *
 * @property  \Illuminate\Database\Eloquent\Collection  footers
 */
class Page extends AbstractModel
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */
    use Presenters\PagePresenter;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'content', 'locale'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */
    /**
     * Page constructor.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setConnection(config('arcanesoft.seo.database.connection'));
        $this->setPrefix(config('arcanesoft.seo.database.prefix', 'seo_'));
    }

    /* -----------------------------------------------------------------
     |  Relationships
     | -----------------------------------------------------------------
     */
    /**
     * Footer's relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function footers()
    {
        return $this->hasMany(Footer::class);
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Create a new page.
     *
     * @param  array  $attributes
     *
     * @return self
     */
    public static function createOne(array $attributes)
    {
        $page = new self($attributes);
        $page->save();

        return $page;
    }

    /**
     * Update a page.
     *
     * @param  array  $attributes
     *
     * @return bool
     */
    public function updateOne(array $attributes)
    {
        return $this->update($attributes);
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */
    /**
     * Check if the page is deleteable.
     *
     * @return bool
     */
    public function isDeleteable()
    {
        return $this->footers->isEmpty();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */
    public function renderContent(array $replacer)
    {
        $content      = $this->content;
        $replacements = array_merge([
            'app_name' => config('app.name'),
            'app_url'  => link_to(config('app.url'), config('app.name')),
            'mobile'   => config('cms.company.mobile'),
            'phone'    => config('cms.company.phone'),
            'email'    => html()->mailto(config('cms.company.email')),
        ], $replacer);

        return strtr($this->content, array_combine(
            array_map(function ($from) { return "[{$from}]"; }, array_keys($replacements)),
            array_values($replacements)
        ));
    }

    /**
     * Get the select input data.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getSelectInputData()
    {
        $pages = Page::all(); // TODO: Cache the data ??

        return $pages->pluck('name', 'id')
            ->prepend('-- Select a page --', 0);
    }
}
