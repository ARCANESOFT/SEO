<?php namespace Arcanesoft\Seo\Helpers;

/**
 * Class     SeoChecker
 *
 * @package  Arcanesoft\Seo\Helpers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoChecker
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */
    const STATUS_DANGER  = 'danger';
    const STATUS_GOOD    = 'good';
    const STATUS_WARNING = 'warning';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Check the title content.
     *
     * @param  string  $title
     * @param  int     $min
     * @param  int     $max
     *
     * @return string
     */
    public static function checkTitle($title, $min = 40, $max = 60)
    {
        return self::check($title, $min, $max);
    }

    /**
     * Check the description content.
     *
     * @param  string  $description
     * @param  int     $min
     * @param  int     $max
     *
     * @return string
     */
    public static function checkDescription($description, $min = 140, $max = 160)
    {
        return self::check($description, $min, $max);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */
    /**
     * Check the value with min & max length.
     *
     * @param  string  $value
     * @param  int     $min
     * @param  int     $max
     *
     * @return string
     */
    protected static function check($value, $min, $max)
    {
        $length = strlen($value);

        if ($length < $min)
            return self::STATUS_WARNING;

        if ($min <= $length && $length <= $max)
            return self::STATUS_GOOD;

        return self::STATUS_DANGER;
    }
}
