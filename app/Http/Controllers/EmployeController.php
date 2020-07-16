<?php

namespace App\Http\Controllers;

use App\Employe;
use App\Sellpoint;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeController extends Controller
{
    private function valid(array $data, $withImage = true){

        $messages = [
            'required' => 'Ce champs est requis.',
            'min' => 'Un minimun de :min caractères est requis pour ce champs.',
            'regex' => 'Mauvais format du champs',
            'image' => 'Charger une image',
            'mimes' => 'Charger l\'image dans un format jpg,jpeg ou png',
            'max' => 'La taille de l\'image ne doit pas depasser 1Mo',
            'numeric' => 'Ce champs doit contenir uniquement des chiffes',
            'unique' => 'Cet e-mail est déjà été utilisé',
            'email' => 'Entrer une bonne adresse email'
        ];

        return Validator::make($data, [
            'name' => 'required|regex:/^[a-z][a-z0-9 \-]+/i|min:3',
            'lastname' => 'required|regex:/^[a-z][a-z0-9 \-]+/i|min:3',
            'sex' => 'required',
            'contact' => 'required|regex:/^\([0-9]{3}\) [0-9]{2}(\-[0-9]{3}){2}/i',
            'role' => 'required',
            'email' => 'required|email|unique:users',
            'picture' => $withImage ? 'image|mimes:jpg,jpeg,png|max:1000' : 'nullable',
            'sellpoint_id' => 'required|numeric'
        ], $messages);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employes = User::where('level', '=', 0)->get();
        return view('owners.employees.all', compact('employes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sellpoints = Sellpoint::all();
        return view('owners.employees.create', compact('sellpoints'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $existImage = $request->file('picture') ? true : false;

        $validator = $this->valid($request->all(), $existImage);

        if ($validator->fails()) {
            return redirect()
                ->route('employe.create')
                ->withErrors($validator)
                ->withInput();
        }

        $parts = explode('@', $request->get('email'));
        $username = $parts[0];
        $uValid = Validator::make(['username' => $username], ['username' => 'alpha_num|unique:users',]);
        $i = 0;
        while ($uValid->fails()) {
            $username = $username . $i;
            $uValid = Validator::make(['username' => $username], ['username' => 'alpha_num|unique:users',]);
            $i++;
        }

        if ($existImage) {
            $path = $request->file('picture')->store('public/img/profil/'.$username);
        }

        $employe = new Employe();

        $employe->name = ucwords($request->get('name'));
        $employe->lastname = ucwords($request->get('lastname'));
        $employe->sex = $request->get('sex');
        $employe->contact = $request->get('contact');
        $employe->email = $request->get('email');
        $employe->username = $username;
        $employe->picture = $existImage ? $path : null;
        $employe->password = Hash::make('stockgestion');

        if ($request->get('role') !== 'admin') {
            $sellpoint = Sellpoint::find($request->get('sellpoint_id'));
            $employe->sellpoint()->associate($sellpoint);
        } else {
            $employe->level = 1;
        }

        $employe->save();

        $user = User::find($employe->id);

        $user->assignRole($request->get('role'));

        if ($request->get('role') === 'admin') {
            $role = 'L\'administrateur';
        } elseif ($request->get('role') === 'manager') {
            $role = 'Le manager de';
        } else {
            $role = 'Le vendeur';
        }

        return redirect()->route('employe.create')->with(['success' => true, 'name' => $employe->name, 'lastname' => $employe->lastname, 'email' => $employe->email, 'password' => 'stockgestion', 'role' => $role]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
