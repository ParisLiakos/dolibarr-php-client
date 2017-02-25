<?php

namespace DolibarPhpClient\Soap\ComplexType;

class ThirdPartyWithUser extends \ArrayObject
{

    public function __construct(array $data)
    {
        $defaults = array_fill_keys([
            'name' => null,
            'firstname' => null,
            'name_thirdparty' => null,
            'ref_ext' => null,
            'client' => null,
            'fournisseur' => null,
            'address' => null,
            'zip' => null,
            'town' => null,
            'country_id' => null,
            'country_code' => null,
            'phone' => null,
            'phone_mobile' => null,
            'fax' => null,
            'email' => null,
            'url' => null,
            'profid1' => null,
            'profid2' => null,
            'profid3' => null,
            'profid4' => null,
            'profid5' => null,
            'profid6' => null,
            'capital' => null,
            'tva_assuj' => null,
            'tva_intra' => null,
            'login' => null,
            'password' => null,
            'group_id' => null,
        ], null);
        // Merge defaults.
        $data += $defaults;
        parent::__construct($data, \ArrayObject::ARRAY_AS_PROPS);
    }
}
