<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user_add');
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user_show');
    }

}
