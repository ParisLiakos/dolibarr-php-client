<?php

namespace DolibarPhpClient\Soap;

use \DolibarPhpClient\Soap\ComplexType\Contact;
use \DolibarPhpClient\Soap\ComplexType\Product;
use \DolibarPhpClient\Soap\ComplexType\ThirdParty;
use \DolibarPhpClient\Soap\ComplexType\ThirdPartyWithUser;
use \DolibarPhpClient\Soap\ComplexType\Order;
use \DolibarPhpClient\Soap\ComplexType\Invoice;

class Client {

  /**
   * Authentication details for dolibarr API.
   *
   * @param array
   */
  protected $authentication;

  /**
   * The URL to dolibar installation.
   *
   * @param string
   */
  protected $dolibarUrl;

  /**
   * List/cache of instantiated \SoapClient keyed by server name.
   *
   * @param \SoapClient[]
   */
  protected $clients;

  /**
   * @param array
   */
  protected $availableServers = [
    'user',
    'thirdparty',
    'contact',
    'productorservice',
    'order',
    'invoice',
    'supplier_invoice',
    'actioncomm',
    'category',
    'other',
  ];

  /**
   * Creates a new SOAP Dolibarr client.
   *
   * @param string $dolibarUrl
   *   The URL in which dolibarr's webservices folder can be found.
   * @param string $username
   *   The username to login with.
   * @param string $password
   *   The password to login with.
   * @param string $apiKey
   *   The key set in dolibarr backend.
   * @param array $enabledServers
   *   An array of enabled servers. If not specified all servers will be enabled
   */
  public function __construct($dolibarUrl, $username, $password, $apiKey = '') {
    $this->authentication = [
      'dolibarrkey' => $apiKey,
      'sourceapplication' => __CLASS__,
      'login' => $username,
      'password' => $password,
      'entity' => '',
    ];
    $this->dolibarUrl = rtrim($dolibarUrl, '/');
  }

  /**
   * Get a \SoapClient of a specific server endpoint.
   *
   * @param string $server
   *   The name of the server. eg 'user' or 'productorservice'.
   *
   * @return \SoapClient
   */
  protected function getClientForServer($server) {
    if (!isset($this->clients[$server])) {
      if (!in_array($server, $this->availableServers)) {
        throw new \InvalidArgumentException('Server is either disabled or doesnt exist');
      }

      $url = $this->dolibarUrl . '/webservices/server_' . $server . '.php?wsdl';
      $client = new \SoapClient($url);
      // Dolibarr webservice api is bugged when used under https.
      $client->__setLocation($url);
      $this->clients[$server] = $client;
    }

    return $this->clients[$server];
  }

  /**
   * @return mixed
   */
  protected function parseResponse(array $response, $returnKey) {
    if ($response['result']->result_code !== 'OK') {
      throw new \RuntimeException($response['result']->result_code . ': ' . $response['result']->result_label);
    }

    if (array_key_exists($returnKey, $response)) {
      return $response[$returnKey];
    }

    return NULL;
  }

  /**
   * @return \stdClass|null
   */
  public function getUser($id = '', $ref = '', $refExt = '') {
    $response = $this->getClientForServer('user')
      ->getUser($this->authentication, $id, $ref, $refExt);

    return $this->parseResponse($response, 'user');
  }

  /**
   * @return array
   */
  public function getListOfGroups() {
    $response = $this->getClientForServer('user')
      ->getListOfGroups($this->authentication);

    return $this->parseResponse($response, 'groups');
  }

  /**
   * @return int
   *   The created id.
   */
  public function createUserFromThirdparty(ThirdPartyWithUser $user) {
    $response = $this->getClientForServer('user')
      ->createUserFromThirdparty($this->authentication, $user);

    return $this->parseResponse($response, 'id');
  }

  /**
   * @return bool
   */
  public function setUserPassword($login, $password) {
    $short_user = array(
      'login' => $login,
      'password' => $password,
      'entity' => '',
    );
    $response = $this->getClientForServer('user')
      ->setUserPassword($this->authentication, $short_user);

    return $this->parseResponse($response, 'id');
  }

  /**
   * @return \DolibarPhpClient\Soap\ComplexType\ThirdParty
   */
  public function getThirdParty($id = '', $ref = '', $refExt = '') {
    $response = $this->getClientForServer('thirdparty')
      ->getThirdParty($this->authentication, $id, $ref, $refExt);

    $return = $this->parseResponse($response, 'thirdparty');
    if (is_object($return)) {
      $object = new ThirdParty((array) $return);
      $return = $object;
    }

    return $return;
  }

  /**
   * @return int
   *   The created id.
   */
  public function createThirdParty(ThirdParty $thirdParty) {
    $response = $this->getClientForServer('thirdparty')
      ->createThirdParty($this->authentication, $thirdParty);

    return $this->parseResponse($response, 'id');
  }

  /**
   * @return int
   *   The updated id.
   */
  public function updateThirdParty(ThirdParty $thirdParty) {
    $response = $this->getClientForServer('thirdparty')
      ->updateThirdParty($this->authentication, $thirdParty);

    return $this->parseResponse($response, 'id');
  }

  /**
   * @return \DolibarPhpClient\Soap\ComplexType\ThirdParty[]
   */
  public function getListOfThirdParties() {
    $response = $this->getClientForServer('thirdparty')
      ->getListOfThirdParties($this->authentication);

    $return = $this->parseResponse($response, 'thirdparties');

    if (is_array($return)) {
      $objects = [];
      foreach ($return as $data) {
        $objects[] = new ThirdParty((array) $data);
      }
      $return = $objects;
    }

    return $return;
  }

  /**
   * @return int
   *   The deleted id.
   */
  public function deleteThirdParty($id = '', $ref = '', $refExt = '') {
    $response = $this->getClientForServer('thirdparty')
      ->deleteThirdParty($this->authentication, $id, $ref, $refExt);

    return $this->parseResponse($response, 'id');
  }

  /**
   * @return \DolibarPhpClient\Soap\ComplexType\Contact
   */
  public function getContact($id = '', $ref = '', $refExt = '') {
    $response = $this->getClientForServer('contact')
      ->getContact($this->authentication, $id, $ref, $refExt);

    $return = $this->parseResponse($response, 'contact');
    if (is_object($return)) {
      $object = new Contact((array) $return);
      $return = $object;
    }

    return $return;
  }

  /**
   * @return int
   *   The created id.
   */
  public function createContact(Contact $contact) {
    $response = $this->getClientForServer('contact')
      ->createContact($this->authentication, $contact);

    return $this->parseResponse($response, 'id');
  }

  /**
   * @return array
   */
  public function getContactsForThirdParty($thirdPartyId) {
    $response = $this->getClientForServer('contact')
      ->getContactsForThirdParty($this->authentication, $thirdPartyId);

    $return = $this->parseResponse($response, 'contacts');
    if (is_array($return)) {
      $objects = [];
      foreach ($return as $data) {
        $objects[] = new Contact((array) $data);
      }
      $return = $objects;
    }

    return $return;
  }

  /**
   * @return int
   *   The updated id.
   */
  public function updateContact(Contact $contact) {
    $response = $this->getClientForServer('contact')
      ->updateContact($this->authentication, $contact);

    return $this->parseResponse($response, 'id');
  }

  /**
   * @return \DolibarPhpClient\Soap\ComplexType\Product
   */
  public function getProductOrService($id = '', $ref = '', $refExt = '') {
    $response = $this->getClientForServer('productorservice')
      ->getProductOrService($this->authentication, $id, $ref, $refExt);

    $return = $this->parseResponse($response, 'product', 'service');
    if (is_object($return)) {
      $object = new Product((array) $return);
      $return = $object;
    }

    return $return;
  }

  /**
   * @return int
   *   The created id.
   */
  public function createProductOrService(Product $product) {
    $response = $this->getClientForServer('productorservice')
      ->createProductOrService($this->authentication, $product);

    return $this->parseResponse($response, 'id');
  }

  /**
   * @return int
   *   The updated id.
   */
  public function updateProductOrService(Product $product) {
    $response = $this->getClientForServer('productorservice')
      ->updateProductOrService($this->authentication, $product);

    return $this->parseResponse($response, 'id');
  }

  /**
   * @return int
   *   Number of deleted entries.
   */
  public function deleteProductOrService($ids) {
    $response = $this->getClientForServer('productorservice')
      ->deleteThirdParty($this->authentication, $ids);

    return $this->parseResponse($response, 'nbdeleted');
  }

  /**
   * @return array
   *   An array of ids and refs.
   */
  public function getListOfProductsOrServices($type = '', $statusToBuy = '', $statusToSell = '') {
    $filter = [
      'type' => $type,
      'status_tobuy' => $statusToBuy,
      'status_tosell' => $statusToSell,
    ];
    $response = $this->getClientForServer('productorservice')
      ->getListOfProductsOrServices($this->authentication, $filter);

    return $this->parseResponse($response, 'products');
  }

  /**
   * @return \DolibarPhpClient\Soap\ComplexType\Order
   */
  public function getOrder($id = '', $ref = '', $refExt = '') {
    $response = $this->getClientForServer('order')
      ->getOrder($this->authentication, $id, $ref, $refExt);

    $return = $this->parseResponse($response, 'order');
    if (is_object($return)) {
      $object = new Order((array) $return);
      $return = $object;
    }

    return $return;
  }

  /**
   * @return \DolibarPhpClient\Soap\ComplexType\Order[]
   */
  public function getOrdersForThirdParty($thirdPartyId) {
    $response = $this->getClientForServer('order')
      ->getOrdersForThirdParty($this->authentication, $thirdPartyId);

    $return = $this->parseResponse($response, 'orders');
    if (is_array($return)) {
      $objects = [];
      foreach ($return as $data) {
        $objects[] = new Order((array) $data);
      }
      $return = $objects;
    }

    return $return;
  }

  /**
   * @return int
   *   The created id.
   */
  public function createOrder(Order $order) {
    $response = $this->getClientForServer('order')
      ->createOrder($this->authentication, $order);

    return $this->parseResponse($response, 'id');
  }

  /**
   * @return int
   *   The updated id.
   */
  public function updateOrder(Order $order) {
    $response = $this->getClientForServer('order')
      ->updateOrder($this->authentication, $order);

    return $this->parseResponse($response, 'id');
  }

  /**
   * Validate an order.
   *
   * @return bool
   */
  public function validOrder($id) {
    $response = $this->getClientForServer('order')
      ->validOrder($this->authentication, $id);

    return $this->parseResponse($response, 'result');
  }

  /**
   * @return \DolibarPhpClient\Soap\ComplexType\Invoice
   */
  public function getInvoice($id = '', $ref = '', $refExt = '') {
    $response = $this->getClientForServer('invoice')
      ->getInvoice($this->authentication, $id, $ref, $refExt);

    $return = $this->parseResponse($response, 'invoice');
    if (is_object($return)) {
      $object = new Invoice((array) $return);
      $return = $object;
    }

    return $return;
  }

  /**
   * @return \DolibarPhpClient\Soap\ComplexType\Invoice[]
   */
  public function getInvoicesForThirdParty($thirdPartyId) {
    $response = $this->getClientForServer('invoice')
      ->getInvoicesForThirdParty($this->authentication, $thirdPartyId);

    $return = $this->parseResponse($response, 'invoices');
    if (is_array($return)) {
      $objects = [];
      foreach ($return as $data) {
        $objects[] = new Invoice((array) $data);
      }
      $return = $objects;
    }

    return $return;
  }

  /**
   * This api method is currently broken.
   *
   * @return \DolibarPhpClient\Soap\ComplexType\Invoice
   */
  public function createInvoiceFromOrder($orderId = '', $orderRef ='', $orderRefExt = '') {
    $response = $this->getClientForServer('invoice')
      ->createInvoiceFromOrder($this->authentication, $orderId, $orderRef, $orderRefExt);

    $return = $this->parseResponse($response, 'invoice');
    if (is_object($return)) {
      $object = new Invoice((array) $return);
      $return = $object;
    }

    return $return;
  }

  /**
   * @return int
   *   The updated id.
   */
  public function updateInvoice(Invoice $invoice) {
    $response = $this->getClientForServer('invoice')
      ->updateInvoice($this->authentication, $invoice);

    return $this->parseResponse($response, 'id');
  }

  /**
   * @return \stdClass
   */
  public function getSupplierInvoice($id = '', $ref = '', $refExt = '') {
    $response = $this->getClientForServer('supplier_invoice')
      ->getSupplierInvoice($this->authentication, $id, $ref, $refExt);

    return $this->parseResponse($response, 'invoice');
  }

  /**
   * @return \stdClass[]
   */
  public function getSupplierInvoicesForThirdParty($thirdPartyId) {
    $response = $this->getClientForServer('supplier_invoice')
      ->getSupplierInvoicesForThirdParty($this->authentication, $thirdPartyId);

    return $this->parseResponse($response, 'invoices');
  }

  /**
   * @return \stdClass[]
   */
  public function getListActionCommType() {
    $response = $this->getClientForServer('actioncomm')
      ->getListActionCommType($this->authentication);

    return $this->parseResponse($response, 'actioncommtypes');
  }

  /**
   * @return \stdClass
   */
  public function getActionComm($id) {
    $response = $this->getClientForServer('actioncomm')
      ->getActionComm($this->authentication, $id);

    return $this->parseResponse($response, 'actioncomm');
  }

  /**
   * Untested.
   *
   * @return int
   *   The created id.
   */
  public function createActionComm($action) {
    $response = $this->getClientForServer('actioncomm')
      ->createActionComm($this->authentication, $action);

    return $this->parseResponse($response, 'id');
  }

  /**
   * Untested.
   *
   * @return int
   *   The updated id.
   */
  public function updateActionComm($action) {
    $response = $this->getClientForServer('actioncomm')
      ->updateInvoice($this->authentication, $action);

    return $this->parseResponse($response, 'id');
  }

  /**
   * @return \stdClass
   */
  public function getCategory($id) {
    $response = $this->getClientForServer('category')
      ->getCategory($this->authentication, $id);

    return $this->parseResponse($response, 'categorie');
  }

  /**
   * @return \stdClass
   */
  public function getVersions() {
    $response = $this->getClientForServer('other')
      ->getVersions($this->authentication);

    $this->parseResponse($response);
    unset($response['result']);

    return $response;
  }

  /**
   * @return \stdClass
   */
  public function getDocument($modulePart, $file) {
    $response = $this->getClientForServer('other')
      ->getDocument($this->authentication, $modulePart, $file);

    return $this->parseResponse($response, 'document');
  }

}
