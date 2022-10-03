<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Payments extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->hasMany('App\Models\User', 'id', 'user_id');
    }

    public function order()
    {
        return $this->hasMany('App\Models\Orders', 'id', 'order_id');
    }

    public function registerTransfer()
    {
        $client = new Client();

        try {
            $response = $client->request("POST", 'https://secure.przelewy24.pl/api/v1/transaction/register', [
                'auth' => [
                    config('payments.merchant_id'),
                    config('payments.api_key')
                ],
                'form_params' => [
                    'merchantId' => config('payments.merchant_id'),
                    'posId' => config('payments.pos_id'),
                    'sessionId' => $this->id,
                    'amount' => (int) $this->sum * 100,
                    'currency' => 'PLN',
                    'description' => 'order #'.$this->id,
                    'email' => $this->user()->first()->email,
                    'country' => 'PL',
                    'language' => 'pl',
                    'urlReturn' => route('payments.success'),
                    'urlStatus' => route('payments.notification'),
                    'sign' => hash('sha384', json_encode([
                        'sessionId' => (string) $this->id,
                        'merchantId' => config('payments.merchant_id'),
                        'amount' => (int) $this->sum * 100,
                        'currency' => 'PLN',
                        'crc' => config('payments.crc'),
                    ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)),
                ]
            ]);

            $res = json_decode($response->getBody()->getContents(), true);

            return $res['data']['token'];
        } catch (\Exception $exception) {
            Log::error($exception->getResponse()->getBody()->getContents());
        }

        return false;
    }
}
