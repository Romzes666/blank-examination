<?php

class AutoChecking
{
    function fullMatch($score, $answer, &$standart)
    {
        $mistakes = 0;
        foreach ($standart as $item) {
            if (mb_strtoupper($answer) === mb_strtoupper($item))
                return $mistakes;
        }
        $mistakes = $score;
        return $mistakes;
    }

    function orderImportant($score, $answer, $standart)
    {
        $mistakes = 0;
        if (mb_strtoupper($standart) === mb_strtoupper($answer))
            return $mistakes;
        $standartLength = mb_strlen(($standart));
        $answerLength = mb_strlen(($answer));
        if ($standartLength >= $answerLength) {
            for ($i = 0; $i < $standartLength; $i++) {
                if (
                  mb_strtoupper(mb_substr($standart, $i, 1, 'utf-8')) !==
                  mb_strtoupper(mb_substr($answer, $i, 1, 'utf-8'))
                ) {
                    $mistakes++;
                }
            }
        } else {
            for ($i = 0; $i < $answerLength; $i++) {
                if (
                  mb_strtoupper(mb_substr($answer, $i, 1, 'utf-8')) !==
                  mb_strtoupper(mb_substr($standart, $i, 1, 'utf-8'))
                ) {
                    $mistakes++;
                }
            }
        }
        if ($mistakes > $score)
            $mistakes = $score;
        return $mistakes;
    }

    function orderUnImportant($score, $answer, $standart)
    {
        $mistakes = 0;
        if (mb_strtoupper($standart) === mb_strtoupper($answer))
            return $mistakes;
        $standart = preg_split('//u', mb_strtoupper($standart), -1, PREG_SPLIT_NO_EMPTY);
        $answer = preg_split('//u', mb_strtoupper($answer), -1, PREG_SPLIT_NO_EMPTY);
        $standartCount = count($standart);
        $answerCount = count($answer);
        if ($standartCount > $answerCount) {
            while ($standartCount > $answerCount) {
                array_unshift($answer, 'x');
                $answerCount++;
            }
        }
        if ($standartCount < $answerCount) {
            $mistakes += $answerCount - $standartCount;
            for ($i = $standartCount; $i < $answerCount; $i++) {
                $answer[$i] = 'x';
            }
        }
        $result = array_diff($standart, $answer);
        $mistakes += count($result);
        if ($mistakes > $score)
            $mistakes = $score;
        return $mistakes;
    }
}
