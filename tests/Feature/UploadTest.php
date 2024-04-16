<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadTest extends TestCase
{
    function test_upload_should_not_fail()
    {
        Storage::fake('local');

        $this->post('/upload', [
            'file' => UploadedFile::fake()->image('test.png'),
        ])
            // ->dump()
            ->assertOk();

        Storage::disk('local')->assertExists('test.png');
    }

    function test_upload_should_fail()
    {
        $this->travelTo(now()->addMonth());
        Storage::fake('local');
        $this->post('/upload', [
            'file' => UploadedFile::fake()->image('test.png'),
        ])
            // ->dump()
            ->assertOk();

        Storage::disk('local')->assertExists('test.png');
    }
}
