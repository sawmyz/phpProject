CREATE TABLE `actions` (
  `action_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `row_id` int(11) DEFAULT NULL,
  `data_before_edit` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `action_type` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `tblName` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

ALTER TABLE `actions`
  ADD PRIMARY KEY (`action_id`);

ALTER TABLE `actions`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT;



CREATE TABLE `UsersTable` (
  `user_id` int(11) NOT NULL,
  `user_username` text COLLATE utf8_persian_ci NOT NULL,
  `user_password` varchar(40) COLLATE utf8_persian_ci NOT NULL COMMENT 'MD5 -> SHA1',
  `user_profile` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `user_name` text COLLATE utf8_persian_ci NOT NULL,
  `user_email` text COLLATE utf8_persian_ci NOT NULL,
  `role_name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `user_nameToKnow` text COLLATE utf8_persian_ci NOT NULL,
  `user_last_pass_1` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `user_last_pass_2` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `tmp_hash` varchar(50) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

INSERT INTO `UsersTable` (`user_id`, `user_username`, `user_password`, `user_profile`, `user_name`, `user_email`, `role_name`, `user_nameToKnow`, `user_last_pass_1`, `user_last_pass_2`, `tmp_hash`) VALUES
(1, 'admin', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'profile', 'براتی\r\n', 'parsabarati83@gmail.com', 'AdminRole', 'barati', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', '09329dd401f65d54f90401225154bbc45bf8efcb');

ALTER TABLE `UsersTable`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `UsersTable`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

