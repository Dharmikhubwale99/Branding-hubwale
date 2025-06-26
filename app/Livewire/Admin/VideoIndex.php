<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Video;
use Livewire\Attributes\Layout;

class VideoIndex extends Component
{
    public $videos;

    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.video-index');
    }

    public function mount()
    {
        $this->videos = Video::with(['user', 'comments'])->latest()->get();
    }

}
