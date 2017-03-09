<?php namespace Arcanesoft\Seo\Helpers;

use Illuminate\Support\Arr;

/**
 * Class     TextReplacer
 *
 * @package  Arcanesoft\Seo\Helpers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TextReplacer
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */
    /** @var array */
    protected $replacements;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */
    /**
     * TextReplacer constructor.
     *
     * @param  array  $replacements
     */
    public function __construct(array $replacements = [])
    {
        $this->replacements = $replacements;
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */
    /**
     * Get the replacements shortcodes.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getShortcodes()
    {
        $shortcodes = array_map(function ($replacement) {
            return "[{$replacement}]";
        }, $this->replacements);

        return collect(array_combine($shortcodes, $this->replacements));
    }

    /**
     * Get the replacements shortcodes keys.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getShortcodesKeys()
    {
        return $this->getShortcodes()->keys();
    }

    /**
     * Merge replacements.
     *
     * @param  array  $replacements
     *
     * @return \Illuminate\Support\Collection
     */
    protected function mergeReplacements(array $replacements)
    {
        return $this->getShortcodes()
            ->transform(function ($key) use ($replacements) {
                return Arr::get($replacements, $key);
            })
            ->filter();
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Make the instance.
     *
     * @param  array  $replacements
     *
     * @return static
     */
    public static function make(array $replacements = [])
    {
        return new static($replacements);
    }

    /**
     * Replace the content.
     *
     * @param  string  $content
     * @param  array   $replacements
     *
     * @return string
     */
    public function replace($content, array $replacements = [])
    {
        return strtr($content, $this->mergeReplacements($replacements)->toArray());
    }

    /**
     * Highlight the replacement.
     *
     * @param  string  $content
     * @param  string  $replacement
     *
     * @return string
     */
    public function highlight($content, $replacement = '<code>[\1]</code>')
    {
        return preg_replace(
            '/\[('.$this->getShortcodes()->values()->implode('|').')\]/',
            $replacement,
            $content
        );
    }
}
