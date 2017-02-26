<?php

namespace DolibarPhpClient\Soap\ComplexType;

class ThirdParty extends \ArrayObject
{

    public function __construct(array $data)
    {
        $defaults = array_fill_keys([
            'id',
            'ref',
            'ref_ext',
            'fk_user_author',
            'status',
            'client',
            'supplier',
            'customer_code',
            'supplier_code',
            'customer_code_accountancy',
            'supplier_code_accountancy',
            'date_creation',
            'date_modification',
            'note_private',
            'note_public',
            'address',
            'zip',
            'town',
            'province_id',
            'country_id',
            'country_code',
            'country',
            'phone',
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
            'vat_used',
            'vat_number',
        ], null);
        // Merge defaults.
        $data += $defaults;
        parent::__construct($data, \ArrayObject::ARRAY_AS_PROPS);
    }
}
