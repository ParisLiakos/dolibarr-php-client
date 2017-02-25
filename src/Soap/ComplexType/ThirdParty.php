<?php

namespace DolibarPhpClient\Soap\ComplexType;

class ThirdParty extends \ArrayObject
{

    public function __construct(array $data)
    {
        $defaults = array_fill_keys([
            'id' => null,
            'ref' => null,
            'ref_ext' => null,
            'fk_user_author' => null,
            'status' => null,
            'client' => null,
            'supplier' => null,
            'customer_code' => null,
            'supplier_code' => null,
            'customer_code_accountancy' => null,
            'supplier_code_accountancy' => null,
            'date_creation' => null,
            'date_modification' => null,
            'note_private' => null,
            'note_public' => null,
            'address' => null,
            'zip' => null,
            'town' => null,
            'province_id' => null,
            'country_id' => null,
            'country_code' => null,
            'country' => null,
            'phone' => null,
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
            'vat_used' => null,
            'vat_number' => null,
        ], null);
        // Merge defaults.
        $data += $defaults;
        parent::__construct($data, \ArrayObject::ARRAY_AS_PROPS);
    }
}
