<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\{Video, VideoComment};
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $videos;

    public $editing = false;
    public $editId = null;
    public $editDescription = '';

    public $confirmingDone = false;
    public $doneId = null;

    #[Layout('components.layouts.customer.app')]
    public function render()
    {
        $this->videos = Video::where('user_id', Auth::id())->latest()->get();

        return view('livewire.customer.index', [
            'videos' => $this->videos,
        ]);
    }

    public function openEditModal($id)
    {
        $video = Video::findOrFail($id);
        $this->editId = $video->id;
        $this->editDescription = $video->description;
        $this->editing = true;
    }

    public function cancelEdit()
    {
        $this->editing = false;
        $this->editId = null;
        $this->editDescription = '';
    }

    public function updateVideo()
    {
        $this->validate([
            'editDescription' => 'required|string|max:1000',
        ]);

        $video = VideoComment::updateOrCreate(
            [
                'video_id' => $this->editId,
                'user_id'  => Auth::id(),
            ],
            [
                'comment' => $this->editDescription,
            ]
        );

        Video::where('id', $this->editId)
            ->where('user_id', Auth::id())
            ->update([
                'status' => 'proccess',
        ]);


        $this->editing = false;
        $this->editId = null;
        $this->editDescription = '';

        session()->flash('message', 'Video updated successfully.');
        return redirect()->route('customer.index');
    }

    public function confirmDone($id)
    {
        $this->confirmingDone = true;
        $this->doneId = $id;
    }

    public function cancelDone()
    {
        $this->confirmingDone = false;
        $this->doneId = null;
    }

    public function markAsDone()
    {
        Video::where('id', $this->doneId)
            ->where('user_id', Auth::id())
            ->update([
                'status' => 'approved',
            ]);

        $this->confirmingDone = false;
        $this->doneId = null;

        session()->flash('message', 'Video marked as approved.');
        return redirect()->route('customer.index');
    }

}
