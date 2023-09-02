<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccessController extends Controller
{
    public function index()
    {
        $groups=access::all();
        if(!$groups)
        {
            return response()->json(['statut'=>404,'errors'=>'any group is already added'],404);
        }
        return response()->json([$groups,'status'=>200],200);

    }
    public function delete ($id)
    {
        try {
            $access=access::findorFail($id);
            $access->update([
                'isDelete'=>'1',
            ]);
        } catch (Exception $errors) {
            $errors=['Not found'];
            return response()->json($errors,404);
        }
        return response()->json(['status'=>200,$access,'messages'=>'done']);
    }
//fonction d'enregistrement des

    public function store (Request $request)
    {
        $validator= Validator::make($request->all(),
            [
            'accessType' => 'required|string|max:255|unique:'.access::class,
            ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);
        }else
        {

            $access=access::create([
            'accessType' => $request->accessType,
            ]);
            if($access)
            {
                return response()->json(
                    [
                        'statut'=>200,
                        'message'=>'done',
                        'access'=>$access
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

    public function update(Request $request ,$acces)
    {
        $validator= Validator::make($request->all(),
            [
            'accessType' => 'required|string|max:255|unique:'.access::class,
            ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);
        }else
        {

            $access=access::where('accesType',$acces);
            $access->update([
            'accessType' => $request->accessType,
            ]);
            if($access)
            {
                return response()->json(
                    [
                        'statut'=>200,
                        'message'=>'updated',
                        'access'=>$access
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
