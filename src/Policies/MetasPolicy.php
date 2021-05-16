<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Policies;

use Arcanesoft\Foundation\Authorization\Models\Administrator;
use Arcanesoft\Seo\Models\Meta;

/**
 * Class     MetasPolicy
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetasPolicy extends Policy
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
        return 'admin::seo.metas.';
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
            'category' => 'Metas',
        ]);

        return [

            // admin::seo.metas.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the metas',
                'description' => 'Ability to list all the metas',
            ]),

            // admin::seo.metas.metrics
            $this->makeAbility('metrics')->setMetas([
                'name'        => "List all the metas' metrics",
                'description' => "Ability to list all the metas' metrics",
            ]),

            // admin::seo.metas.create
            $this->makeAbility('create')->setMetas([
                'name'        => 'Create a new meta',
                'description' => 'Ability to create a new meta',
            ]),

            // admin::seo.metas.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show a meta',
                'description' => "Ability to show the meta's details",
            ]),

            // admin::seo.metas.update
            $this->makeAbility('update')->setMetas([
                'name'        => 'Update a meta',
                'description' => 'Ability to update a meta',
            ]),

            // admin::seo.metas.delete
            $this->makeAbility('delete')->setMetas([
                'name'        => 'Delete a meta',
                'description' => 'Ability to delete a meta',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the metas.
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
     * Allow to list all the metas' metrics.
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
     * Allow to create a meta.
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
     * Allow to show a meta details.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Seo\Models\Meta|mixed|null                           $meta
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(Administrator $administrator, Meta $meta = null)
    {
        //
    }

    /**
     * Allow to update a meta.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Seo\Models\Meta|mixed|null                           $meta
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function update(Administrator $administrator, Meta $meta = null)
    {
        //
    }

    /**
     * Allow to delete a meta.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Seo\Models\Meta|mixed|null                           $meta
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function delete(Administrator $administrator, Meta $meta = null)
    {
        if ( ! is_null($meta))
            return $meta->isDeletable();
    }
}
