<?php
namespace app\model\tgsend_task;

use RusaDrako\debug\DebugExpansion;

class data extends \RusaDrako\model_obj\data_query
{

	/** Дополнительные настройки класса */
	protected function setting() {
		$this->table_name = 'tgsend_task';
	}

	/**  */
	public function getActualLine($botId, $count = 10) {
		$sql = "SELECT :col: FROM :tab: WHERE tgsend_bot_id = {$botId} AND date_task < now() AND response IS NULL ORDER BY date_task ASC, id_tgsend_task ASC LIMIT {$count}";
		$data = $this->select($sql);
		DebugExpansion::info($data, $this->replace_alias($sql));
		return $data;
	}

}