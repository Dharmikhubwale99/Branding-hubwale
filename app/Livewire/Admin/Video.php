<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\{User, Video as VideoModel};

class Video extends Component
{
    use WithFileUploads;

    public $user, $video, $description;

    public $data = [
        'users' => [],
    ];

    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.video');
    }

    public function mount()
    {
        $this->data['users'] = User::role('customer')
            ->pluck('name', 'id')
            ->toArray();
    }

    public function submit()
    {
        $this->validate([
            'user' => 'required|exists:users,id',
            'video' => 'required|file|mimes:mp4,mov,avi,flv,wmv',
            'description' => 'nullable|string|max:1000',
        ]);

        $videoFileName = $this->video->getClientOriginalName();

        $path = $this->video->storeAs('videos', $videoFileName, 'public');

        $video = VideoModel::create([
            'user_id'     => $this->user,
            'title'       => $videoFileName,
            'description' => $this->description,
            'status'      => 'pending',
            'approved_at' => null,
            'path'        => 'storage/' . $path, // Save relative public URL
        ]);

        session()->flash('message', 'Video uploaded successfully.');
        return redirect()->route('admin.video');
    }
}
