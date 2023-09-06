<?php

namespace App\Http\Controllers;

use App\Models\Acts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        /**
     * @OA\Get(
     *      path="/acts",
     *      operationId="getactsList",
     *      tags={"acts"},
     *      summary="Get list of acts",
     *      description="Returns list of acts",
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
        $actss=Acts::all();
        if($actss)
        {
            return response()->json([$actss,'status'=>200],200);
        }
        return response()->json(['statut'=>404,'errors'=>'any group is already added'],404);
    }



    /**
     * Store a newly created resource in storage.
     */
     /**
     * @OA\Post(
     *      path="/acts/save",

     *      tags={"acts"},
     *      summary="Store new acts",
     *      description="Returns acts data",

     *      @OA\Parameter(
     *          name="actsName",
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
     *      @OA\Parameter(
     *          name="abreviation",
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

     *      @OA\RequestBody(
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="price",
     *          description="access name: you should give the access name to update it",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
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
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),
        [
            'actsName'=>'required|string|max:255|unique:'.Acts::class,
            'abreviation'=>'|string|max:255|unique:'.Acts::class,
            'price'=>'|decimal|max:255|',
        ]);

    if($validator->fails())
    {
        return response()->json([
            'status'=>422,
            'errors'=>$validator->messages()
        ],422);
    }else
    {

        $acts=Acts::create([
            'actsName'=>$request->actsName,
            'abreviation'=>$request->abreviation,
            'price'=>$request->price,
        ]);
        if($acts)
        {
            return response()->json(
                [
                    'statut'=>200,
                    'message'=>'done',
                    'acts'=>$acts
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
     * Display the specified resource.
     */
         /**
     * @OA\Get(
     *      path="/acts/{id}",
     *      tags={"acts"},
     *      summary="Get acts information",
     *      description="Returns acts data",
     *      @OA\Parameter(
     *          name="id",
     *          description="acts id",
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
        if($acts=Acts::find($id)){
            return response()->json(['status'=>200,$acts,'message'=>'done']);
        }
        return response()->json(['errors'=>'Not Found'],404);
    }



    /**
     * Update the specified resource in storage.
     */
        /**
     * @OA\Put(
     *      path="/acts/update/{id}",
     *      tags={"acts"},
     *      summary="Update existing acts",
     *      description="Returns updated acts data",
    *      @OA\Parameter(
     *          name="actsName",
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
     *      @OA\Parameter(
     *          name="price",
     *          description="access name: you should give the access name to update it",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *      ),
     
     *      @OA\RequestBody(
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="price",
     *          description="access name: you should give the access name to update it",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="number"
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
    public function update(Request $request,$id)
    {
        $validator= Validator::make($request->all(),
        [
            'actsName'=>'required|string|max:255|unique:'.Acts::class,
            'abreviation'=>'|string|max:255|unique:'.Acts::class,
            'price'=>'|decimal|max:255|',
        ]);

    if($validator->fails())
    {
        return response()->json([
            'status'=>422,
            'errors'=>$validator->messages()
        ],422);
    }else
    {
        $acts=Acts::find($id)->update([
            'actsName'=>$request->actsName,
            'abreviation'=>$request->abreviation,
            'price'=>$request->price,
        ]);
        if($acts)
        {
            return response()->json(
                [
                    'statut'=>200,
                    'message'=>'done',
                    'acts'=>$acts
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
     * Remove the specified resource from storage.
     */
          /**
     * @OA\Delete(
     *      path="/acts/delete/{id}",
     *      tags={"acts"},
     *      summary="Delete existing acts",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="acts id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
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
    public function destroy( $id)
    {
        try {
            Acts::fin($id)->delete($id);
        } catch (\Throwable $th) {
            $errors=['Not found'];
            return response()->json($errors,404);
        }
        return response()->json(['status'=>200,'messages'=>'done']);
    }
}
