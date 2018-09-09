<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\Role;
use App\Http\Requests\User\{
    StoreUserRequest
};

use App\Models\User\User;
use App\Models\Institution\Institution;
use App\Modules\Identicon\Identicon;

class ClientsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function index()
    {
        $clients = User::clients()
            ->with(['institutions'])
            ->oldest()
            ->get();

        $institutions = Institution::all();
    
        return view('users.clients.index' , compact('clients', 'institutions'));
    }
    public function create()
    {    
        $institutions = Institution::orderBy('title')->get();
        return view('users.clients.create', compact('institutions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->validate($request, [
            'institution' => 'required|exists:institutions,id'    
        ]);
    
        $user = User::create([
            'username'      => $request->username,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
        ]);
        
        $user->avatar_path = (new Identicon)->storeAfterGeneratingFrom($request->email);
        $user->save();
        $user->roles()->attach(4);
        $user->institutions()->attach($request->institution);
        
       return redirect()
            ->route('clients.index')
            ->withMessage(
                'Клиент добавен'
            );
    }
}
