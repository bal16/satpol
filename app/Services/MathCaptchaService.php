<?php

namespace App\Services;

class MathCaptchaService
{
    public const SESSION_KEY = 'math_captcha_result';

    /**
     * Generate a new math challenge and store the answer in session.
     *
     * @return array{question: string, num1: int, num2: int, result: int}
     */
    public function generate(): array
    {
        $num1 = random_int(1, 10);
        $num2 = random_int(1, 10);
        $result = $num1 + $num2;

        session()->put(self::SESSION_KEY, $result);

        return [
            'question' => "{$num1} + {$num2}",
            'num1' => $num1,
            'num2' => $num2,
            'result' => $result,
        ];
    }

    /**
     * Validate user answer against the session value and flush it.
     */
    public function validate(?string $answer): bool
    {
        $expected = session()->pull(self::SESSION_KEY);

        if ($expected === null || $answer === null || trim($answer) === '') {
            return false;
        }

        return (int) trim($answer) === (int) $expected;
    }
}
