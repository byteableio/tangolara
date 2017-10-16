<?php

namespace Byteable\Tangolara;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Byteable\Tangolara\Exceptions\TangoException;

class TangoService
{
  const ENDPOINT = "https://integration-api.tangocard.com";

  const CATALOG_RESOURCE = "/raas/v2/catalogs";

  const CUSTOMER_RESOURCE = "/raas/v2/customers";

  /**
   * @var
   */
  private $platform;

  /**
   * @var
   */
  private $key;

  /**
   * @var \GuzzleHttp\Client
   */
  private $client;

  /**
   * TangoApi constructor.
   *
   * @param null $key
   */
  public function __construct($platform = null, $key = null)
  {
    $this->platform = $platform;

    $this->key = $key;

    $this->client = new Client([
        'base_uri' => self::ENDPOINT,
        'auth' => [
          $this->platform,
          $this->key
        ]
      ]);
  }

  /**
   * TangoApi constructor.
   *
   * @param null $key
   */
   // public function getCustomer($customer = false)
   // {
   //   $resource = $customer ? self::CUSTOMER_RESOURCE . "/$customer" : self::CUSTOMER_RESOURCE;

   //   $customer = json_decode($this->request("GET", $resource), true);

   //   return $this->_collect($customer);
   // }

  /**
   * Tango catalogs.
   *
   */
  public function catalogs()
  {
    $catalogs = $this->request("GET", self::CATALOG_RESOURCE);

    return $catalogs;

    // $catalog = json_decode($this->request("GET", self::CATALOG_RESOURCE), true);

    // return $this->_collect($catalog);
  }

  public function request($method = "GET", $resource)
  {
    try {
      if ($response = $this->client->request($method, $resource)) {
        return json_decode($response->getBody(), true);
      }
    } catch (RequestException $e) {
      dd($e);
      if ($e->hasResponse()) {
        throw new TangoException('REQUEST FAILED: ' . Psr7\str($e->getResponse()));
      }
    }
  }

  /**
   * @param array $data
   *
   * @return \Illuminate\Support\Collection
   */
  private function _collect(array $array, $r = false)
  {
    if ($r) {
      foreach ($array as $key => $value) {
        if (is_array($value)) {
          $array[$key] = $this->_collect($value);
        }
      }
    }

    return collect($array);
  }
}
