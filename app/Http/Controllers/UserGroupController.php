<?php

namespace App\Http\Controllers;

use App\Models\userGroup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserGroupController extends Controller
{
    /**
     * @OA\Get(
     *      path="/user-group/",
     *      operationId="getuserGroupList",
     *      tags={"userGroup"},
     *      summary="Get list of userGroup",
     *      description="Returns list of userGroup",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        $groups=userGroup::all();
        if($groups->count()==0)
        {
            return response()->json(['statut'=>404,'errors'=>'any group is already added'],404);
        }
        return response()->json(['group'=>$groups,'status'=>200],200);

    }
 /**
     * @OA\Get(
     *      path="/user-group/{id}",
     *      tags={"userGroup"},
     *      summary="Get userGroup information",
     *      description="Returns userGroup data",
     *      @OA\Parameter(
     *          name="id",
     *          description="userGroup id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show($id)
    {
        $errors=['Not found'];
        try {
            $userGroup=userGroup::findorFail($id);
            if($userGroup->isDelete=='0'){
                return response()->json(['status'=>200,'userGroup'=>$userGroup,'messages'=>'group']);
            }
            return response()->json(['status'=>404,$errors]);
        } catch (Exception $e) {

            return response()->json($errors,404);
        }

    }
     /**
     * @OA\Delete(
     *      path="/user-group/delete/{id}",
     *      tags={"userGroup"},
     *      summary="Delete existing userGroup",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="userGroup id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function delete (Request $request,$id)
    {
        try {
            $userGroup=userGroup::findorFail($id)->where('isDlete',0);
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
 /**
     * @OA\Post(
     *      path="/user-group/save",
     *      tags={"userGroup"},
     *      summary="Store new userGroup",
     *      description="Returns userGroup data",
     *      @OA\RequestBody(
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
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

    /**
     * @OA\Put(
     *      path="/user-group/update/{id}",
     *      tags={"userGroup"},
     *      summary="Update existing userGroup",
     *      description="Returns updated userGroup data",
     *      @OA\Parameter(
     *          name="id",
     *          description="userGroup id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
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

