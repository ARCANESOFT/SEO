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
            'name'            => ['required'],
            'localization'    => ['required'],
            'uri'             => ['required', $this->getUniqueUriRule()->ignore($footer->id)],
            'locale'          => $this->getLocaleRule(),
            'page'            => $this->getPageRule(),
            'seo_title'       => ['required'],
            'seo_description' => ['required'],
            'seo_keywords'    => ['required', 'array', 'min:1'],
        ];
    }
}
