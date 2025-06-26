<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Video;
use Livewire\WithFileUploads;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Log;

class Edit extends Component
{
    use WithFileUploads;

    public $videoId;
    public $title;
    public $description;
    public $status;
    public $path;
    public $newVideo;
    public $video;

    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.edit');
    }

    public function mount($id)
    {
        $this->video = Video::findOrFail($id);

        // Populate fields
        $this->videoId = $this->video->id;
        $this->title = $this->video->title;
        $this->description = $this->video->description;
        $this->status = $this->video->status;
        $this->path = $this->video->path;
    }

    public function update()
    {

        $this->validate([
            'newVideo' => 'nullable|file|mimes:mp4,mov,avi,flv,wmv|max:512000', // 500 MB
        ]);

        $videoFileName = $this->newVideo->getClientOriginalName();

        $path = $this->newVideo->storeAs('videos', $videoFileName, 'public');

        // delete old if needed
            // \Storage::disk('public')->delete(str_replace('storage/', '', $this->video->path));

        $this->video->update([
                'path'   => 'storage/'.$path,
                'status' => 'proccess',
        ]);

        session()->flash('success', 'Video replaced & status set to process.');
        return redirect()->route('admin.video.index');
    }
}
