<?php


namespace app;


class Factory extends \RusaDrako\model_obj\factory
{
	protected $app;

	function setApp($app) {
		$this->app = $app;
	}

	/** Возвращает сформированный объект
	 * @param string $alias Фабричное имя объекта
	 */
	public function selection_object($alias, ...$arg) {
		switch ($alias) {
			case 'model\tgsend_bot':
			case 'model\tgsend_task':
			case 'model\tgsend_task_h':
				$classItem = __NAMESPACE__ . "\\{$alias}\\item";
				$classData = __NAMESPACE__ . "\\{$alias}\\data";
				return new $classData($this->app->db, $classItem);
				break;
			case 'bilder\tg_bot':
				return new \app\bilder\tg_bot();
				break;
		}
		echo "Неизвестный {$alias}";
		exit;
		//if (array_key_exists($alias, $this->obj_class)) { return $this->obj_class[$alias];}
		//
		//$class = $this->selection_object($alias, ...$arg);
		//
		//$this->obj_class[$alias] = $class;
		//return $this->obj_class[$alias];
	}


}