<?php

use App\Services\MathCaptchaService;

test('generate stores sum in session and returns question array', function () {
    $service = new MathCaptchaService;
    $data = $service->generate();

    expect($data)->toHaveKeys(['question', 'num1', 'num2', 'result']);
    expect($data['result'])->toBe($data['num1'] + $data['num2']);
    expect(session(MathCaptchaService::SESSION_KEY))->toBe($data['result']);
});

test('validate succeeds with correct answer and clears session', function () {
    $service = new MathCaptchaService;
    session()->put(MathCaptchaService::SESSION_KEY, 15);

    expect($service->validate('15'))->toBeTrue();
    expect(session(MathCaptchaService::SESSION_KEY))->toBeNull();
});

test('validate fails with wrong answer and clears session', function () {
    $service = new MathCaptchaService;
    session()->put(MathCaptchaService::SESSION_KEY, 15);

    expect($service->validate('12'))->toBeFalse();
    expect(session(MathCaptchaService::SESSION_KEY))->toBeNull();
});

test('validate fails when answer is null or empty', function () {
    $service = new MathCaptchaService;
    session()->put(MathCaptchaService::SESSION_KEY, 15);

    expect($service->validate(null))->toBeFalse();
    expect($service->validate(''))->toBeFalse();
});
