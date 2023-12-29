<?php
namespace app\model\tgsend_bot;

class item extends \RusaDrako\model_obj\object_item
{

	/** Настройки объекта */
	protected function setting() {

		# Ключевое поле объекта
		$this->set_column_id('id_tgsend_bot');        # ID записи

		# Остновные свойства объекта (переопределяются в процессе работы, сохраняется через save())
		# Имя поля связанной таблицы => псевдоним (имя свойства)
		$column = [
			'id_tgsend_bot'   => 'ID',
			'name'            => 'NAME',
			'tg_bot_id'       => 'TG_BOT_ID',
			'token'           => 'TOKEN',
			'date_created'    => 'DATE_CREATED',
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
		//# Вычисляемые свойства объекта (в процессе работы не могут быть переопределены)
		//$function = [
		//	'FUNC_NAME'   => function() {return $this->TITLE . $this->ID;},
		//];
		//foreach ($function as $k => $v) {
		//	$this->set_gen_data($k, $v);
		//}
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
	public function getActualTaskLine($count = 10) {
		$tgsend_task = \app\Factory::call()->getObj('model\tgsend_task');
		return $tgsend_task->getActualLine($this->ID, $count);
	}

	/**  */
	public function getBotObj() {
		$bilder_tg_bot = \app\Factory::call()->getObj('bilder\tg_bot');
		return $bilder_tg_bot->get("{$this->TG_BOT_ID}:{$this->TOKEN}");
	}

}