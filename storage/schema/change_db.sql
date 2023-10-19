#-- Upgrading Tuhospedaje 3.7 to 3.9

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES (NULL, 'addons', 'Addons', 'Manage Addons', NULL, NULL);
INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES ('44', '1');

DROP TABLE IF EXISTS `gateways`;
CREATE TABLE IF NOT EXISTS `gateways` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `alias` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sandbox` tinyint(1) NOT NULL COMMENT '1 - Sandbox & 0 - Production',
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `instruction` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gateways_alias_unique` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `alias`, `name`, `sandbox`, `data`, `instruction`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'paypal', 'Paypal', 1, '{\"secretKey\":\"ECsq6hLG6I6AZgvkVK2tXjFktn2MW8Jm9UiZA89_omBByLwJKmHA-O2CkeJv4yeap-89SlEP336SWC5h\",\"clientId\":\"AZeutAJKxyK2yU30ElSOestOrJz48UUtyGFByWl1AbspfkOYcdq8Yf1sMlcqOZioBkekTQEC0M-4z2Iv\",\"instruction\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\",\"status\":\"1\",\"sandbox\":\"1\"}', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'thumbnail.png', 1, NULL, NULL),
(2, 'stripe', 'Stripe', 1, '{\"clientSecret\":\"sk_test_UWTgGYIdj8igmbVMgTi0ILPm\",\"publishableKey\":\"pk_test_c2TDWXsjPkimdM8PIltO6d8H\",\"instruction\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\",\"status\":\"1\",\"sandbox\":\"1\"}', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'thumbnail.png', 1, NULL, NULL),
(4, 'directbanktransfer', 'DirectBankTransfer', '1', '{\"name\":\"DirectBankTransfer\",\"account_name\":\"John Doe\",\"iban\":\"6667 77637 32432\",\"swift_code\":\"Test123\",\"routing_no\":\"Test123\",\"bank_name\":\"HSBC\",\"branch_name\":\"Chicago\",\"branch_city\":\"Chicago\",\"branch_address\":\"123, Shicago , USA\",\"country\":\"USA\",\"logo\":\"HSBC.png\",\"status\":\"1\",\"instruction\":\"Make your payment directly into our bank account. please upload necessary attachment to verify the transaction. the admin will approve the transaction if it valid.\"}', 'Make your payment directly into our bank account. please upload necessary attachment to verify the transaction. the admin will approve the transaction if it valid.', 'thumbnail.png', '1', NULL, NULL),
(5, 'flutterwave', 'Flutterwave', 1, '{\"secretKey\":\"FLWSECK_TEST-916f34c844284b80a161639d9c91e97a-X\",\"publicKey\":\"FLWPUBK_TEST-e0ea855b8e3342068bfb11ef4ea0c0f5-X\",\"encryptionKey\":\"FLWSECK_TESTd587420f66c1\",\"instruction\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua\",\"status\":\"1\"}', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'thumbnail.png', 1, NULL, NULL),
(6, 'paystack', 'Paystack', 1, '{\"secretKey\":\"sk_test_6ccdf0a7fff95c5edb111d1702cf0b4b9787952a\",\"publicKey\":\"pk_test_10c26a1cfde23c76701cba105aa8ae1101112236\",\"instruction\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\",\"status\":\"1\",\"sandbox\":\"1\"}', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'thumbnail.png', 1, NULL, NULL);

