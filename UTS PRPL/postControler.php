<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Semua Posts',
            'data' => $posts
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ],
            [
                'title.required' => 'Masukkan Title Post !',
                'content.required' => 'Masukkan Content Post !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $post = Post::create([
                'title'     => $request->input('title'),
                'content'   => $request->input('content')
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Gagal Disimpan!',
                ], 401);
            }
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $post = Post::whereId($id)->first();


        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Post!',
                'data'    => $post
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Tidak Ditemukan!',
                'data'    => ''
            ], 401);
        }
    }
}