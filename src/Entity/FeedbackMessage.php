<?php

namespace App\Entity;

/**
 * Feedback message for TalkBox
 */
class FeedbackMessage
{
    /**
     * @var string
     */
    private $message;

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
