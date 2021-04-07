CREATE TABLE `migration_table` (
                                   `migration_id` int(11) NOT NULL,
                                   `tblName` varchar(500) COLLATE utf8_persian_ci NOT NULL,
                                   `date_time` text COLLATE utf8_persian_ci NOT NULL,
                                   `fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
                                   `type` varchar(50) COLLATE utf8_persian_ci NOT NULL,
                                   `client` varchar(50) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

ALTER TABLE `migration_table`
    ADD PRIMARY KEY (`migration_id`);

ALTER TABLE `migration_table`
    MODIFY `migration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;
