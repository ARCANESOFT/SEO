<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Policies;

use Arcanesoft\Foundation\Authorization\Models\Administrator;
use Arcanesoft\Seo\Models\Footer;

/**
 * Class     FootersPolicy
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FootersPolicy extends Policy
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Get the ability's prefix.
     *
     * @return string
     */
    protected static function prefix(): string
    {
        return 'admin::seo.footers.';
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's abilities.
     *
     * @return \Arcanedev\LaravelPolicies\Ability[]|iterable
     */
    public function abilities(): iterable
    {
        $this->setMetas([
            'category' => 'Footers',
        ]);

        return [

            // admin::seo.footers.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the footers',
                'description' => 'Ability to list all the footers',
            ]),

            // admin::seo.footers.metrics
            $this->makeAbility('metrics')->setMetas([
                'name'        => "List all the footers' metrics",
                'description' => "Ability to list all the footers' metrics",
            ]),

            // admin::seo.footers.create
            $this->makeAbility('create')->setMetas([
                'name'        => 'Create a new footer',
                'description' => 'Ability to create a new footer',
            ]),

            // admin::seo.footers.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show a footer',
                'description' => "Ability to show the footer's details",
            ]),

            // admin::seo.footers.update
            $this->makeAbility('update')->setMetas([
                'name'        => 'Update a footer',
                'description' => 'Ability to update a footer',
            ]),

            // admin::seo.footers.delete
            $this->makeAbility('delete')->setMetas([
                'name'        => 'Delete a footer',
                'description' => 'Ability to delete a footer',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the footers.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function index(Administrator $administrator)
    {
        //
    }

    /**
     * Allow to list all the footers' metrics.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function metrics(Administrator $administrator)
    {
        //
    }

    /**
     * Allow to create a footer.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function create(Administrator $administrator)
    {
        //
    }

    /**
     * Allow to show a footer details.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Seo\Models\Footer|mixed|null                         $footer
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(Administrator $administrator, Footer $footer = null)
    {
        //
    }

    /**
     * Allow to update a footer.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Seo\Models\Footer|mixed|null                         $footer
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function update(Administrator $administrator, Footer $footer = null)
    {
        //
    }

    /**
     * Allow to delete a footer.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Seo\Models\Footer|mixed|null                         $footer
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function delete(Administrator $administrator, Footer $footer = null)
    {
        if ( ! is_null($footer))
            return $footer->isDeletable();
    }
}
