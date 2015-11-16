<?php

namespace DolibarPhpClient\Soap\ComplexType;

class ThirdParty extends \ArrayObject {

  public function __construct(array $data) {
    $defaults = array_fill_keys([
      'id' => NULL,
      'ref' => NULL,
      'ref_ext' => NULL,
      'fk_user_author' => NULL,
      'status' => NULL,
      'client' => NULL,
      'supplier' => NULL,
      'customer_code' => NULL,
      'supplier_code' => NULL,
      'customer_code_accountancy' => NULL,
      'supplier_code_accountancy' => NULL,
      'date_creation' => NULL,
      'date_modification' => NULL,
      'note_private' => NULL,
      'note_public' => NULL,
      'address' => NULL,
      'zip' => NULL,
      'town' => NULL,
      'province_id' => NULL,
      'country_id' => NULL,
      'country_code' => NULL,
      'country' => NULL,
      'phone' => NULL,
      'fax' => NULL,
      'email' => NULL,
      'url' => NULL,
      'profid1' => NULL,
      'profid2' => NULL,
      'profid3' => NULL,
      'profid4' => NULL,
      'profid5' => NULL,
      'profid6' => NULL,
      'capital' => NULL,
      'vat_used' => NULL,
      'vat_number' => NULL,
    ], NULL);
    // Merge defaults.
    $data += $defaults;
    parent::__construct($data, \ArrayObject::ARRAY_AS_PROPS);
  }

}
