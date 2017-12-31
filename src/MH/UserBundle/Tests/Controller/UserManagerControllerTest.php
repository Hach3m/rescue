<?php

namespace MH\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserManagerControllerTest extends WebTestCase
{
    public function testVoiruser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/voirUser');
    }

    public function testModifieruser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/modifierUser');
    }

    public function testSupprimeruser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/supprimerUser');
    }

}
