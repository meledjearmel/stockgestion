<?php

namespace App\Http\Livewire;

use App\Sellpoint;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEmploye extends Component
{
    use WithFileUploads;

    public $name;
    public $lastname;
    public $sex;
    public $contact;
    public $email;
    public $username;
    public $picture;

    protected $rules = [
        'name' => 'required|regex:/^[a-z][a-z ]+/i|min:3',
        'lastname' => 'required|regex:/^[a-z][a-z ]+/i|min:3',
        'sex' => 'required',
        'contact' => 'required|regex:/^\([0-9]{3}\) [0-9]{2}(\-[0-9]{3}){2}/i',
        'email' => 'required|email|unique:users',
    ];

    protected $messages = [
        'required' => 'Ce champs est requis.',
        'min' => 'Un minimun de :min caractères est requis pour ce champs.',
        'regex' => 'Mauvais format du champs',
        'image' => 'Charger une image',
        'mimes' => 'Charger l\'image dans un format jpg,jpeg ou png',
        'max' => 'La taille de l\'image ne doit pas depasser 1Mo',
        'numeric' => 'Ce champs doit contenir uniquement des chiffes',
        'unique' => 'Cet e-mail est déjà utilisé',
        'email' => 'Entrer une bonne adresse email',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedPicture()
    {
        $this->validate([
            'picture' => 'image|mimes:jpg,jpeg,png|max:1024',
        ]);
    }

    public function render()
    {
        $sellpoints = Sellpoint::all();
        return view('livewire.create-employe', compact('sellpoints'));
    }
}
