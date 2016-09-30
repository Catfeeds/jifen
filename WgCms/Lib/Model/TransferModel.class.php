<?php  
	class TransferModel extends RelationModel{
		protected $tableName = 'Distribution_transfer_records';
		protected $_link = array(
			'outaccount' => array(
				'mapping_type' => BELONGS_TO,
				'foreign_key' => 'rolloutId',
				'class_name' => 'Account',
			),
			'getaccount' => array(
				'mapping_type' => BELONGS_TO,
				'foreign_key' => 'intoId',
				'class_name' => 'Account',
			),
			'outagent' => array(
				'mapping_type' => BELONGS_TO,
				'foreign_key' => 'gid',
				'class_name' => 'Distribution_agent',
			),
			'fromagent' => array(
				'mapping_type' => BELONGS_TO,
				'foreign_key' => 'fromgid',
				'class_name' => 'Distribution_agent',
			),
		);
	}
?>