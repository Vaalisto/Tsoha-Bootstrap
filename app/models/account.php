<?php
	class Account extends BaseModel{
		public $id, $accountname, $password, $is_admin;

		public function __construct($attributes){
			parent::__construct($attributes);
			$this->validators = array('validate_name');
		}

		public function validate_name(){
			
		}

	}