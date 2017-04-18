<?php namespace Arcanesoft\Seo\Http\Requests\Admin\Footers;

/**
 * Class     UpdateFooterRequest
 *
 * @package  Arcanesoft\Seo\Http\Requests\Admin\Footers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdateFooterRequest extends FooterFormRequest
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $footer = $this->route('seo_footer');

        return [
            // Footer Rules
            'name'            => ['required', 'string'],
            'localization'    => ['required', 'string'],
            'uri'             => ['required', 'string', $this->getUniqueUriRule()->ignore($footer->id)],
            'locale'          => $this->getLocaleRule(),
            'page'            => $this->getPageRule(),
            // SEO Rules
            'seo_title'       => ['required', 'string'],
            'seo_description' => ['required', 'string'],
            'seo_keywords'    => ['required', 'array', 'min:1'],
        ];
    }
}
