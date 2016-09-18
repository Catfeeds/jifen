<?php  
	class EarnModel extends RelationModel{
		protected $tableName = "Distribution_earning";
		protected $_link = array(
			'account'=>array(
				'mapping_type' => BELONGS_TO,
				'foreign_key' => 'fromid',
				'class_name' => 'Account',
			),
			'oprationer'=>array(
				'mapping_type' => BELONGS_TO,
				'foreign_key' => 'aid',
				'class_name' => 'Account',
			),
		);
	}
?>