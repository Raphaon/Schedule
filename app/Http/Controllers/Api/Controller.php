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
     
}
