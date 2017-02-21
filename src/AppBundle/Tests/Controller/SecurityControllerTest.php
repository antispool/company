<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isSuccessful());
        $form = $crawler->selectButton('Sign in')->form();

        $form['_username']->setValue('admin');
        $form['_password']->setValue('admin');

        $client->followRedirects();
        $crawler = $client->submit($form);

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertNotNull($client->getRequest()->cookies->get('jwt'));
    }
}
