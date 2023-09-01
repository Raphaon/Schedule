<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\EventListener\ResponseListener;

class UserController extends Controller
{
    public function index()
    {

    }
    public function delete($id)
    {
        try {
            $user=User::findorFail($id);
            $user->delete();
            $notification='succes';
        } catch (\Throwable $th) {
            $notification='echec';
        }
        return response()->json([$notification]);
    }

    public function store()
    {
        $users=User::all();
        return response()->json($users);
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
        try {
            $request->validate([
                'firstName'=>['string'],
                // 'passWord'=>['string','min:6'],
                'lastName'=>['string'],
            ]);

            $user =User::findorFail($id);
            $user->update([
                'token' => ['required'],
                'firstName'=>$request->firstName,
                'lastName'=>$request->lastName,
                // 'email'=>$request->emai,
                // 'firstName'=>$request->firstName,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
