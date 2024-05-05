ALTER TABLE `contact` ADD `dealer` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0 as false, 1 as true' AFTER `body`;

ALTER TABLE `categories` ADD `_parent_id` INT(10) NULL DEFAULT NULL AFTER `_uid`;

ALTER TABLE `categories` ADD INDEX(`_parent_id`);

ALTER TABLE `categories` CHANGE `_parent_id` `_parent_id` INT(10) UNSIGNED NULL DEFAULT NULL;

ALTER TABLE `categories` ADD CONSTRAINT `fk_categories__parent_id1` FOREIGN KEY (`_parent_id`) REFERENCES `categories`(`_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `categories` ADD `type` VARCHAR(45) NULL AFTER `user_authorities__id`;

ALTER TABLE `products` CHANGE `short_description` `short_description` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `product_combinations` ADD `slug` VARCHAR(255) NULL DEFAULT NULL AFTER `title`;
ALTER TABLE `product_combinations` ADD UNIQUE(`slug`);
ALTER TABLE `product_combinations` CHANGE `slug` `slug` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `brands` ADD `is_popular` TINYINT(1) NOT NULL DEFAULT '0' AFTER `is_deleted`;

ALTER TABLE `brands` ADD `sequence` INT(5) NOT NULL DEFAULT '0' AFTER `name`;



//new code


CREATE TABLE `faq` ( `_id` INT(20) NOT NULL AUTO_INCREMENT , `_uid` CHAR(36) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME NULL , `question` VARCHAR(255) NOT NULL , `answer` VARCHAR(255) NOT NULL , `is_deleted` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0 as false , 1 as true' , PRIMARY KEY (`_id`)) ENGINE = InnoDB;
ALTER TABLE `faq` CHANGE `answer` `answer` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;



//refferal
//flavours


CREATE TABLE `flavours` ( `_id` INT(20) NOT NULL AUTO_INCREMENT , `_uid` VARCHAR(30) NOT NULL , `name` VARCHAR(50) NOT NULL , `is_deleted` TINYINT NOT NULL DEFAULT '0' COMMENT '0 as false, 1 as true' , PRIMARY KEY (`_id`)) ENGINE = InnoDB;



CREATE TABLE `product_combinations_flavours` ( `_id` INT(20) NOT NULL AUTO_INCREMENT , `_uid` VARCHAR(30) NOT NULL , `product_combination_id` INT(30) NOT NULL , `flavour_id` INT(30) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME NULL , `is_deleted` TINYINT NOT NULL DEFAULT '0' COMMENT '0 as false, 1 as true' , `price` DOUBLE NOT NULL COMMENT 'add price on price' , PRIMARY KEY (`_id`)) ENGINE = InnoDB;



ALTER TABLE `product_combinations_flavours` ADD FOREIGN KEY (`flavour_id`) REFERENCES `flavours`(`_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `product_combinations_flavours` ADD FOREIGN KEY (`product_combination_id`) REFERENCES `product_combinations`(`_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;


ALTER TABLE `faq` ADD `type` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0 as Others, 1 as Account, 2 as Order, 3 as Payment, 4 as Deliveries , 5 as Cancellations & Modifications, 6 as Returns & Refunds, 7 as Coupon & Flash sales' AFTER `answer`;


CREATE TABLE `refferal` ( `_id` INT(20) NOT NULL AUTO_INCREMENT , `_uid` VARCHAR(30) NOT NULL , `code` VARCHAR(30) NOT NULL , `user_id` INT(30) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`_id`)) ENGINE = InnoDB;




ALTER TABLE `user` ADD `total_referance` VARCHAR(30) NULL AFTER `verification_token`;


CREATE TABLE `ip_refferal` ( `_id` INT(30) NULL , `_uid` VARCHAR(30) NOT NULL , `ip_address` VARCHAR(30) NOT NULL , `ref_id` INT(30) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ) ENGINE = InnoDB;

ALTER TABLE `ip_refferal` CHANGE `ref_id` `ref_id` VARCHAR(30) NOT NULL;

CREATE TABLE `seo` ( `_id` INT(20) NOT NULL AUTO_INCREMENT , `_uid` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `route` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `title` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `keywords` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `description` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `image_enc_name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , `image_name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , `is_deleted` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0 as false , 1 as True' , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME NULL , PRIMARY KEY (`_id`)) ENGINE = InnoDB;

CREATE TABLE `vouchers` ( `_id` INT(20) NOT NULL AUTO_INCREMENT , `_uid` CHAR(36) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME NULL , `brand_id` INT(20) NULL , `category_id` INT(20) NULL , `type` ENUM('Amount','Percentage','','') NOT NULL , `name` VARCHAR(100) NOT NULL , `start_datetime` DATETIME NOT NULL , `end_datetime` DATETIME NOT NULL , `is_deleted` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0 as false, 1 as True' , PRIMARY KEY (`_id`)) ENGINE = InnoDB;

ALTER TABLE `vouchers` ADD `amount` INT(11) NOT NULL AFTER `name`;
ALTER TABLE `vouchers` CHANGE `start_datetime` `use_once` TINYINT(1) NOT NULL DEFAULT '0';
ALTER TABLE `vouchers` CHANGE `type` `type` ENUM('fixed','percentage') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed';