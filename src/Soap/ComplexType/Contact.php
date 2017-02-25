<?php

namespace DolibarPhpClient\Soap\ComplexType;

class Contact extends \ArrayObject
{

    public function __construct(array $data)
    {
        $defaults = array_fill_keys([
            'id' => null,
            'ref_ext' => null,
            'lastname' => null,
            'firstname' => null,
            'address' => null,
            'zip' => null,
            'town' => null,
            'state_id' => null,
            'state_code' => null,
            'state' => null,
            'country_id' => null,
            'country_code' => null,
            'country' => null,
            'socid' => null,
            'status' => null,
            'phone_pro' => null,
            'fax' => null,
            'phone_perso' => null,
            'phone_mobile' => null,
            'code' => null,
            'email' => null,
            'birthday' => null,
            'default_lang' => null,
            'note' => null,
            'no_email' => null,
            'ref_facturation' => null,
            'ref_contrat' => null,
            'ref_commande' => null,
            'ref_propal' => null,
            'user_id' => null,
            'user_login' => null,
            'civility_id' => null,
            'poste' => null,
        ], null);
        // Merge defaults.
        $data += $defaults;
        parent::__construct($data, \ArrayObject::ARRAY_AS_PROPS);
    }
}
