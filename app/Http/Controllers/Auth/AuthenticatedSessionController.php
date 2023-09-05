<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Validator;

    /**
     * @OA\Get(
     *      path="/Authentification/{id}",
     *      operationId="getProjectById",
     *      tags={"Authentification"},
     *      summary="Get project information",
     *      description="Returns project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
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
    // now some
      /**
     * @OA\Put(
     *      path="/update/{id}",
     *      operationId="updateProject",
     *      tags={"Authentification"},
     *      summary="Update existing project",
     *      description="Returns updated project data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project id",
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
     *
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



class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming Authentification request.
     */

 /**
     * @OA\Post(
     *      path="/logout",
     *      tags={"Authentification"},
     *      summary="Store new project",
     *      description="Returns project data",
     *      @OA\RequestBody(
     *          required=true,
     *
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *
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
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),
        [
        'email' => 'required|string|email|max:255|exists:'.User::class,
        'password' => ['required', Rules\Password::defaults()],
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);
        }
        else{
            if(Auth::attempt($request->only('email', 'password')))
            {
                $token = Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());
                $token = auth()->user()->createToken('cle')->plainTextToken;
                return response()->json([
                    'token'=>$token ,
                    'status'=>200,
                    'user'=>auth()->user()],200);
            }else{
                return response()->json([
                    'statut'=>422,
                    'errors'=>'informstions non valides',
                ]);
            }
        }

        // $request->authenticate();
;
        // $request->session()->regenerate();

    }

    /**
     * Destroy an authenticated session.
     */

    public function destroy(Request $request){
       Auth::user()->token()->delete();
        return response()->json(['status'=>200,'message'=>"Deconnexion reuissit"],200);
    }
     /**
     * @OA\Delete(
     *      path="/user/delete-use/{id}",
     *      operationId="deleteProject",
     *      tags={"Authentification"},
     *      summary="Delete existing project",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project id",
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
    public function delete()
    {
        //
    }
}
