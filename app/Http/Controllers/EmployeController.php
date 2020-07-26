<?php

namespace App\Http\Controllers;

use App\Employe;
use App\Rules\OldPassword;
use App\Sellpoint;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EmployeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function adminCheck()
    {
        if(!Auth::user()->hasRole('admin')) {
           abort(403);
        }
    }

    private function valid(array $data, $withImage = true, $profil = false, $changePassword = false, $model = null, $accountSets = false){

        $messages = [
            'required' => 'Ce champs est requis.',
            'min' => 'Un minimun de :min caractères est requis pour ce champs.',
            'regex' => 'Mauvais format du champs',
            'image' => 'Charger une image',
            'mimes' => 'Charger l\'image dans un format jpg,jpeg ou png',
            'max' => 'La taille de l\'image ne doit pas depasser 1Mo',
            'numeric' => 'Ce champs doit contenir uniquement des chiffes',
            'unique' => 'Cet e-mail est déjà utilisé',
            'email' => 'Entrer une bonne adresse email',
            'confirmed' => 'Le mot de passe n\'a pas ete confirmer',
            'same' => 'Les mot de passe sont diffenrents',
        ];

        if ($profil) {

            return Validator::make($data, [
                'name' => 'required|regex:/^[a-z][a-z0-9 \-]+/i|min:3',
                'lastname' => 'required|regex:/^[a-z][a-z0-9 \-]+/i|min:3',
                'contact' => 'required|regex:/^\([0-9]{3}\) [0-9]{2}(\-[0-9]{3}){2}/i',
                'picture' => $withImage ? 'image|mimes:jpg,jpeg,png|max:1000' : 'nullable',
            ], $messages);

        } elseif ($changePassword) {

            return Validator::make($data, [
                'old_pass' => ['required', new OldPassword($model)],
                'password' => 'required|confirmed|min:8',
                'password_confirmation' => 'required|same:password|min:8'
            ], $messages);

        } elseif ($accountSets) {

            $messages = [
                'unique' => 'La valeur de ce champs est déjà utilisé',
                'required' => 'Ce champs est requis.',
                'min' => 'Un minimun de :min caractères est requis pour ce champs.',
                'regex' => 'Mauvais format du champs',
            ];

            return Validator::make($data, [
                'email' => ($data['email']) ? 'email|unique:users' : 'nullable',
                'username' => ($data['username']) ? 'regex:/^[a-z][a-z0-9 \-]+/i|min:3|unique:users' : 'nullable',
            ], $messages);

        } else {

            return Validator::make($data, [
                'name' => 'required|regex:/^[a-z][a-z ]+/i|min:3',
                'lastname' => 'required|regex:/^[a-z][a-z ]+/i|min:3',
                'sex' => 'required',
                'contact' => 'required|regex:/^\([0-9]{3}\) [0-9]{2}(\-[0-9]{3}){2}/i',
                'role' => 'required',
                'email' => 'required|email|unique:users',
                'picture' => $withImage ? 'image|mimes:jpg,jpeg,png|max:1000' : 'nullable',
                'sellpoint_id' => 'required|numeric'
            ], $messages);

        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->adminCheck();
        $employes = User::where('level', '=', 0)->get();
        return view('owners.employes.all', compact('employes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->adminCheck();
        $sellpoints = Sellpoint::all();
        return view('owners.employes.create', compact('sellpoints'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->adminCheck();
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
        $this->adminCheck();
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if (Auth::id() == $id) {

            $user = User::find($id);

            if ($request->get('profil') === 'on') {

                $existImage = $request->file('picture') ? true : false;

                $validator = $this->valid($request->all(), $existImage, true);

                if ($validator->fails()) {
                    return redirect()
                        ->route('profil', Auth::user()->username)
                        ->withErrors($validator)
                        ->withInput();
                }

                if ($user->name !== $request->get('name')) {
                    $user->name = $request->get('name');
                }

                if ($user->lastname !== $request->get('lastname')) {
                    $user->lastname = $request->get('lastname');
                }

                if ($user->contact !== $request->get('contact')) {
                    $user->contact = $request->get('contact');
                }

                if ($existImage) {
                    Storage::delete($user->picture);
                    $user->picture = $request->file('picture')->store('public/img/profil/'.$user->username);
                }

                $user->save();

                $nameChange = $user->wasChanged('name');
                $lastnameChange = $user->wasChanged('lastname');
                $contactChange = $user->wasChanged('contact');
                $picChange = $user->wasChanged('picture');

                return redirect()->route('profil', $user->username)->with([
                    'name' => $nameChange,
                    'lastname' => $lastnameChange,
                    'contact' => $contactChange,
                    'picture' => $picChange,
                ]);

            }
            elseif ($request->get('account') === 'on') {

                $datas = [
                    'email' => ($user->email !== $request->get('email')) ? $request->get('email') : null,
                    'username' => ($user->username !== $request->get('username')) ? $request->get('username') : null,
                ];

                $validator = $this->valid($datas, false, false, false, null, true);

                if ($validator->fails()) {
                    return redirect()
                        ->route('setting', Auth::user()->username)
                        ->withErrors($validator)
                        ->withInput();
                }

                if ($user->username !== $request->get('username')) {
                    $path = str_replace($user->username, $request->get('username'), $user->picture);
                    $directory = 'public/img/profil/'.$user->username;
                    Storage::move($user->picture, $path);
                    Storage::deleteDirectory($directory);
                    $user->username = $request->get('username');
                    $user->picture = $path;
                }

                if ($user->email !== $request->get('email')) {
                    $user->email = $request->get('email');
                }

                $user->save();

                $email = $user->wasChanged('email');
                $username = $user->wasChanged('username');

                Auth::setUser($user);

                return redirect()->route('setting', Auth::user()->username)->with(['email' => $email, 'username' => $username]);

            }
            elseif ($request->get('change_password') === 'on') {

                $validator = $this->valid($request->all(), false, false, true, $user);

                if ($validator->fails()) {
                    return redirect()
                        ->route('setting', Auth::user()->username)
                        ->withErrors($validator)
                        ->withInput();
                }

                $user->password = Hash::make($request->get('password'));
                $user->save();

                return redirect()->route('setting', Auth::user()->username)->with(['password' => true]);

            }

        }
        abort(404);
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
