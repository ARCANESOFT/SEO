<?php namespace Arcanesoft\Seo\Http\Requests\Admin\Footers;

use Arcanesoft\Seo\Http\Requests\Admin\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class     FooterFormRequest
 *
 * @package  Arcanesoft\Seo\Http\Requests\Admin\Footers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class FooterFormRequest extends FormRequest
{
    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the validated inputs.
     *
     * @return array
     */
    public function getValidatedInputs()
    {
        return $this->only([
            // Footer inputs
            'name', 'localization', 'uri', 'locale', 'page',
            // SEO Metas inputs
            'seo_title', 'seo_description', 'seo_keywords',
        ]);
    }

    /**
     * Get the page validation rule.
     *
     * @return array
     */
    protected function getPageRule()
    {
        $existsRule = Rule::exists($this->getTablePrefix().'pages', 'id');

        if ($this->has('locale'))
            $existsRule = $existsRule->where('locale', $this->get('locale', config('app.locale')));

        return ['required', 'integer', $existsRule];
    }

    /**
     * Get unique URI Rule.
     *
     * @return \Illuminate\Validation\Rules\Unique
     */
    protected function getUniqueUriRule()
    {
        return Rule::unique($this->getTablePrefix().'footers', 'uri');
    }
}
