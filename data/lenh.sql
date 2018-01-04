ALTER TABLE `booking` ADD `price_tre_em_m1` VARCHAR(20) NULL AFTER `price_tour`, ADD `price_tre_em_m2` VARCHAR(20) NULL AFTER `price_tre_em_m1`, ADD `price_tre_em_m3` VARCHAR(20) NULL AFTER `price_tre_em_m2`;
ALTER TABLE `booking` CHANGE `price_11_new` `price_tre_em_m1_new` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `booking` CHANGE `price_5_new` `price_tre_em_m2_new` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `booking` ADD `price_tre_em_m3_new` VARCHAR(20) NULL AFTER `price_tre_em_m2_new`;