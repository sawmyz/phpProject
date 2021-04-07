CREATE TABLE `template_data` (
  `template_id` int(11) NOT NULL,
  `tbl_name` mediumtext COLLATE utf8_persian_ci NOT NULL,
  `column_data` longtext COLLATE utf8_persian_ci NOT NULL,
  `label_data` longtext COLLATE utf8_persian_ci NOT NULL,
  `type_data` longtext COLLATE utf8_persian_ci NOT NULL,
  `join_data` longtext COLLATE utf8_persian_ci DEFAULT NULL,
  `form_data` longtext COLLATE utf8_persian_ci NOT NULL,
  `image_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `validation_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
ALTER TABLE `template_data`
  ADD PRIMARY KEY (`template_id`);

ALTER TABLE `template_data`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;



CREATE TABLE `template_sidebar` (
  `item_id` int(11) NOT NULL,
  `title` text COLLATE utf8_persian_ci NOT NULL,
  `link` text COLLATE utf8_persian_ci NOT NULL,
  `padding_right` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

INSERT INTO `template_sidebar` (`item_id`, `title`, `link`, `padding_right`, `icon`, `parent`) VALUES
(1, 'item', 'Test', 0, 'fa fa-icon\r\n', 0);

ALTER TABLE `template_sidebar`
  ADD PRIMARY KEY (`item_id`);

ALTER TABLE `template_sidebar`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


CREATE TABLE `Labels` (
                          `label_id` int(11) NOT NULL,
                          `form` text COLLATE utf8_persian_ci NOT NULL,
                          `label_text` text COLLATE utf8_persian_ci NOT NULL,
                          `label_details` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
ALTER TABLE `Labels`
    ADD PRIMARY KEY (`label_id`);
ALTER TABLE `Labels`
    MODIFY `label_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
