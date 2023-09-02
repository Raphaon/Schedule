<?php

namespace App\Http\Controllers;

use App\Models\userGroup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserGroupController extends Controller
{
    public function index()
    {
        $groups=userGroup::all();
        if(!$groups)
        {
            return response()->json(['statut'=>404,'errors'=>'any group is already added'],404);
        }
        return response()->json([$groups,'status'=>200],200);

    }
    public function delete (Request $request,$id)
    {
        try {
            $userGroup=userGroup::findorFail($id);
            $userGroup->update([
                'isDelete'=>'1',
            ]);
        } catch (Exception $errors) {
            $errors=['Not found'];
            return response()->json($errors,404);
        }
        return response()->json(['status'=>200,$userGroup,'messages'=>'done']);
    }
//fonction d'enregistrement des

    public function store (Request $request)
    {
        $validator= Validator::make($request->all(),
            [
            'intitule' => 'required|string|max:255',
            ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);
        }else
        {

            $userGroup=userGroup::create([
            'intitule' => $request->intitule,
            ]);
            if($userGroup)
            {
                return response()->json(
                    [
                        'statut'=>200,
                        'message'=>'done',
                        'userGroup'=>$userGroup
                    ]
                    );
            }else
            {
                return response()->json(
                    [
                        'statut'=>500,
                        'message'=>'serveur error'
                    ]
                    );
            }
        }
    }

    public function update(Request $request ,$id)
    {
        $validator= Validator::make($request->all(),
            [
            'intitule' => 'required|string|max:255',
            ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);
        }else
        {

            $userGroup=userGroup::create([
            'intitule' => $request->intitule,
            ]);
            if($userGroup)
            {
                return response()->json(
                    [
                        'statut'=>200,
                        'message'=>'updated',
                        'userGroup'=>$userGroup
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

