<?php
namespace app\bilder;

class tg_bot
{
	protected $bot = [];

	public function get($token) {
		if (!array_key_exists($token, $this->bot)) {
			$this->bot[$token] = new \RusaDrako\telegram_notification\telegram($token);
		}
		return $this->bot[$token];
	}
}