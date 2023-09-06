<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        /**
     * @OA\Get(
     *      path="/branch",
     *      operationId="getbranchList",
     *      tags={"branch"},
     *      summary="Get list of branch",
     *      description="Returns list of branch",
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
        $branchs=Branch::all();
        if($branchs)
        {
            return response()->json([$branchs,'status'=>200],200);
        }
        return response()->json(['statut'=>404,'errors'=>'any group is already added'],404);
    }



    /**
     * Store a newly created resource in storage.
     */
     /**
     * @OA\Post(
     *      path="/branch/save",

     *      tags={"branch"},
     *      summary="Store new branch",
     *      description="Returns branch data",
        *      @OA\Parameter(
     *          name="branches_id",
     *          description="branch branches_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="branchName",
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
     *          name="slogan",
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
     *          name="location",
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
     *          name="phone",
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
            'branchName'=>'required|string|max:255|unique:'.Branch::class,
            'slogan'=>'required|string|max:255|unique:'.Branch::class,
            'location'=>'required|string|',
            'phone'=>'required|string|max:255|unique:'.Branch::class,
            'branches_id'=>'required|string|max:255|unique:'.Branch::class
        ]);

    if($validator->fails())
    {
        return response()->json([
            'status'=>422,
            'errors'=>$validator->messages()
        ],422);
    }else
    {

        $Branch=Branch::create([
            'branchName'=>$request->branchName,
            'slogan'=>$request->slogan,
            'location'=>$request->location,
            'phone'=>$request->phone,
            'branches_id'=>$request->branches_id
        ]);
        if($Branch)
        {
            return response()->json(
                [
                    'statut'=>200,
                    'message'=>'done',
                    'Branch'=>$Branch
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
     *      path="/branch/{id}",
     *      tags={"branch"},
     *      summary="Get branch information",
     *      description="Returns branch data",
     *      @OA\Parameter(
     *          name="id",
     *          description="branch id",
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
        if($branch=Branch::find($id)){
            return response()->json(['status'=>200,$branch,'message'=>'done']);
        }
        return response()->json(['errors'=>'Not Found'],404);
    }



    /**
     * Update the specified resource in storage.
     */
        /**
     * @OA\Put(
     *      path="/branch/update/{id}",
     *      tags={"branch"},
     *      summary="Update existing branch",
     *      description="Returns updated branch data",
     *      @OA\Parameter(
     *          name="branches_id",
     *          description="branch branches_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
    *      @OA\Parameter(
     *          name="branchName",
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
     *          name="slogan",
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
     *          name="location",
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
     *          name="phone",
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
            'branchName'=>'required|string|max:255|unique:'.Branch::class,
            'slogan'=>'required|string|max:255|unique:'.Branch::class,
            'location'=>'required|string|',
            'phone'=>'required|string|max:255|',
            'branches_id'=>'integer'
        ]);

    if($validator->fails())
    {
        return response()->json([
            'status'=>422,
            'errors'=>$validator->messages()
        ],422);
    }else
    {
        $branch=Branch::find($id)->update([
            'branchName'=>$request->branchName,
            'slogan'=>$request->slogan,
            'location'=>$request->location,
            'phone'=>$request->phone,
            'branches_id'=>$request->branches_id
        ]);
        if($branch)
        {
            return response()->json(
                [
                    'statut'=>200,
                    'message'=>'done',
                    'branch'=>$branch
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
     *      path="/branch/delete/{id}",
     *      tags={"branch"},
     *      summary="Delete existing branch",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="branch id",
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
            Branch::fin($id)->delete($id);
        } catch (\Throwable $th) {
            $errors=['Not found'];
            return response()->json($errors,404);
        }
        return response()->json(['status'=>200,'messages'=>'done']);
    }
}
