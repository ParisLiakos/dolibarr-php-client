<?php

namespace DolibarPhpClient\Soap\ComplexType;

class Contact extends \ArrayObject
{

    public function __construct(array $data)
    {
        $defaults = array_fill_keys([
            'id',
            'ref_ext',
            'lastname',
            'firstname',
            'address',
            'zip',
            'town',
            'state_id',
            'state_code',
            'state',
            'country_id',
            'country_code',
            'country',
            'socid',
            'status',
            'phone_pro',
            'fax',
            'phone_perso',
            'phone_mobile',
            'code',
            'email',
            'birthday',
            'default_lang',
            'note',
            'no_email',
            'ref_facturation',
            'ref_contrat',
            'ref_commande',
            'ref_propal',
            'user_id',
            'user_login',
            'civility_id',
            'poste',
        ], null);
        // Merge defaults.
        $data += $defaults;
        parent::__construct($data, \ArrayObject::ARRAY_AS_PROPS);
    }
}
