<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class)->in('Feature', 'Unit');

uses(RefreshDatabase::class)->in('Feature');
