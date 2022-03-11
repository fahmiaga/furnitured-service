<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipientResource;
use App\Models\Cart;
use App\Models\City;
use App\Models\Province;
use App\Services\PostService;
use App\Services\DeleteService;
use App\Services\PutService;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

        return response([
            'data' => $recipient,
            'message' => 'success',
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
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

    public function getProvince()
    {
        $provinces = Province::all();
        return response([
            'data' => $provinces,
            'message' => 'success',
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    public function getCity($id)
    {
        $cities = City::where('province_id', $id)->get();
        return response([
            'data' => $cities,
            'message' => 'success',
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    public function checkShipping(Request $request)
    {
        // $input = $request->all();
        $recipient = Recipient::find($request->recipient_id)->first();
        $cart = Cart::find($request->cart_id);

        $origin = 457;
        $weight = strval($cart->product()->first()->weight * $cart->quantity);

        // $weight = 8000;

        $destination = $recipient->city_id;
        $courier = $request->courier;

        $data = [];
        $couriers = ['jne', 'pos', 'tiki'];

        foreach ($couriers as $courier) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded",
                    "key: 4c6b08a7598998c44df1416b9f844953"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);


            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $response = json_decode($response, true);
                $data_ongkir = $response['rajaongkir']['results'];
                // return $data_ongkir;
                array_push($data, $data_ongkir);
                // return response($data_ongkir);
                // return json_decode($response);
            }
        }
        Cache::put('shipping', json_encode($data));
        return response($data);
    }

    public function checkCost(Request $request)
    {
        // $shipping_cost =  json_decode(Cache::get('shipping'), true);
        // dd($shipping_cost);
        // $shipping_option = $shipping_cost[0]['costs'];

        // $cost = null;

        // foreach ($shipping_option as $sh) {
        //     if ($request->service == $sh['service']) {
        //         $cost = $sh['cost'][0]['value'];
        //     };
        // }

        $cart = Cart::find($request->cart_id);

        $cart->update(['shipping_cost' => $request->cost, 'courier' => $request->courier]);

        return response([
            'message' => 'success',
            'status' => Response::HTTP_OK,
        ]);
    }
}
