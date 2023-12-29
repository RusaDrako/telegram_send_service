<?php
namespace app;

use RusaDrako\debug\DebugExpansion;
use RusaDrako\driver_db\DB;

class App
{
	public $db;
	public $factory;

	public function __construct($config){
		$db = new DB();
		$db->setDB('db', $config['db']);;
		$this->db = $db->getDBConnect('db');

		$this->factory = Factory::call();
		$this->factory->setApp($this);
	}

	/** Выполняет рассылку по всем ботам */
	public function send() {
		$tgsend_bot = $this->factory->getObj('model\tgsend_bot');
		$bots = $tgsend_bot->getAll();
		// Проходим по зарегистрированным ботам
		/** @var \app\model\tgsend_bot\item $v */
		foreach($bots->iterator() as $v) {
			$line = $v->getActualTaskLine(50);
			// Проходим по элементам очереди
			/** @var \app\model\tgsend_task\item $v2 */
			foreach($line->iterator() as $v2) {
				$v2->send();
			}
		}
	}
}