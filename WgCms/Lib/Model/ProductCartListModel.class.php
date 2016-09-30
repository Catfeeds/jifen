<?php  
	class ProductCartListModel extends RelationModel{
		protected $tableName = 'Product_cart_list';
		protected $_link = array(
			'cart' =>array(
				'mapping_type' => BELONGS_TO,
				'foreign_key' => 'cartid',
				'class_name' => 'Product_cart',
				'mapping_fields' => 'paid',

			),
			'product' => array(
				'mapping_type' => BELONGS_TO,
				'foreign_key' => 'productid',
				'class_name' => 'Product',
			),
			'account' => array(
				'mapping_type' => BELONGS_TO,
				'foreign_key' => 'aid',
				'class_name' => 'Account',
			),
		);
	}
?>