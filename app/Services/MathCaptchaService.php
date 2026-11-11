<?php

namespace App\Services;

class MathCaptchaService
{
    public const SESSION_KEY = 'math_captcha_results';

    /**
     * Generate a new math challenge and store the answer in session.
     * Supports multiple open tabs by preserving recent valid answers.
     *
     * @return array{question: string, num1: int, num2: int, result: int}
     */
    public function generate(): array
    {
        $num1 = random_int(1, 10);
        $num2 = random_int(1, 10);
        $result = $num1 + $num2;

        $existing = session()->get(self::SESSION_KEY, []);
        if (! is_array($existing)) {
            $existing = [];
        }

        $existing[] = $result;
        // Keep up to 5 recent challenges across multiple tabs
        session()->put(self::SESSION_KEY, array_values(array_slice($existing, -5)));

        return [
            'question' => "{$num1} + {$num2}",
            'num1' => $num1,
            'num2' => $num2,
            'result' => $result,
        ];
    }

    /**
     * Validate user answer against the session values and flush the matching answer.
     */
    public function validate(mixed $answer): bool
    {
        if ($answer === null || is_array($answer) || is_object($answer)) {
            return false;
        }

        $answerStr = is_scalar($answer) ? trim((string) $answer) : '';

        // Strict digit check prevents trailing non-numeric values like "10abc"
        if ($answerStr === '' || ! ctype_digit($answerStr)) {
            return false;
        }

        $submitted = (int) $answerStr;
        $validAnswers = session()->get(self::SESSION_KEY, []);

        if (! is_array($validAnswers)) {
            $validAnswers = $validAnswers !== null ? [$validAnswers] : [];
        }

        if (empty($validAnswers)) {
            $single = session()->pull('math_captcha_result');
            if ($single !== null) {
                return $submitted === (int) $single;
            }

            return false;
        }

        $index = array_search($submitted, $validAnswers, true);
        if ($index === false) {
            session()->forget(self::SESSION_KEY);

            return false;
        }

        unset($validAnswers[$index]);
        session()->put(self::SESSION_KEY, array_values($validAnswers));

        return true;
    }
}
