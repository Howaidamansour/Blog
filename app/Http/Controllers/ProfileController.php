<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $p=User::profile();
       //  $objct=new User();
        // $objct->profile();
        $user=Auth::user();
        $id=Auth::id();
        if($user-> profile == null){
            $objct=Profile::create([
                'city'	=> 'kfs',
                'user_id'	=>$id,
                'gender'	=>'male',
                'bio'	=>'this is bio',
                'facebook'=>'facebook.com',

            ]);
        }
        return view('users.profile')->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request)
    {
        $this->validate($request, [
            'name'   =>'required',
            'city'	=> 'required',
            'gender'	=>'required',
            'bio'	=>'required',
            'facebook'=>'required',

        ]);
        /** @var \App\Models\User $user */
        $user = Auth::user();

       //$userh=new User();
      // $userh->profile();
       // $user=Auth::user();
        $user->name = $request->name;
        $user->profile->city = $request->city;
        $user->profile->gender = $request->gender;
        $user->profile->bio = $request->bio;
        $user->profile->facebook = $request->facebook;
        $user->save();
        $user->profile->save();
       // $user->
       if($request->has('password')){
           $user->password=Hash::make($request->password);
           $user->save();
       }
       return redirect()->back();

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
