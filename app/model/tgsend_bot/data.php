<?php
namespace app\model\tgsend_bot;

class data extends \RusaDrako\model_obj\data_query
{

	/** Дополнительные настройки класса */
	protected function setting() {
		$this->table_name = 'tgsend_bot';
	}

}