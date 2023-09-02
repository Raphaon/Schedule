<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionsController extends Controller
{
    /**
     * @OA\Get(
     *      path="/permissions",
     *      operationId="getpermissionsList",
     *      tags={"Permission"},
     *      summary="Get list of permissions",
     *      description="Returns list of permissions",
     * @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     * @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        $groups=permissions::all();
        if(!$groups)
        {
            return response()->json(['statut'=>404,'errors'=>'any group is already added'],404);
        }
        return response()->json([$groups,'status'=>200],200);

    }
     /**
     * @OA\Get(
     *      path="/permission/{id}",
     *      tags={"Permission"},
     *      summary="Get permission information",
     *      description="Returns permission data",
     *      @OA\Parameter(
     *          name="id",
     *          description="permission id",
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
        try {
            $permission=permissions::findorFail();
            return response()->json(['status'=>200,$permission,'messages'=>'done']);
        } catch (Exception $e) {
             $errors=['Not found'];
            return response()->json($errors,404);
        }

    }
      /**
     * @OA\Delete(
     *      path="/permission/delete/{id}",
     *      tags={"Permission"},
     *      summary="Delete existing permission",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="permission id",
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
 /**
     * @OA\Post(
     *      path="/permissions",
     *      operationId="storepermission",
     *      tags={"Permission"},
     *      summary="Store new permission",
     *      description="Returns permission data",
     *      @OA\RequestBody(
     *          required=true,
     *      ),
     * @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     * @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     * @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
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

    /**
     * @OA\Put(
     *      path="/permission/update/{id}",
     *      tags={"Permission"},
     *      summary="Update existing permission",
     *      description="Returns updated permission data",
     *      @OA\Parameter(
     *          name="id",
     *          description="permission id",
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
