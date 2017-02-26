<?php

namespace DolibarPhpClient\Soap\ComplexType;

class ThirdPartyWithUser extends \ArrayObject
{

    public function __construct(array $data)
    {
        $defaults = array_fill_keys([
            'name',
            'firstname',
            'name_thirdparty',
            'ref_ext',
            'client',
            'fournisseur',
            'address',
            'zip',
            'town',
            'country_id',
            'country_code',
            'phone',
            'phone_mobile',
            'fax',
            'email',
            'url',
            'profid1',
            'profid2',
            'profid3',
            'profid4',
            'profid5',
            'profid6',
            'capital',
            'tva_assuj',
            'tva_intra',
            'login',
            'password',
            'group_id',
        ], null);
        // Merge defaults.
        $data += $defaults;
        parent::__construct($data, \ArrayObject::ARRAY_AS_PROPS);
    }
}
