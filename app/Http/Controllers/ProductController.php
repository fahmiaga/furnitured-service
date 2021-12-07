<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Image;
use App\Services\PostService;
use App\Models\Product;
use App\Services\DeleteService;
use App\Services\PutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function __construct(PostService $postService, PutService $putService, DeleteService $deleteService)
    {
        $this->postService = $postService;
        $this->putService = $putService;
        $this->deleteService = $deleteService;
        $this->middleware('is_admin')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'data' => Product::all(),
            'message' => 'success',
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $this->postService->post($request);

        return response([
            'data' => $product,
            'message' => 'Data successfully created',
            'status' => Response::HTTP_CREATED
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $newProduct = $this->putService->put($request, $product);

        return response([
            'data' => $newProduct,
            'message' => 'Data successfully updated',
            'status' => Response::HTTP_CREATED
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->deleteService->delete($product);
        return response([
            'message' => 'Data successfully deleted',
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    public function addImage(Request $request, Image $image, $id)
    {
        $images = $request->file('image_name');

        $image->addMultipleImage($images, $id);

        return response([
            'message' => 'Image successfully added',
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    public function deleteImage($id)
    {
        $image = Image::find($id);
        Storage::delete(substr("posts-image/$image->image_name", 12));
        Image::destroy($image->id);

        return response([
            'message' => 'Image successfully deleted',
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }
}
