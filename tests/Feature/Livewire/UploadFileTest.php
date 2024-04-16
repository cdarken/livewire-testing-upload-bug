<?php

namespace Tests\Feature\Livewire;

use App\Livewire\UploadFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class UploadFileTest extends TestCase
{
    function test_upload_file()
    {
        Storage::fake('local');
        Livewire::test(UploadFile::class)
            ->set('file', UploadedFile::fake()->image('test.png'))
            ->call('send')
            ->assertOk();
        Storage::disk('local')->assertExists('test.png');
    }

    function test_upload_file_fail()
    {
        Storage::fake('local');
        $this->travelTo(now()->addMonth());
        Livewire::test(UploadFile::class)
            ->set('file', UploadedFile::fake()->image('test.png'))
            ->call('send')
            // ->dump()
            ->assertHasErrors();

        Storage::disk('local')->assertMissing('test.png');
    }
}
