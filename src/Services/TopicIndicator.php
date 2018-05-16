<?php

namespace App\Services;

/**
 * Simple natural text processor, that tries to determine main themes in the text
 */
class TopicIndicator
{
    const TOPIC_UNKNOWN = 'topic_unknown';
    const TOPIC_QUESTION = 'topic_question';
    const TOPIC_ANGRY = 'topic_angry';
    const TOPIC_BUY = 'topic_buy';

    private $questionIdentifiers = ['why', 'how', 'when', 'can'];
    private $angryIdentifiers = ['failed', 'error', 'fault', ''];
    private $buy = ['buy', 'details', 'discount', 'price', 'stock'];

    public function getTopic($text)
    {
        $indexes = [
            self::TOPIC_BUY => 0,
            self::TOPIC_ANGRY => 0,
            self::TOPIC_QUESTION => 0,
        ];
        $words = preg_split('/((^\p{P}+)|(\p{P}*\s+\p{P}*)|(\p{P}+$))/', strtolower($text), -1, PREG_SPLIT_NO_EMPTY);
        foreach ($words as $word) {
            if (in_array($word, $this->questionIdentifiers)) {
                $indexes[self::TOPIC_QUESTION]++;
            }
            if (in_array($word, $this->angryIdentifiers)) {
                $indexes[self::TOPIC_ANGRY]++;
            }
            if (in_array($word, $this->buy)) {
                $indexes[self::TOPIC_BUY]++;
            }
        }
        if (strpos($text, '?') && $indexes[self::TOPIC_BUY] == 0) {
            $indexes[self::TOPIC_QUESTION]++;
        }
        if (strpos($text, '!')) {
            $indexes[self::TOPIC_ANGRY]++;
        }

        asort($indexes);
        $value = end($indexes);
        $best = key($indexes);

        if ($value <= 0) {
            return self::TOPIC_UNKNOWN;
        }

        return $best;
    }
}
