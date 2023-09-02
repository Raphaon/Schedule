<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\EventListener\ResponseListener;

class UserController extends Controller
{
    public function index()
    {
        $users=User::all();
        return response()->json($users);
    }
    public function delete($id)
    {
        try {
            $user=User::findorFail($id);
            $user->update([
                'isDelete'=>'1',
            ]);
            $user->save();
            $notification='succes';
        } catch (\Throwable $th) {
            $notification=$th;
        }
        return response()->json([$notification,$user]);
    }


    public function store(Request $request)
    {
        $status=[];
        try {
            $request->validate([

                'email'=>['email'],

            ]);
            $user = new User();
            $user->lastName=$request->lastNAme;
            $user->firstName=$request->firstName;
            $user->email=$request->email;
            $user->zip=$request->zip;
            $user->password= $request->password ;
            $user->country = $request->country;
            $user->phoneNumber =$request->phoneNumber;
            $user->location =$request->location;
            $status='done';
        } catch (\Throwable $th) {
            $status= $th;
        }
        return response()->json([$status]);
    }

    public function show($id)
    {
        $user=new User();
        $status='';
        try {
            $user=User::findorFail($id);
        } catch (\Throwable $th) {
            $status=$th;
            $notification = 'Introuvable';
        }
        return response()->json([$user,$status]);
    }

    public function update(Request $request ,$id)
    {
        $status='done';
        try {
            $request->validate([
                'lastName'=>['string'],
                'firstName'=>['string'],
                'zip'=>[],
                'password'=>[],
                'country'=>[],
                'phoneNumber'=>[],
                'location'=>[],

            ]);

            $user =User::findorFail($id);
            $user->lastName=$request->lastNAme;
            $user->firstName=$request->firstName;
            $user->zip=$request->zip;
            $user->country = $request->country;
            $user->phoneNumber =$request->phoneNumber;
            $user->location =$request->location;
            $user->update();
        } catch (\Throwable $th) {
            $status=$th ;
            throw $status;
        }
        return response()->json($status);
    }
}
