<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Rules;

use Illuminate\Validation\Rule;

/**
 * Class     MetaRule
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetaRule
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make the rule.
     *
     * @return static
     */
    public static function make(): MetaRule
    {
        return new static;
    }

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'basic'     => $this->basicRules(),
            'twitter'   => $this->twitterRules(),
            'openGraph' => $this->openGraphRules(),
        ];
    }

    /**
     * Get the [basic] metas rules.
     *
     * @return array
     */
    public function basicRules(): array
    {
        return [
            'title'       => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'keywords'    => ['nullable', 'string'],
        ];
    }

    /**
     * Get the [twitter] metas rules.
     *
     * @return array
     */
    protected function twitterRules(): array
    {
        return [
            'card'        => ['required', 'string', Rule::in(['summary', 'summary_large_image', 'app', 'player'])],
            'site'        => ['nullable', 'string'],
            'title'       => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'string'],
        ];
    }

    /**
     * Get the [open-graph] metas rules.
     *
     * @return array
     */
    protected function openGraphRules(): array
    {
        return [
            //
        ];
    }
}
