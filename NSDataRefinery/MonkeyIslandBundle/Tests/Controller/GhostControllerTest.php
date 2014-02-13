<?php

namespace NSDataRefinery\MonkeyIslandBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GhostControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/ghosts');

        $this->assertTrue($crawler->filter('json:contains("name")')->count() > 0);
    }
}
