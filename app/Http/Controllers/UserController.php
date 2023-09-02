<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\EventListener\ResponseListener;

class UserController extends Controller
{

    /**
     * @OA\Get(
     *      path="/user/get-user",
     *      operationId="getUserList",
     *      tags={"User"},
     *      summary="Get list of User",
     *      description="Returns list of User",
     *
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
        $users=User::all();
        return response()->json($users);
    }

    /**
     * @OA\Delete(
     *      path="/user/delete-user/{id}",
     *      tags={"User"},
     *      summary="Delete existing user",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="user id",
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
    public function delete($id)
    {
        try {
            $user=User::findorFail($id);
            $user->update([
                'isDelete'=>'1',
            ]);
            $user->save();
            $notification='succes';
        } catch (\Throwable $th) {
            $notification=$th;
        }
        return response()->json([$notification,$user]);
    }

 /**
     * @OA\Post(
     *      path="/user/store-user",
     *      tags={"Permission"},
     *      summary="Store new user",
     *      description="Returns user data",
     *      @OA\RequestBody(
     *          required=true,
     *      ),
     *
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
        $status=[];
        try {
            $request->validate([

                'email'=>['email'],

            ]);
            $user = new User();
            $user->lastName=$request->lastNAme;
            $user->firstName=$request->firstName;
            $user->email=$request->email;
            $user->zip=$request->zip;
            $user->password= $request->password ;
            $user->country = $request->country;
            $user->phoneNumber =$request->phoneNumber;
            $user->location =$request->location;
            $status='done';
        } catch (\Throwable $th) {
            $status= $th;
        }
        return response()->json([$status]);
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
 /**
     * @OA\Put(
     *      path="user/update-user/{id}",
     *      tags={"User"},
     *      summary="Update existing user",
     *      description="Returns updated user data",
     *      @OA\Parameter(
     *          name="id",
     *          description="user id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *
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
        $status='done';
        try {
            $request->validate([
                'lastName'=>['string'],
                'firstName'=>['string'],
                'zip'=>[],
                'password'=>[],
                'country'=>[],
                'phoneNumber'=>[],
                'location'=>[],

            ]);

            $user =User::findorFail($id);
            $user->lastName=$request->lastNAme;
            $user->firstName=$request->firstName;
            $user->zip=$request->zip;
            $user->country = $request->country;
            $user->phoneNumber =$request->phoneNumber;
            $user->location =$request->location;
            $user->update();
        } catch (\Throwable $th) {
            $status=$th ;
            throw $status;
        }
        return response()->json($status);
    }
}
