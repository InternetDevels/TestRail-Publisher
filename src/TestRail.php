<?php

namespace Idevels\Package;

use GuzzleHttp;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Idevels\Package\TestRailAPIClient;
use GuzzleHttp\Psr7;

class TestRail {

  protected $username;
  protected $password;

  const API_ROUTE = "http://docs.com/testrail-api2/start";

  /**
   * @var $instance
   *   The reference to *Singleton* instance of this class.
   */
  protected static $instance = NULL;

  /**
   * Protected constructor to prevent creating a new instance of the
   * *Singleton* via the `new` operator from outside of this class.
   */
  public function __construct() {
    $this->client = self::getInstance();
  }

  /**
   * Returns the *Singleton* instance of this class.
   */
  public static function getInstance() {
    if (is_null(self::$instance)) {
      $client = new TestRailAPIClient('https://example.testrail.net');
      $client->set_user('example@example.com');
      $client->set_password('API_KEY');
      self::$instance = $client;
    }
    return self::$instance;
  }

  /**
   * Common point of TestRail API calls.
   * @param $callback
   * @param $method
   * @param array $params
   * @return \Psr\Http\Message\StreamInterface
   */
  protected function apiCall($callback, $method, array $params = array()) {
    $client = new GuzzleHttp\Client();
    try {
      $uri = "https://medion.testrail.net/index.php?/api/v2/{$callback}";
      if (!empty($params['query'])) {
        $uri = $uri . '&' . http_build_query($params['query']);
      }
      $request = $client->request($method, $uri, array(
        'auth' => array('example@example.com', 'API_KEY'),
        'headers' => array(
          'Content-Type' => 'application/json',
        ),
      ));
      $response = $request->getBody()->getContents();
    } catch (RequestException $e) {
      $response = $e->getResponse()->getBody();
    }
    return $response;
  }

  /**
   * Private clone method to prevent cloning of the instance of the
   * *Singleton* instance.
   *
   * @return void
   */
  private function __clone() {}

  /**
   * Private unserialize method to prevent unserializing of the *Singleton*
   * instance.
   *
   * @return void
   */
  private function __wakeup() {}
}
