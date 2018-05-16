<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FeedbackControllerTest extends WebTestCase
{
    public function testTalkBoxIsOnHomePage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('#feedback-form textarea')->count());
        $this->assertSame("Send", $crawler->filter('#feedback-form button[type=submit]')->first()->text());
    }

    /**
     * @dataProvider providerFeedbackMessages
     */
    public function testFeedbackMessage($inputMessage, $expectedReply)
    {
        $client = static::createClient();

        // Enter feedback message
        $homePage = $client->request('GET', '/');
        $feedBackForm = $homePage->filter('#feedback-form')->selectButton("Send")->form();
        $feedBackForm['feedback_form[message]'] = $inputMessage;
        $client->submit($feedBackForm);

        // No JavaScript support, so checking redirect manually
        $this->assertContains('Redirecting...', $client->getResponse()->getContent());
        $redirectPage = $client->getCrawler();
        $link = $redirectPage->filter('.acte-feedback-results a.acte-redirect')->link();
        $client->click($link);

        // Check rendered output
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $conversationPage = $client->getCrawler();
        $questionBalloon = $conversationPage->filter('.feedback-results .question')->text();
        $answerBalloon = $conversationPage->filter('.feedback-results .answer')->text();
        $this->assertEquals(trim($inputMessage), trim($questionBalloon), 'Can see input message');
        $this->assertEquals(trim($answerBalloon), trim($expectedReply), 'Can see tailored answer');
    }

    public function providerFeedbackMessages()
    {
        return [
            'buy' => [
                'I want to buy product A, can I get some discount if I am buying two items?',
                'Thank you for your feedback. Call our sales +370 37 793 515 and get the best deal.'
            ],
            'angry' => [
                'My order failed, I saw error message: I cannot deliver to your location' ,
                'We understand how you feel and will try to go back to you as soon as possible'
            ],
            'question' => [
                'I found product A, but what is usual battery life?',
                'Thank you for your input. Do not forget to leave your contact details and we will answer all your questions.'
            ],
            'unknown' => [
                'Just testing your system',
                'Thank you for your feedback.'
            ],
        ];
    }
}
