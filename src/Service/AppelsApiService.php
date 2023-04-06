<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class AppelsApiService
{
    private $client;
    private $parameterBag;

    public function __construct(HttpClientInterface $client, ParameterBagInterface $parameterBag)
    {
        $this->client = $client;
        $this->parameterBag = $parameterBag;
    }

    public function recuperationDonneesApi(int $siren): array
    {
        $response = $this->client->request(
            'GET',
            "https://api.insee.fr/entreprises/sirene/V3/siret?q=siren:{$siren}",
            [
                'auth_bearer' => $this->parameterBag->get('APP_TOKEN'),
              /*   'query' => [
                    'siren' => '511361073',
                ], */
            ]
        );

        return $response->toArray();
    }
}
