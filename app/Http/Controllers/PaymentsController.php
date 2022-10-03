<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class PaymentsController extends Controller
{
    public function success()
    {
        return view('payments.success', [
            'title' => 'Pomyślna płatność',
        ]);
    }

    public function error()
    {
        return view('payments.error', [
            'title' => 'błąd płatności',
        ]);
    }

    public function notification()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $client = new Client();

        try {
            $response = $client->request("PUT", 'https://secure.przelewy24.pl/api/v1/transaction/verify', [
                'auth' => [
                    config('payments.merchant_id'),
                    config('payments.api_key')
                ],
                'form_params' => [
                    'merchantId' => config('payments.merchant_id'),
                    'posId' => (int) config('payments.pos_id'),
                    'sessionId' => $data['sessionId'],
                    'amount' => $data['amount'],
                    'currency' => $data['currency'],
                    'orderId' => (int) $data['orderId'],
                    'sign' => hash('sha384', json_encode([
                        'sessionId' => (string) $data['sessionId'],
                        'orderId' => (int) $data['orderId'],
                        'amount' => (int) $data['amount'],
                        'currency' => 'PLN',
                        'crc' => (string) config('payments.crc'),
                    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)),
                ]
            ]);

            $res = json_decode($response->getBody()->getContents(), true);

            if(isset($res['data']['status']) == $res['data']['status'] = "success")
            {
                $payments = Payments::find($data['sessionId']);
                $payments->update([
                    'status' => 1,
                ]);

                $payments->order()->first()->update([
                    'status' => 1,
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("Payments controller's try error");
            LOG::error($exception);
        }
    }
}
