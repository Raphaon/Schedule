<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        /**
     * @OA\Get(
     *      path="/company",
     *      operationId="getcompanyList",
     *      tags={"company"},
     *      summary="Get list of company",
     *      description="Returns list of company",
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
        $companys=Company::all();
        if(count($companys))
        {
            return response()->json([$companys,'status'=>200],200);
        }
        return response()->json(['statut'=>404,'errors'=>'any group is already added'],404);
    }



    /**
     * Store a newly created resource in storage.
     */
     /**
     * @OA\Post(
     *      path="/company/save",

     *      tags={"company"},
     *      summary="Store new company",
     *      description="Returns company data",
        *      @OA\Parameter(
     *          name="companies_id",
     *          description="company companies_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="companyName",
     *          description="access name: you should give the access name to update it",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
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
     *      @OA\Parameter(
     *          name="location",
     *          description="access name: you should give the access name to update it",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="phone",
     *          description="access name: you should give the access name to update it",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="access name: you should give the access name to update it",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
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
            'companyName'=>'required|string|max:255|unique:'.Company::class,
            'slogan'=>'required|string|max:255|unique:'.Company::class,
            'location'=>'required|string|',
            'phone'=>'required|string|',
            'email'=>'required|string|max:255|unique:'.Company::class,
        ]);

    if($validator->fails())
    {
        return response()->json([
            'status'=>422,
            'errors'=>$validator->messages()
        ],422);
    }else
    {

        $company=Company::create([
            'companyName'=>$request->companyName,
            'slogan'=>$request->slogan,
            'location'=>$request->location,
            'phone'=>$request->phone,
            'email'=>$request->email
        ]);
        if($company)
        {
            return response()->json(
                [
                    'statut'=>200,
                    'message'=>'done',
                    'company'=>$company
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
     *      path="/company/{id}",
     *      tags={"company"},
     *      summary="Get company information",
     *      description="Returns company data",
     *      @OA\Parameter(
     *          name="id",
     *          description="company id",
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
        if($company=Company::find($id)){
            return response()->json(['status'=>200,$company,'message'=>'done']);
        }
        return response()->json(['errors'=>'Not Found'],404);
    }



    /**
     * Update the specified resource in storage.
     */
        /**
     * @OA\Put(
     *      path="/company/update/{id}",
     *      tags={"company"},
     *      summary="Update existing company",
     *      description="Returns updated company data",
     *      @OA\Parameter(
     *          name="companies_id",
     *          description="company companies_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
    *      @OA\Parameter(
     *          name="companyName",
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
            'companyName'=>'required|string|max:255|',
            'slogan'=>'required|string|max:255|',
            'location'=>'required|string|',
            'phone'=>'required|string|',
            'email'=>'required|string|max:255|',
        ]);

    if($validator->fails())
    {
        return response()->json([
            'status'=>422,
            'errors'=>$validator->messages()
        ],422);
    }else
    {
        $company=Company::find($id)->update([
            'companyName'=>$request->companyName,
            'slogan'=>$request->slogan,
            'location'=>$request->location,
            'phone'=>$request->phone,
            'email'=>$request->email
        ]);
        if($company)
        {
            return response()->json(
                [
                    'statut'=>200,
                    'message'=>'done',
                    'company'=>$company
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
     *      path="/company/delete/{id}",
     *      tags={"company"},
     *      summary="Delete existing company",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="company id",
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
            $company=Company::find($id);
            $company->delete($id);
        } catch (\Throwable $th) {
            $errors=['Not found'];
            return response()->json($errors,404);
        }
        return response()->json(['status'=>200,'messages'=>'done']);
    }
}
