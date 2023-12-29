CREATE TABLE IF NOT EXISTS `tgsend`.`tgsend_task_h` (
    `id_tgsend_task` INT NOT NULL COMMENT 'ID задания',
    `tgsend_bot_id` INT NOT NULL COMMENT 'ID',
    `tg_user_id` BIGINT(11) NOT NULL COMMENT 'ID пользователя TG',
    `text` VARCHAR(4096) NOT NULL COMMENT 'Текст сообщения',
    `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания задания',
    `date_task` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Плановая дата отправки',
    `date_sended` DATE NULL COMMENT 'Фактическая дата отправки',
    `response` TEXT NULL COMMENT 'Ответ от телеграмма',
    `is_ok` INT NULL COMMENT 'Статус отправки ОК'
) ENGINE = InnoDB CHARSET=utf32 COLLATE utf32_general_ci COMMENT = 'Задания на отправку (история)';
