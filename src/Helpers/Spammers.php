<?php namespace Arcanesoft\Seo\Helpers;

use Illuminate\Http\Request;

/**
 * Class     Spammers
 *
 * @package  Arcanesoft\Seo\Helpers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Spammers
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * List of referrer spammers.
     *
     * @var array
     */
    protected $referrals = [];

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Spammers constructor.
     *
     * @param  array  $configs
     */
    public function __construct(array $configs)
    {
        $this->loadReferrals($configs);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the list of spammers.
     *
     * @return array
     */
    public function getReferrals()
    {
        return $this->referrals;
    }

    /**
     * Set the list of spammers.
     *
     * @param  array  $referrals
     *
     * @return $this
     */
    public function setReferrals(array $referrals)
    {
        $this->referrals = $referrals;

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check if a request is a referer spam.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return bool
     */
    public function isSpamRequest(Request $request)
    {
        $referer = parse_url($request->headers->get('referer'), PHP_URL_HOST);

        return $this->isSpam($referer);
    }

    /**
     * Check if referer is a spam.
     *
     * @param  string  $referer
     *
     * @return bool
     */
    public function isSpam($referer)
    {
        return in_array(
            preg_replace('/(www\.)/i', '', $referer),
            $this->getReferrals()
        );
    }

    /**
     * Load the referral spammers.
     *
     * @param  array  $configs
     */
    private function loadReferrals(array $configs)
    {
        $referrals = [];

        switch (array_get($configs, 'driver', 'array')) {
            case 'database':
                $referrals = [];
                break;

            case 'array':
                $referrals = array_get($configs, 'sources.array', []);
                break;
        }

        $this->setReferrals($referrals);
    }
}
