<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Js;

/**
 * @OA\Tag(
 *     name="Posts",
 *     description="Operaciones CRUD para posts"
 * )
 */

class PostController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/posts",
     *     operationId="getPosts",
     *     tags={"Posts"},
     *     summary="Listar todos los posts",
     *     description="Retorna una lista paginada de posts",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Post")
     *         )
     *     ),
     *     @OA\Response(response=401, description="No autenticado")
     * )
     */

    public function index():AnonymousResourceCollection
    {
        return PostResource::collection(Post::with('user', 'comments')->get());
    }

    /**
     * @OA\Post(
     *     path="/api/posts",
     *     operationId="createPost",
     *     tags={"Posts"},
     *     summary="Crear nuevo post",
     *     description="Crea un nuevo post con los datos proporcionados",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PostRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Post creado",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(response=422, description="Error de validación")
     * )
     */
    public function store(StorePostRequest $request) {
        try {
            $post = Post::create($request->validated());
            return new PostResource($post);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
       
    }
    
    /**
     * @OA\Put(
     *     path="/api/posts/{id}",
     *     operationId="updatePost",
     *     tags={"Posts"},
     *     summary="Actualizar post existente",
     *     description="Actualiza un post por su ID",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del post",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PostRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post actualizado",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(response=404, description="Post no encontrado")
     * )
     */
    public function update(UpdatePostRequest $request, Post $post) {
        $post->update($request->validated());
        return new PostResource($post);
    }

    /**
     * @OA\Get(
     *     path="/api/posts/{id}",
     *     operationId="getPost",
     *     tags={"Posts"},
     *     summary="Obtener post específico",
     *     description="Retorna un post por su ID",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del post",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(response=404, description="Post no encontrado")
     * )
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

     /**
     * @OA\Delete(
     *     path="/api/posts/{id}",
     *     operationId="deletePost",
     *     tags={"Posts"},
     *     summary="Eliminar post",
     *     description="Elimina un post por su ID",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del post",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Post eliminado"),
     *     @OA\Response(response=404, description="Post no encontrado")
     * )
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->noContent();
    }
}
