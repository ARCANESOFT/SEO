<?php namespace Arcanesoft\Seo\Http\Requests\Admin\Pages;

use Arcanesoft\Seo\Http\Requests\Admin\FormRequest;

/**
 * Class     PageFormRequest
 *
 * @package  Arcanesoft\Seo\Http\Requests\Admin\Pages
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class PageFormRequest extends FormRequest
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
        return $this->only(['name', 'locale', 'content']);
    }
}
