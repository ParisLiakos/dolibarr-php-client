<?php

namespace DolibarPhpClient\Soap\ComplexType;

class ThirdPartyWithUser extends \ArrayObject {

  public function __construct(array $data) {
    $defaults = array_fill_keys([
      'name' => NULL,
      'firstname' => NULL,
      'name_thirdparty' => NULL,
      'ref_ext' => NULL,
      'client' => NULL,
      'fournisseur' => NULL,
      'address' => NULL,
      'zip' => NULL,
      'town' => NULL,
      'country_id' => NULL,
      'country_code' => NULL,
      'phone' => NULL,
      'phone_mobile' => NULL,
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
      'tva_assuj' => NULL,
      'tva_intra' => NULL,
      'login' => NULL,
      'password' => NULL,
      'group_id' => NULL,
    ], NULL);
    // Merge defaults.
    $data += $defaults;
    parent::__construct($data, \ArrayObject::ARRAY_AS_PROPS);
  }

}
