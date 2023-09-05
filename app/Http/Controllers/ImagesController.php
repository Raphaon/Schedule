<?php

namespace App\Http\Controllers;

use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImagesController extends Controller
{
     /**
     * @OA\Post(
     *      path="/image/uploadMany",
     *      tags={"Images"},
     *      summary="Store Many Images",
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
    public function storeMany(Request $request)
    {
        $images=$request->images;
      foreach($images as $image)
      {
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('storage/uploads/users'), $imageName);

        Images::create([
            'path' =>'uploads/produits' .  $imageName,
            'users_id'=>auth()->user()->id,
        ]);

      }
    }
 /**
     * @OA\Post(
     *      path="/image/upload",
     *      tags={"Images"},
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
    public function store_1(Request $request)
    {
        $validator= Validator::make($request->all(),
        [
        'image' => 'required|file',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);
        }
        else{
            $imageName=uniqid().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('storage/uploads/users'),$imageName);
            Images::create([
                'path' =>'uploads/produits' .  $imageName,
                'users_id'=>auth()->user()->id,
            ]);
            return response()->json([
                'statut'=>422,
                'errors'=>'informstions non valides',
            ]);
        }



    }

          /**
     * @OA\Delete(
     *      path="/image/deleteMany",
     *      tags={"Images"},
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

    public function deleteMany(Request $request)
        {
            $images =$request->option;

            foreach($images as $image)
            {
                Storage::disk('public')->delete($image);
                // $image = images::where('file_path',$image);
                $image->delete();
            }
            return redirect()->back();
        }

          /**
     * @OA\Delete(
     *      path="/image/delete",
     *      tags={"Images"},
     *      summary="Delete existing images",
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
     *          response=200,
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
    public function delete_1(Request $request)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
        $image=$request->image;
        Storage::disk('public')->delete($image);
        $image->delete();
    }
}
