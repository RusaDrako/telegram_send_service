CREATE TABLE IF NOT EXISTS `tgsend`.`tgsend_bot` (
    `id_tgsend_bot` INT NOT NULL AUTO_INCREMENT COMMENT 'ID бота',
    `name` VARCHAR(128) NOT NULL COMMENT 'Имя',
    `tg_bot_id` BIGINT(11) NOT NULL COMMENT 'ID бота TG',
    `token` VARCHAR(36) NOT NULL COMMENT 'Токен',
    `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания задания',
    PRIMARY KEY (`id_tgsend_bot`)
) ENGINE = InnoDB CHARSET=utf32 COLLATE utf32_general_ci COMMENT = 'Телеграм бот';
