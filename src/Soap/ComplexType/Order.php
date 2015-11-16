<?php

namespace DolibarPhpClient\Soap\ComplexType;

class Order extends \ArrayObject {

  public function __construct(array $data) {
    $defaults = array_fill_keys([
      'id',
      'ref',
      'ref_client',
      'ref_ext',
      'ref_int',
      'thirdparty_id',
      'status',
      'billed',
      'total_net',
      'total_vat',
      'total_localtax1',
      'total_localtax2',
      'total',
      'date',
      'date_creation',
      'date_validation',
      'date_modification',
      'remise',
      'remise_percent',
      'remise_absolue',
      'source',
      'note_private',
      'note_public',
      'project_id',
      'mode_reglement_id',
      'mode_reglement_code',
      'mode_reglement',
      'cond_reglement_id',
      'cond_reglement_code',
      'cond_reglement',
      'cond_reglement_doc',
      'date_livraison',
      'fk_delivery_address',
      'demand_reason_id',
      'lines',
    ], NULL);
    // Merge defaults.
    $data += $defaults;
    parent::__construct($data, \ArrayObject::ARRAY_AS_PROPS);
  }

}
