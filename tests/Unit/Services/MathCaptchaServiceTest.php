<?php

use App\Services\MathCaptchaService;

test('generate stores sum in session array and returns question array', function () {
    $service = new MathCaptchaService;
    $data = $service->generate();

    expect($data)->toHaveKeys(['question', 'num1', 'num2', 'result']);
    expect($data['result'])->toBe($data['num1'] + $data['num2']);
    expect(session(MathCaptchaService::SESSION_KEY))->toContain($data['result']);
});

test('generate preserves multiple challenges for multi-tab support', function () {
    $service = new MathCaptchaService;
    $challenge1 = $service->generate();
    $challenge2 = $service->generate();

    expect(session(MathCaptchaService::SESSION_KEY))->toContain($challenge1['result']);
    expect(session(MathCaptchaService::SESSION_KEY))->toContain($challenge2['result']);

    // Validating first tab challenge works
    expect($service->validate((string) $challenge1['result']))->toBeTrue();
    // Second tab challenge is still valid
    expect($service->validate((string) $challenge2['result']))->toBeTrue();
});

test('validate succeeds with correct answer and flushes used answer', function () {
    $service = new MathCaptchaService;
    session()->put(MathCaptchaService::SESSION_KEY, [15]);

    expect($service->validate('15'))->toBeTrue();
    expect(session(MathCaptchaService::SESSION_KEY))->toBeEmpty();
});

test('validate fails with wrong answer and flushes session', function () {
    $service = new MathCaptchaService;
    session()->put(MathCaptchaService::SESSION_KEY, [15]);

    expect($service->validate('12'))->toBeFalse();
    expect(session(MathCaptchaService::SESSION_KEY))->toBeNull();
});

test('validate fails when answer contains non-digits such as 15abc', function () {
    $service = new MathCaptchaService;
    session()->put(MathCaptchaService::SESSION_KEY, [15]);

    expect($service->validate('15abc'))->toBeFalse();
});

test('validate fails when answer is null or empty or array', function () {
    $service = new MathCaptchaService;
    session()->put(MathCaptchaService::SESSION_KEY, [15]);

    expect($service->validate(null))->toBeFalse();
    expect($service->validate(''))->toBeFalse();
    expect($service->validate(['15']))->toBeFalse();
});
