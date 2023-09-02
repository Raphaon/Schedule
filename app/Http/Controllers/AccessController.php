<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccessController extends Controller
{
        /**
     * @OA\Get(
     *      path="/access/",
     *      operationId="getaccessList",
     *      tags={"Access"},
     *      summary="Get list of access",
     *      description="Returns list of access",
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
        $groups=access::where('id','0');
        if(!$groups)
        {
            return response()->json(['statut'=>404,'errors'=>'any group is already added'],404);
        }
        return response()->json([$groups,'status'=>200],200);

    }
     /**
     * @OA\Get(
     *      path="/access/{id}",
     *      tags={"Access"},
     *      summary="Get access information",
     *      description="Returns access data",
     *      @OA\Parameter(
     *          name="id",
     *          description="access id",
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
            $access=access::findorFail($id);
            if($access->isDelete=='0'){
                return response()->json(['status'=>200,'access'=>$access,'messages'=>'done']);
            }
            return response()->json(['status'=>403,'errors'=>$errors]);
        } catch (Exception $e) {

            return response()->json(['errors'=>$errors],404);
        }

    }
      /**
     * @OA\Delete(
     *      path="/access/delete/{id}",
     *      tags={"Access"},
     *      summary="Delete existing access",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="access id",
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
            $access=access::findorFail($id);
            if($access->isDelete=="0")
            {
                $access->update([
                    'isDelete'=>'1',
                ]);
            }else{
                $errors='delete';
                return response()->json($errors,403);
            }
        } catch (Exception $errors) {
            $errors=['Not found'];
            return response()->json($errors,404);
        }
        return response()->json(['status'=>200,$access,'messages'=>'done']);
    }
//fonction d'enregistrement des
    /**
     * @OA\Post(
     *      path="/access/save",
     *      tags={"Access"},
     *      summary="Store new access",
     *      description="Returns access data",
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
    /**
     * @OA\Put(
     *      path="/access/update/{id}",
     *      tags={"Access"},
     *      summary="Update existing access",
     *      description="Returns updated access data",
     *      @OA\Parameter(
     *          name="sccessName",
     *          description="access name: you should give the access name to update it",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
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
