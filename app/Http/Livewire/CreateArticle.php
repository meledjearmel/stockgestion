<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class CreateArticle extends Component
{
    use WithFileUploads;

    public $showImage;

    public $photo;

    public $code;

    public $caracts;

    public $name;

    public $price;

    protected $messages = [
        'required' => 'Ce champs est requis.',
        'min' => 'Un minimun de :min caractères est requis pour ce champs.',
        'regex' => 'Mauvais format du champs',
        'size' => 'Le code doit faire exactement :size caractères',
        'image' => 'Charger une image',
        'mimes' => 'Charger l\'image dans un format jpg,jpeg ou png',
        'max' => 'La taille de l\'image ne doit pas depasser 1Mo',
        'numeric' => 'Ce champs doit contenir uniquement des chiffes',
        'unique' => 'Le code a déjà été utilisé pour un article',
    ];

    protected $rules = [
        'name' => 'required|regex:/^[a-z][a-z0-9 \-]+/i|min:3',
        'caracts' => 'nullable|regex:/^[a-z][a-z0-9 \-,]+/i|min:3',
        'price' => 'required|numeric|min:1',
        'code' => 'unique:App\Article,code|required|alpha_num|size:8|'
    ];

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|mimes:jpg,jpeg,png|max:1024',
        ]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {

    }

    public function render()
    {
        return view('livewire.create-article');
    }
}
