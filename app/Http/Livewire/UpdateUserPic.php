<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateUserPic extends Component
{
    use WithFileUploads;

    public $picture;

    public function updatedPicture()
    {
        $this->validate([
            'picture' => 'image|mimes:jpg,jpeg,png|max:1024',
        ]);
    }

    public function render()
    {
        return view('livewire.update-user-pic');
    }
}
