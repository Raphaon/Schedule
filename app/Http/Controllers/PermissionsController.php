<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionsController extends Controller
{
    public function index()
    {
        $groups=permissions::all();
        if(!$groups)
        {
            return response()->json(['statut'=>404,'errors'=>'any group is already added'],404);
        }
        return response()->json([$groups,'status'=>200],200);

    }
    public function delete ($id)
    {
        try {
            $permissions=permissions::findorFail($id);
            $permissions->update([
                'isDelete'=>'1',
            ]);
        } catch (Exception $errors) {
            $errors=['Not found'];
            return response()->json($errors,404);
        }
        return response()->json(['status'=>200,$permissions,'messages'=>'done']);
    }
//fonction d'enregistrement des

    public function store (Request $request)
    {
        $validator= Validator::make($request->all(),
            [
            'intitule' => 'required|string|max:255|unique:'.permissions::class,
            ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);
        }else
        {

            $permissions=permissions::create([
            'intitule' => $request->intitule,
            ]);
            if($permissions)
            {
                return response()->json(
                    [
                        'statut'=>200,
                        'message'=>'done',
                        'permissions'=>$permissions
                    ]
                    );
            }else
            {
                return response()->json(
                    [
                        'statut'=>500,
                        'message'=>'server error'
                    ]
                    );
            }
        }
    }

    public function update(Request $request ,$id)
    {
        $validator= Validator::make($request->all(),
            [
            'intitule' => 'required|string|max:255|unique:'.permissions::class,
            ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);
        }else
        {
            $permissions=permissions::findorFail($id);
            $permissions->update([
            'intitule' => $request->intitule,
            ]);
            if($permissions)
            {
                return response()->json(
                    [
                        'statut'=>200,
                        'message'=>'updated',
                        'permissions'=>$permissions
                    ]
                    );
            }else
            {
                return response()->json(
                    [
                        'statut'=>500,
                        'message'=>'server error'
                    ]
                    );
            }
        }
    }
}
