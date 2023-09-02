<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as C;
use Illuminate\Http\Request;
/**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Schedule",
     *      description="Documentation de l'API Schedule",
     *      @OA\Contact(
     *          email="wwwmbassiloic@gmail.com"
     *      ),
     * @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="API "
     * )

     *
     * @OA\Tag(
     *     name="Schedule",
     *     description="API Endpoints of Authentication"
     * )
     *
      * @OA\Get(
 *     path="/user/get-user/{id}",
 *     summary="Description de votre route",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de l'élément",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Réponse réussie"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Non trouvé"
 *     )
 * )
     */
class Controller extends C
{
     /**
     * @OA\Get(
     *      path="/user",
     *      operationId="getAuthenticationList",
     *      tags={"Authentication"},
     *      summary="Get list of Authentication",
     *      description="Returns list of Authentication",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
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

       /**
     * @OA\Post(
     *      path="/register",
     *      operationId="storeProject",
     *      tags={"Authentication"},
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

       /**
     * @OA\Post(
     *      path="/logout",
     *      tags={"Authentication"},
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


    /**
     * @OA\Get(
     *      path="/Authentication/{id}",
     *      operationId="getProjectById",
     *      tags={"Authentication"},
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

      /**
     * @OA\Put(
     *      path="/update/{id}",
     *      operationId="updateProject",
     *      tags={"Authentication"},
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
     *          @OA\JsonContent(ref="#/components/schemas/UpdateProjectRequest")
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


    /**
     * @OA\Delete(
     *      path="/destroy/{id}",
     *      operationId="deleteProject",
     *      tags={"Authentication"},
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
}
