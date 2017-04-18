<?php namespace Arcanesoft\Seo\Http\Requests\Admin\Footers;

/**
 * Class     CreateFooterRequest
 *
 * @package  Arcanesoft\Seo\Http\Requests\Admin\Footers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateFooterRequest extends FooterFormRequest
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
        return [
            // Footer Rules
            'name'            => ['required'],
            'localization'    => ['required'],
            'uri'             => ['required', $this->getUniqueUriRule()],
            'locale'          => $this->getLocaleRule(),
            'page'            => $this->getPageRule(),
            // SEO Rules
            'seo_title'       => ['required'],
            'seo_description' => ['required'],
            'seo_keywords'    => ['required', 'array', 'min:1'],
        ];
    }
}
