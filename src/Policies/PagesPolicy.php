<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Policies;

use Arcanesoft\Foundation\Authorization\Models\Administrator;
use Arcanesoft\Seo\Models\Page;

/**
 * Class     PagesPolicy
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PagesPolicy extends Policy
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
        return 'admin::seo.pages.';
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
            'category' => 'Pages',
        ]);

        return [

            // admin::seo.pages.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the pages',
                'description' => 'Ability to list all the pages',
            ]),

            // admin::seo.pages.metrics
            $this->makeAbility('metrics')->setMetas([
                'name'        => "List all the pages' metrics",
                'description' => "Ability to list all the pages' metrics",
            ]),

            // admin::seo.pages.create
            $this->makeAbility('create')->setMetas([
                'name'        => 'Create a new page',
                'description' => 'Ability to create a new page',
            ]),

            // admin::seo.pages.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show a page',
                'description' => "Ability to show the page's details",
            ]),

            // admin::seo.pages.update
            $this->makeAbility('update')->setMetas([
                'name'        => 'Update a page',
                'description' => 'Ability to update a page',
            ]),

            // admin::seo.pages.delete
            $this->makeAbility('delete')->setMetas([
                'name'        => 'Delete a page',
                'description' => 'Ability to delete a page',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the pages.
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
     * Allow to list all the pages' metrics.
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
     * Allow to create a page.
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
     * Allow to show a page details.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Seo\Models\Page|mixed|null                           $page
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(Administrator $administrator, Page $page = null)
    {
        //
    }

    /**
     * Allow to update a page.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Seo\Models\Page|mixed|null                           $page
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function update(Administrator $administrator, Page $page = null)
    {
        //
    }

    /**
     * Allow to delete a page.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Seo\Models\Page|mixed|null                           $page
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function delete(Administrator $administrator, Page $page = null)
    {
        if ( ! is_null($page))
            return $page->isDeletable();
    }
}
