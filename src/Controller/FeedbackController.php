<?php

namespace App\Controller;

use App\Entity\FeedbackMessage;
use App\Form\FeedbackForm;
use App\Services\TopicIndicator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class FeedbackController extends Controller
{
    const LAST_FEEDBACK_MESSAGE = 'last_feedback_message';

    public function form(Request $request, Session $session, UrlGeneratorInterface $router)
    {
        $feedback = new FeedbackMessage();
        $form = $this->createForm(FeedbackForm::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var FeedbackMessage $feedback */
            $feedback = $form->getData();

            // For simplicity – using session as storage.
            // In the future Database/Files would be better approach
            $session->set(self::LAST_FEEDBACK_MESSAGE, $feedback->getMessage());

            return $this->render('feedback/redirect.html.twig', [
                'url' => $router->generate('feedback_conversation')
            ]);
        }

        return $this->render('feedback/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/feedback/conversation", name="feedback_conversation")
     */
    public function conversation(Session $session, TopicIndicator $indicator)
    {
        $message = $session->get(self::LAST_FEEDBACK_MESSAGE, '');
        return $this->render('feedback/results.html.twig', [
            'feedback' => $message,
            'topic' => $indicator->getTopic($message),
        ]);
    }
}
