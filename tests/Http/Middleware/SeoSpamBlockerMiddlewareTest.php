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
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_accept_valid_referral()
    {
        $response = $this->callReferer('http://www.google.com');

        $response->assertSuccessful();
    }

    /** @test */
    public function it_can_deny_a_spammer_referral()
    {
        $response = $this->callReferer("http://0n-line.tv");

        $response->assertStatus(401);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  string  $referer
     * @param  string  $url
     * @param  string  $method
     *
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function callReferer($referer, $url = '/', $method = 'GET')
    {
        return $this->call($method, $url, [], [], [], [
            'HTTP_REFERER' => $referer,
        ]);
    }
}
