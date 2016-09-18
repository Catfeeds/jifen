<?php  
	class AgentTransferModel extends RelationModel{
		protected $tableName = "Agent_transfer_records";
		protected $_link = array(
			'agent'=>array(
				'mapping_type' => BELONGS_TO,
				'foreign_key' => 'gid',
				'class_name' => 'Distribution_agent',
			),
			'account'=>array(
				'mapping_type' => BELONGS_TO,
				'foreign_key' => 'aid',
				'class_name' => 'Account',
			),
		);
	}
?>