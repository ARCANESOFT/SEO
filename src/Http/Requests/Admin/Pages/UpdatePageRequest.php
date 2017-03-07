<?php namespace Arcanesoft\Seo\Http\Requests\Admin\Pages;

/**
 * Class     UpdatePageRequest
 *
 * @package  Arcanesoft\Seo\Http\Requests\Admin\Pages
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdatePageRequest extends PageFormRequest
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
            'name'    => ['required'],
            'locale'  => $this->getLocaleRule(),
            'content' => ['required']
        ];
    }
}
