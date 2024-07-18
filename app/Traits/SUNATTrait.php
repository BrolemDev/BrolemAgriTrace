<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait SUNATTrait
{
  public function searchRUC($doc, $number)
  {
    $token = 'apis-token-7724.S9zmK92N7Az91aMz8i72TxaaDeis7cmp';

    // Determinar la URL basada en el tipo de documento
    $url = ($doc == 6) ? 'https://api.apis.net.pe/v2/sunat/ruc' : 'https://api.apis.net.pe/v2/reniec/dni';

    $response = Http::withOptions([
      'verify' => false,
    ])->withHeaders([
      'Authorization' => 'Bearer ' . $token,
      'Referer' => 'https://apis.net.pe/api-consulta-ruc',
      'User-Agent' => 'laravel/guzzle',
      'Accept' => 'application/json',
    ])->get($url, [
      'numero' => $number,
    ]);

    return $response->json();
  }
}
