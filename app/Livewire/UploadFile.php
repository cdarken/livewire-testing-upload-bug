<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFile extends Component
{
    use WithFileUploads;

    public $file;

    public function send()
    {
        $validated = $this->validate([
            'file' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $file = $validated['file'];
        Storage::disk('local')->put($file->getClientOriginalName(), $file->getContent());
    }

    public function render()
    {
        return view('livewire.upload-file');
    }
}
