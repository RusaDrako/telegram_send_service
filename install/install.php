<?php

use RusaDrako\driver_db\DB;

require_once (__DIR__ . '/../vendor/autoload.php');

echo '<h2>Установка сервиса рассылки сообщений в Telegram</h2>';

(new install())->execute();

class install {

	/** Выполнение шагов установки */
	function execute() {
		switch ($this->getPost('step', '')) {
			case 'step_1':
				$this->step_1();
				break;
			case 'step_2':
				$this->step_2();
				break;
			default:
				$this->start();
				break;
		}
	}

	/** Получение $_POST элемента */
	protected function getPost($name, $def = null) {
		return $_POST[$name] ?: $def;
	}

	/** Формирование шаблона данных */
	protected function template($name, $set = []) {
		$tmp = file_get_contents(__DIR__ . "/template/{$name}.tmp");
		$tmp = str_replace(array_keys($set), $set, $tmp);
		return $tmp;
	}

	/** Загрузка шаблона страницы */
	protected function view($name, $input = []) {
		require_once (__DIR__."/view/{$name}.php");
	}

	/** Создание соединения с БД */
	protected function getConnect() {
		$config = require (__DIR__ . '/../config/config.php');
		$db = new DB();
		$db->setDB('db', $config['db']);;
		$connect = $db->getDBConnect('db');
		return $connect;
	}

	/** Стартовая страница */
	protected function start() {
		$this->view('start');
	}

	/** Настройка соединения */
	protected function step_1() {
		$cnfFile = __DIR__ . '/../config/config.php';
		// Проверяем есть ли файл настроек
		if (file_exists($cnfFile)) { $this->step_2();}
		$input = [
			':DRIVER:' => DB::DRV_MYSQLI,
			':HOST:' => $this->getPost(':HOST:', 'localhost'),
			':PORT:' => $this->getPost(':PORT:', ''),
			':USER:' => $this->getPost(':USER:', 'root'),
			':PASS:' => $this->getPost(':PASS:', ''),
			':DBNAME:' => $this->getPost(':DBNAME:', ''),
		];
		if ($this->getPost('form') == 'form_1') {
			if ($input[':HOST:'] && $input[':USER:'] && $input[':DBNAME:']) {
				$cnf = $this->template('config', $input);
				file_put_contents($cnfFile, $cnf);
				$this->step_2();
			}
		}
		$this->view('step_1_db', $input);
		exit;
	}

	/** Установка таблиц */
	protected function step_2() {
		$connect=$this->getConnect();
		// Проверяем установлены ли таблицы
		$sql = <<<SQL
SHOW TABLES LIKE 'tgsend_%';
SQL;
		$res = $connect->select($sql);
		if (count($res)) { $this->finish();}
		if ($this->getPost('form') == 'form_2'){
			$arrSQL=require(__DIR__."/db/arrSql.php");
			/** @var RusaDrako\driver_db\drivers_abs_driver $connect */
			$connect=$this->getConnect();
			foreach($arrSQL as $v){
				$connect->query($v);
			}
			$this->finish();
		}
		$this->view('step_2_db_install');
		exit;
	}

	/** Финишная страница */
	protected function finish() {
		$this->view('finish');
		exit;
	}
}