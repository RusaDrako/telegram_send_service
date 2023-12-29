<?php
namespace app\model\tgsend_task;

use RusaDrako\debug\DebugExpansion;

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
			'RESPONSE_ARR'   => function() {return json_decode($this->RESPONSE, 1); },
			'TG_RESPONSE_ARR'   => function() {return json_decode($this->RESPONSE, 1); },
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

	protected $bot = false;

	/**  */
	public function setBot($bot) {
		$this->bot = $bot;
		$this->setProp('TGSEND_BOT_ID', $bot->ID);
	}

	/**  */
	public function getBot() {
		if ($this->bot == false) {
			$tgsend_bot_data = \app\Factory::call()->getObj('model\tgsend_bot');
			$bot = $tgsend_bot_data->getByKey($this->TGSEND_BOT_ID);
			$this->setBot($bot);
		}
		return $this->bot;
	}



	/**  */
	public function send() {

		$bot = $this->getBot()->getBotObj();
		$bot->send($this->TG_USER_ID, $this->TEXT);

		$this->setProp('DATE_SENDED', date('Y-m-d H:i:s'));
		$this->setProp('RESPONSE', json_encode(['ok'=>1]));
		$this->setProp('IS_OK', 1);

		$tgsend_task_h = \app\Factory::call()->getObj('model\tgsend_task_h');
		$new_tgsend_task_h = $tgsend_task_h->getByKeyOrNew($this->ID);
		$new_tgsend_task_h->updateData($this);
		$new_tgsend_task_h->save();
		return 1;//$tgsend_task->getActualLine($this->ID, $count);
	}

}