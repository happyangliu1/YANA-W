<?php
class InquiryModel extends RelationModel{

	Protected $_link = array(
		'product' => array(
			'mapping_type' => BELONGS_TO,
			'foreign_key' => 'pid',
			'as_fields'=>'thumb,name:product_name',
			)
		);






}
?>