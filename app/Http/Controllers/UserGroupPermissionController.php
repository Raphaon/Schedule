<?php

namespace App\Http\Controllers;

use App\Models\permissions;
use App\Models\userGroup;
use Exception;
use Illuminate\Http\Request;
use App\Models\userGroupPermission;
use Illuminate\Support\Facades\Validator;

class UserGroupPermissionController extends Controller
{



//fonction d'enregistrement des
 /**
     * @OA\Post(
     *      path="/user-group-permission/save",
     *      tags={"Operation between userGroup and Permission"},
     *      summary="associate one access to some group (remove to another)",
     *      description="Returns permission data",
     *      @OA\RequestBody(
     *          required=true,
     *      ),
     *       @OA\Parameter(
     *          name="id",
     *          description="group_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
    *   @OA\Parameter(
     *          name="id",
     *          description="permission_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
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
    public function store ($group_id,$permission_id)
    {
        $validator= Validator::make([
            'user_group_id' => $group_id,
            'permissions_id' => $permission_id,
        ],
            [
            'user_group_id' => 'required|',
            'permissions_id'=> 'integer'
            ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);
        }else
        {
            if(userGroup::find($group_id) and permissions::find($permission_id))
            {

            }
            $userGroupPermission=userGroupPermission::create([
            'user_group_id' => $group_id,
            'permissions_id' => $permission_id,
            ]);
            if($userGroupPermission)
            {
                return response()->json(
                    [
                        'statut'=>200,
                        'message'=>userGroup::find($group_id)->intitule.'have now'.permissions::find($permission_id)->intitule.' as permission',
                        'userGroupPermission'=>$userGroupPermission
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
     *      path="/user-group-permission/update/{id}",
     *      tags={"Operation between userGroup and Permission"},
     *      summary="Update existing permission with group",
     *      description="Returns updated permission data",
     *      * @OA\Parameter(
     *          name="id",
     *          description="id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
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
    public function update($group_id, $permission_id,$id)
    {
        $validator= Validator::make([
            'user_group_id' => $group_id,
            'permissions_id' => $permission_id,
        ],
        [
        'user_group_id' => 'required|',
        'permissions_id'=> 'integer'
        ]);
    if($validator->fails())
    {
        return response()->json([
            'status'=>422,
            'errors'=>$validator->messages()
        ],422);
    }else
    {
        if(userGroup::find($group_id) and permissions::find($permission_id))
        {


        $userGroupPermission=userGroupPermission::find($id);
        $userGroupPermission->update([
        'user_group_id' => $group_id,
        'permissions_id' => $permission_id,
        ]);
        if($userGroupPermission)
        {
            return response()->json(
                [
                    'statut'=>200,
                    'message'=>userGroup::find($group_id)->intitule.'have now'.permissions::find($permission_id)->intitule.' as permission',
                    'userGroupPermission'=>$userGroupPermission
                ]
                );
            }else{
                return response()->json(
                    [
                        'statut'=>500,
                        'message'=>'userGroup or acces group is not exist'
                    ]
                    );
            }
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
