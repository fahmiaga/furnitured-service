<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipientResource;
use App\Services\PostService;
use App\Services\DeleteService;
use App\Services\PutService;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecipientController extends Controller
{

    public function __construct(PostService $postService, Recipient $recipient, PutService $putService, DeleteService $deleteService)
    {
        $this->postService = $postService;
        $this->recipient = $recipient;
        $this->postService = $postService;
        $this->putService = $putService;
        $this->deleteService = $deleteService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->recipient->getRecipient();
        return  RecipientResource::collection($data);
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

        $data = $request->all();
        $this->postService->postRecipient($data);

        return response([
            'message' => 'Data successfully created',
            'status' => Response::HTTP_CREATED
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipient  $recipient
     * @return \Illuminate\Http\Response
     */
    public function show(Recipient $recipient)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipient  $recipient
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipient $recipient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipient  $recipient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipient $recipient)
    {
        // dd($request->all());
        $this->putService->putRecipient($request, $recipient);

        return response([

            'message' => 'Data successfully updated',
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipient  $recipient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipient $recipient)
    {
        $this->deleteService->deleteRecipient($recipient);

        return response([

            'message' => 'Data successfully deleted',
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }
}
