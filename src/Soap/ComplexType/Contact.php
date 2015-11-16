<?php

namespace DolibarPhpClient\Soap\ComplexType;

class Contact extends \ArrayObject {

  public function __construct(array $data) {
    $defaults = array_fill_keys([
      'id' => NULL,
      'ref_ext' => NULL,
      'lastname' => NULL,
      'firstname' => NULL,
      'address' => NULL,
      'zip' => NULL,
      'town' => NULL,
      'state_id' => NULL,
      'state_code' => NULL,
      'state' => NULL,
      'country_id' => NULL,
      'country_code' => NULL,
      'country' => NULL,
      'socid' => NULL,
      'status' => NULL,
      'phone_pro' => NULL,
      'fax' => NULL,
      'phone_perso' => NULL,
      'phone_mobile' => NULL,
      'code' => NULL,
      'email' => NULL,
      'birthday' => NULL,
      'default_lang' => NULL,
      'note' => NULL,
      'no_email' => NULL,
      'ref_facturation' => NULL,
      'ref_contrat' => NULL,
      'ref_commande' => NULL,
      'ref_propal' => NULL,
      'user_id' => NULL,
      'user_login' => NULL,
      'civility_id' => NULL,
      'poste' => NULL,
    ], NULL);
    // Merge defaults.
    $data += $defaults;
    parent::__construct($data, \ArrayObject::ARRAY_AS_PROPS);
  }

}
