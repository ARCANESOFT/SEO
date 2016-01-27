<?php namespace Arcanesoft\Seo\Tests\Http\Middleware;

use Arcanesoft\Seo\Tests\TestCase;

/**
 * Class     SeoSpamBlockerMiddlewareTest
 *
 * @package  Arcanesoft\Seo\Tests\Http\Middleware
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoSpamBlockerMiddlewareTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_accept_valid_referral()
    {
        $this->callReferer('http://www.google.com');

        $this->assertResponseOk();
    }

    /** @test */
    public function it_can_deny_a_spammer_referral()
    {
        $this->callReferer("http://0n-line.tv");

        $this->assertResponseStatus(401);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * @param  string  $referer
     * @param  string  $url
     * @param  string  $method
     */
    private function callReferer($referer, $url = '/', $method = 'GET')
    {
        $this->call($method, $url, [], [], [], [
            'HTTP_REFERER' => $referer,
        ]);
    }
}
