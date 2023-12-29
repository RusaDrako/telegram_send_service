<?php
namespace app\model\tgsend_task_h;

class item extends \RusaDrako\model_obj\object_item
{


	/** Настройки объекта */
	protected function setting() {

		# Ключевое поле объекта
		$this->set_column_id('id_tgsend_task');        # ID записи

		# Остновные свойства объекта (переопределяются в процессе работы, сохраняется через save())
		# Имя поля связанной таблицы => псевдоним (имя свойства)
		$column = [
			'id_tgsend_task'   => 'ID',
			'tgsend_bot_id'    => 'TGSEND_BOT_ID',
			'tg_user_id'       => 'TG_USER_ID',
			'text'             => 'TEXT',
			'date_created'     => 'DATE_CREATED',
			'date_task'        => 'DATE_TASK',
			'date_sended'      => 'DATE_SENDED',
			'response'         => 'RESPONSE',
			'is_ok'            => 'IS_OK',
		];
		foreach ($column as $k => $v) {
			$this->set_column_name($k, $v);
		}

		//# Дополнительные свойства объекта (переопределяются в процессе работы, не сохраняется через save())
		//$add_prop = [
		//	'ADD_NAME'   => null,
		//];
		//foreach ($add_prop as $k => $v) {
		//	$this->set_add_data($k, $v);
		//}
		//
		# Вычисляемые свойства объекта (в процессе работы не могут быть переопределены)
		$function = [
			'RESPONSE_ARR'     => function() {return json_decode($this->RESPONSE, 1); },
		];
		foreach ($function as $k => $v) {
			$this->set_gen_data($k, $v);
		}
		//
		//# Объктные свойства объекта (в процессе работы не могут быть переопределены)
		//$object = [
		//	'OBJ_NAME'   => new \test\new_class(),
		//];
		//foreach ($object as $k => $v) {
		//	$this->set_sub_obj($k, $v);
		//}
	}

	/**  */
	public function updateData($tgsend_task) {
		$this->setProp('ID', $tgsend_task->ID);
		$this->setProp('TGSEND_BOT_ID', $tgsend_task->TGSEND_BOT_ID);
		$this->setProp('TG_USER_ID', $tgsend_task->TG_USER_ID);
		$this->setProp('TEXT', $tgsend_task->TEXT);
		$this->setProp('DATE_CREATED', $tgsend_task->DATE_CREATED);
		$this->setProp('DATE_TASK', $tgsend_task->DATE_TASK);
		$this->setProp('DATE_SENDED', $tgsend_task->DATE_SENDED);
		$this->setProp('RESPONSE', $tgsend_task->RESPONSE);
		$this->setProp('IS_OK', $tgsend_task->IS_OK);
	}

}