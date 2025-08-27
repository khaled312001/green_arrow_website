CREATE TABLE `migrations` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `migration` varchar(255) not null, `batch` int(11) not null);

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('20', '0001_01_01_000000_create_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('21', '0001_01_01_000001_create_cache_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('22', '0001_01_01_000002_create_jobs_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('23', '2025_08_24_093022_create_roles_and_permissions_tables', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('24', '2025_08_24_093028_create_categories_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('25', '2025_08_24_093029_create_courses_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('26', '2025_08_24_093031_create_lessons_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('27', '2025_08_24_093032_create_enrollments_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('28', '2025_08_24_093033_create_payments_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('29', '2025_08_24_093039_create_quizzes_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('39', '2025_08_24_093041_create_certificates_table', '2');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('40', '2025_08_24_093043_create_notifications_table', '2');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('41', '2025_08_24_093044_create_blog_posts_table', '2');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('42', '2025_08_24_093045_add_fields_to_users_table', '2');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('43', '2025_08_24_093313_create_permission_tables', '2');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('44', '2025_08_24_123811_create_settings_table', '2');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('45', '2025_08_24_131239_create_quiz_questions_table', '2');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('46', '2025_08_24_131252_create_quiz_attempts_table', '2');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('47', '2025_08_24_133713_add_fields_to_notifications_table', '2');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('48', '2025_08_24_164044_create_contact_messages_table', '3');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('49', '2025_08_25_101325_add_total_hours_watched_to_enrollments_table', '4');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('50', '2025_08_25_114923_create_user_settings_table', '5');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('51', '2025_08_25_162659_add_payment_data_to_payments_table', '6');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('52', '2025_08_25_162759_add_activated_at_to_enrollments_table', '7');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('53', '2025_08_26_075230_create_lesson_completions_table', '8');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('54', '2025_08_26_162414_assign_all_courses_to_khalid_ahmed', '9');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('55', '2025_08_26_163347_remove_other_instructors_keep_khalid_ahmed', '10');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('56', '2025_08_26_181410_create_course_resources_table', '11');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('57', '2025_08_26_181410_create_messages_table', '11');

CREATE TABLE `users` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `name` varchar(255) not null, `email` varchar(255) not null, `email_verified_at` timestamp, `password` varchar(255) not null, `remember_token` varchar(255), `created_at` timestamp, `updated_at` timestamp, `phone` varchar(255), `avatar` varchar(255), `bio` longtext, `birth_date` date, `gender` varchar(255) ), `city` varchar(255), `country` varchar(255) not null default 'Saudi Arabia', `is_active` boolean not null default '1', `last_login_at` timestamp, `google_id` varchar(255), `status` varchar(255) not null default 'active');

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('1', 'مدير الأكاديمية', 'admin@greenarrowacademy.com', '2025-08-24 15:21:15', '$2y$12$mxuL2hllmzNOgxbmmhSzieOriZ7UBt.cl6aw3vkw/Sz0jn9rGMJ1.', 'CCX9pMZXaKDbIS4o8Xd6TTJkY4a5U3AyMUkQROiIIoxkG70ii6gKuVxRbt1W', '2025-08-24 15:21:15', '2025-08-24 15:21:15', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('2', 'أحمد علي المشرف', 'moderator@greenarrowacademy.com', '2025-08-24 15:21:15', '$2y$12$RrxFxAUmm2Efjyxx5XCWCeGy5YYQBkyCi2UVbOl.zTV0cDtsmye/K', NULL, '2025-08-24 15:21:15', '2025-08-24 15:21:15', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('3', 'سارة أحمد منشئة المحتوى', 'content@greenarrowacademy.com', '2025-08-24 15:21:15', '$2y$12$Q1Mq7Pcs.5KZrx3thoonGub/NmMRnOOlNQ31xE8hqUnsmwKipYw9i', NULL, '2025-08-24 15:21:15', '2025-08-24 15:21:15', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('4', 'خالد محمد فريق الدعم', 'support@greenarrowacademy.com', '2025-08-24 15:21:15', '$2y$12$9MeZtdsw6NwZ8gXhYIpwpu0A9aAFlzFFggD7sgqHDBMxxEkMc7xue', NULL, '2025-08-24 15:21:15', '2025-08-24 15:21:15', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('11', 'الطالب رقم 1', 'student1@example.com', '2025-08-24 15:21:17', '$2y$12$FzgAsE/ezy.MoDYPLoK/U.LTUetkbWtPoW/o78DyBNLAuc2etIiFO', NULL, '2025-08-24 15:21:17', '2025-08-24 15:21:17', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('12', 'احمد محمد', 'student2@example.com', '2025-08-24 15:21:17', '$2y$12$aWcAqVadouDvrDVhCFYdPORfRXwvADW8pPr1154eH1VTFpYpc5JAi', NULL, '2025-08-24 15:21:17', '2025-08-26 16:04:54', NULL, NULL, NULL, NULL, 'male', NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('13', 'الطالب رقم 3', 'student3@example.com', '2025-08-24 15:21:18', '$2y$12$ZAJR1sNU9fa5YOHWZ4cLzedgQd40RhHxk7NG2g33w.akZa/krfYpG', NULL, '2025-08-24 15:21:18', '2025-08-24 15:21:18', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('14', 'الطالب رقم 4', 'student4@example.com', '2025-08-24 15:21:18', '$2y$12$Ge/ko9iueYlYzrGcTDIi/.NVkoRnR843rbXqqZo/P1Yq8CoE3hM02', NULL, '2025-08-24 15:21:18', '2025-08-24 15:21:18', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('15', 'الطالب رقم 5', 'student5@example.com', '2025-08-24 15:21:18', '$2y$12$SBAyZ/KdtQUlk4N3Jwk3keS9s4/3NoD7QpIJrSMqskQi4okyBTVUO', NULL, '2025-08-24 15:21:18', '2025-08-24 15:21:18', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('16', 'الطالب رقم 6', 'student6@example.com', '2025-08-24 15:21:19', '$2y$12$iaR3QCd4x/PL.Bsdw6pIcevH4NryHSA/OhsH2ObeF6U8ijDhk.ttq', NULL, '2025-08-24 15:21:19', '2025-08-24 15:21:19', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('17', 'الطالب رقم 7', 'student7@example.com', '2025-08-24 15:21:19', '$2y$12$a.izfAptrOQSMGo7EjYQAex0e/Y9pGYYSSY7iOuCdsqS5KgfkbT7q', NULL, '2025-08-24 15:21:19', '2025-08-24 15:21:19', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('18', 'الطالب رقم 8', 'student8@example.com', '2025-08-24 15:21:19', '$2y$12$9XUk0r/yjbURPLq2fAqd4.M4opItLzKpse63AdyNhWTAGs1.IcY6O', NULL, '2025-08-24 15:21:19', '2025-08-24 15:21:19', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('19', 'الطالب رقم 9', 'student9@example.com', '2025-08-24 15:21:20', '$2y$12$Yf3j6n4PQ4Ig92czclvLbOz6fR5A0SOykzyoLq/7YA1FAeMcLF6pi', NULL, '2025-08-24 15:21:20', '2025-08-24 15:21:20', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('20', 'الطالب رقم 10', 'student10@example.com', '2025-08-24 15:21:20', '$2y$12$VFFM6SjK3FCykDH7Z/QUx.hWCuLiOWCYPHjJTUOmNY6SULmk08h.S', NULL, '2025-08-24 15:21:20', '2025-08-24 15:21:20', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('21', 'الطالب رقم 11', 'student11@example.com', '2025-08-24 15:21:20', '$2y$12$5O83aAD5psfda9PDsmFjAej1CujC/Ux32L/ZnyzQINxyf5cxhKKsm', NULL, '2025-08-24 15:21:20', '2025-08-24 15:21:20', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('22', 'الطالب رقم 12', 'student12@example.com', '2025-08-24 15:21:21', '$2y$12$zQTXC.Uso2szR4RkQ.abdum2QSWb/iAcUPOHfGkK3ibji6Afs9EfC', NULL, '2025-08-24 15:21:21', '2025-08-24 15:21:21', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('23', 'الطالب رقم 13', 'student13@example.com', '2025-08-24 15:21:22', '$2y$12$vP3KdZUfcqeN3C6uvoNc.eNxarP41RDLwSrA7rwIntTpzn87ZDvlS', NULL, '2025-08-24 15:21:22', '2025-08-24 15:21:22', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('24', 'الطالب رقم 14', 'student14@example.com', '2025-08-24 15:21:22', '$2y$12$0mt2GxyooGkRp/0gChsIsuFL7LIBDf/aGFW3E.7d5K75/uKMjpjHe', NULL, '2025-08-24 15:21:22', '2025-08-24 15:21:22', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('25', 'الطالب رقم 15', 'student15@example.com', '2025-08-24 15:21:23', '$2y$12$0E.UyMTYOixCLrHreZx99utr0jKj17YD6yyJsN0tEskzmHJpDOzAm', NULL, '2025-08-24 15:21:23', '2025-08-24 15:21:23', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('26', 'الطالب رقم 16', 'student16@example.com', '2025-08-24 15:21:23', '$2y$12$UdQQChaWdf68zmZXSe4fKuZvgeCJc9lpM3KUxtXMTpBbaX8uZypRy', NULL, '2025-08-24 15:21:23', '2025-08-24 15:21:23', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('27', 'الطالب رقم 17', 'student17@example.com', '2025-08-24 15:21:23', '$2y$12$waae9HdmxYKvX2jGs9nUm.xEO3NmMgQ0KzzaADfwnYMdCNXQxsdyi', NULL, '2025-08-24 15:21:23', '2025-08-24 15:21:23', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('28', 'الطالب رقم 18', 'student18@example.com', '2025-08-24 15:21:24', '$2y$12$s/Wguk3CAWCyROCvdFd84utYEuoUtzjoaHBqQe8AG.kNOpXZ2lKLS', NULL, '2025-08-24 15:21:24', '2025-08-24 15:21:24', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('29', 'الطالب رقم 19', 'student19@example.com', '2025-08-24 15:21:24', '$2y$12$PH8qvFWhKZ4phlsuRrNpJeqAsFi/bzoeGijawXbPJs8qopGbGBJv.', NULL, '2025-08-24 15:21:24', '2025-08-24 15:21:24', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('30', 'الطالب رقم 20', 'student20@example.com', '2025-08-24 15:21:24', '$2y$12$EKTO9R9SDDLbbEGd3n4tnuY5kYbnRAWyX.OhcveKt9rHx83xAn7La', NULL, '2025-08-24 15:21:24', '2025-08-24 15:21:24', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('33', 'محمد الطالب', 'student@example.com', NULL, '$2y$12$t.BoHmqeGAA.YB2xcqzUZeL7RIu4UoV4I20SaJruN3O2e2ofBMJqK', NULL, '2025-08-26 16:05:39', '2025-08-26 16:05:39', '0501234569', NULL, 'طالب مهتم بالتعلم', NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('34', 'خالد احمد', 'teacher@greenarrowacademy.com', '2025-08-26 16:24:33', '$2y$12$ql7.6gEX00C0DQTU6qgZzuPmLDsVVC.8wGjUywzV5ec5y3uWfHvGK', NULL, '2025-08-26 16:24:33', '2025-08-26 18:41:05', '+966501234571', 'avatars/NKWiIm9hgaPMg7dVwARdAgLt2YPy2zas9PEufm3f.jpg', 'مدرب محترف متخصص في مجال التدريب والتعليم، يمتلك خبرة واسعة في تقديم الدورات التدريبية عالية الجودة.', NULL, NULL, 'مكة المكرمة', 'السعودية', '1', NULL, NULL, 'active');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `bio`, `birth_date`, `gender`, `city`, `country`, `is_active`, `last_login_at`, `google_id`, `status`) VALUES ('37', 'طالب الاختبار', 'test@student.com', '2025-08-26 17:49:05', '$2y$12$ZjGTOmw8HIxj4GaMexQ2DeuWJuYiLEg5447ZT8.fzfs2chF3DXCtO', NULL, '2025-08-26 17:49:05', '2025-08-26 17:49:05', NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Arabia', '1', NULL, NULL, 'active');

CREATE TABLE `password_reset_tokens` (`email` varchar(255) not null, `token` varchar(255) not null, `created_at` timestamp, primary key (`email`));


CREATE TABLE `sessions` (`id` varchar(255) not null, `user_id` int(11), `ip_address` varchar(255), `user_agent` longtext, `payload` longtext not null, `last_activity` int(11) not null, primary key (`id`));

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('fYwhZqNNo44OjWDGJHAQa5GzShbOQmBQsc2Yrq2t', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRWl4eG9YREYyVXl3Wno5TGZYclBrTTlucFBESm8zWHJWWnF0dm5ZdiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0ODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3N0dWRlbnQvY291cnNlcy8yL3BsYXllci80Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9ub3RpZmljYXRpb25zL2FwaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', '1756233666');
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('x3zmd7hCjG5wT8VlqdiuI0YJNMob3Cm3D9jIdOAs', '34', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia3p2T0cySFV4QW5kcXdpdWdEUW5KR2Nmb0pvUDJ2WTR0RnhYdFE3ViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90ZWFjaGVyL2Rhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM0O30=', '1756233945');

CREATE TABLE `cache` (`key` varchar(255) not null, `value` longtext not null, `expiration` int(11) not null, primary key (`key`));

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-settings.group.site', 'TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6Nzp7czo5OiJzaXRlX25hbWUiO3M6NTU6Itij2YPYp9iv2YrZhdmK2Kkg2KfZhNiz2YfZhSDYp9mE2KPYrti22LEg2YTZhNiq2K/YsdmK2KgiO3M6MTY6InNpdGVfZGVzY3JpcHRpb24iO3M6MjIwOiLYo9mD2KfYr9mK2YXZitipINin2YTYs9mH2YUg2KfZhNij2K7YttixINmE2YTYqtiv2LHZitioINio2YXZg9ipINin2YTZhdmD2LHZhdipIC0g2K/ZiNix2KfYqiDYqtiv2LHZitio2YrYqSDZhdiq2K7Ytdi12Kkg2YHZiiDYp9mE2KjYsdmF2KzYqSDZiNin2YTYpdiv2KfYsdipINmI2KfZhNmE2LrYp9iqINmI2KfZhNiq2YLZhtmK2Kkg2YXYuSDYo9mB2LbZhCDYp9mE2YXYr9ix2KjZitmGIjtzOjEwOiJzaXRlX2VtYWlsIjtzOjI4OiJncmVlbmFycm93YWNhZGVtaWNAZ21haWwuY29tIjtzOjEwOiJzaXRlX3Bob25lIjtzOjEwOiIwNTA4MjYwMjc0IjtzOjEzOiJzaXRlX3doYXRzYXBwIjtzOjE2OiIrOTY2IDUwIDgyNiAwMjc0IjtzOjEyOiJzaXRlX2FkZHJlc3MiO3M6MTIzOiLZhdmD2Kkg2KfZhNmF2YPYsdmF2KkgLSDYrdmKINin2YTYrti22LHYp9ihIC0g2KfZhNi02KfYsdi5INin2YTYudin2YUgLSDZhdmC2KfYqNmEINmC2KfYudipINin2YTYqNiz2KfYqtmK2YYg2YTZhNij2YHYsdin2K0iO3M6MTg6InNpdGVfd29ya2luZ19ob3VycyI7czo0NToi2KfZhNiz2KjYqiAtINin2YTYrtmF2YrYszogMjowMCDZhSAtIDEwOjAwINmFIjt9czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO30=', '1756141605');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-settings.group.appearance', 'TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6Njp7czo5OiJzaXRlX2xvZ28iO3M6ODM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdG9yYWdlL3NldHRpbmdzL2R2RnpDeWRmdG0xYmp1cFhxdXBMUHN4eHZkMXZtWEpLalRRUFFnVzgucG5nIjtzOjE1OiJzaXRlX2xvZ29fbGlnaHQiO3M6ODM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdG9yYWdlL3NldHRpbmdzL2c0cEJUeHNBdmhjazZ1OGVWYkJ4ZE1VZUtQRXAwWkdBa1F4dmFFZDgucG5nIjtzOjEyOiJzaXRlX2Zhdmljb24iO3M6ODM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdG9yYWdlL3NldHRpbmdzL09uNE51Z1AxeWt2VDkyT0FwN1I0MlFIblNBRzJsd2xNNzdEamEyY3EucG5nIjtzOjE4OiJzaXRlX3ByaW1hcnlfY29sb3IiO3M6NzoiIzEwYjk4MSI7czoyMDoic2l0ZV9zZWNvbmRhcnlfY29sb3IiO3M6NzoiIzFmMjkzNyI7czoxNzoic2l0ZV9hY2NlbnRfY29sb3IiO3M6NzoiI2Y1OWUwYiI7fXM6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDt9', '1756141605');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-settings.group.courses', 'TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6Njp7czoxOToibWF4X2NvdXJzZV9kdXJhdGlvbiI7aToxMDA7czoyMjoibWF4X2xlc3NvbnNfcGVyX2NvdXJzZSI7aTo1MDtzOjI0OiJjb3Vyc2VfYXBwcm92YWxfcmVxdWlyZWQiO2I6MTtzOjIwOiJhbGxvd19jb3Vyc2VfcHJldmlldyI7YjoxO3M6MjA6ImZyZWVfY291cnNlc19hbGxvd2VkIjtiOjE7czoyNjoiY291cnNlX2NlcnRpZmljYXRlX2VuYWJsZWQiO2I6MTt9czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO30=', '1756141605');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-settings.group.payment', 'TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6MTA6e3M6ODoiY3VycmVuY3kiO3M6MzoiU0FSIjtzOjg6InRheF9yYXRlIjtpOjE1O3M6MTQ6InN0cmlwZV9lbmFibGVkIjtiOjE7czoxNzoic3RyaXBlX3B1YmxpY19rZXkiO047czoxNzoic3RyaXBlX3NlY3JldF9rZXkiO047czoxNDoicGF5cGFsX2VuYWJsZWQiO2I6MTtzOjE2OiJwYXlwYWxfY2xpZW50X2lkIjtOO3M6MTM6InBheXBhbF9zZWNyZXQiO047czoyMToiYmFua190cmFuc2Zlcl9lbmFibGVkIjtiOjE7czoxNzoiYmFua19hY2NvdW50X2luZm8iO047fXM6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDt9', '1756141605');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-settings.group.email', 'TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6Njp7czoxNzoibWFpbF9mcm9tX2FkZHJlc3MiO3M6Mjg6ImdyZWVuYXJyb3dhY2FkZW1pY0BnbWFpbC5jb20iO3M6MTQ6Im1haWxfZnJvbV9uYW1lIjtzOjU1OiLYo9mD2KfYr9mK2YXZitipINin2YTYs9mH2YUg2KfZhNij2K7YttixINmE2YTYqtiv2LHZitioIjtzOjIxOiJ3ZWxjb21lX2VtYWlsX2VuYWJsZWQiO2I6MTtzOjIzOiJjb3Vyc2VfY29tcGxldGlvbl9lbWFpbCI7YjoxO3M6MjY6InBheW1lbnRfY29uZmlybWF0aW9uX2VtYWlsIjtiOjE7czoxODoibmV3c2xldHRlcl9lbmFibGVkIjtiOjE7fXM6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDt9', '1756141605');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-settings.group.social', 'TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6OTp7czoxMjoiZmFjZWJvb2tfdXJsIjtzOjIwNzoiaHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL3Blb3BsZS8lRDglQTMlRDklODMlRDglQTclRDglQUYlRDklOEElRDklODUlRDklOEElRDglQTktJUQ4JUE3JUQ5JTg0JUQ4JUIzJUQ5JTg3JUQ5JTg1LSVEOCVBNyVEOSU4NCVEOCVBMyVEOCVBRSVEOCVCNiVEOCVCMS0lRDklODQlRDklODQlRDglQUElRDglQUYlRDglQjElRDklOEElRDglQTgvNjE1NzE1MjEyMzQxMDMvIjtzOjExOiJ0d2l0dGVyX3VybCI7czoyNjoiaHR0cHM6Ly94LmNvbS9ncmVlbmFycm93YWMiO3M6MTM6Imluc3RhZ3JhbV91cmwiO3M6NDQ6Imh0dHBzOi8vd3d3Lmluc3RhZ3JhbS5jb20vZ3JlZW5hcnJvd2FjYWRlbXkvIjtzOjExOiJ5b3V0dWJlX3VybCI7czoxMzk6Imh0dHBzOi8vd3d3LnlvdXR1YmUuY29tL0AlRDglQTMlRDklODMlRDglQTclRDglQUYlRDklOEElRDklODUlRDklOEElRDglQTklRDglQTclRDklODQlRDglQjMlRDklODclRDklODUlRDglQTclRDklODQlRDglQTMlRDglQUUlRDglQjYlRDglQjEiO3M6MTI6ImxpbmtlZGluX3VybCI7czoyMDA6Imh0dHBzOi8vd3d3LmxpbmtlZGluLmNvbS9jb21wYW55LyVEOCVCNCVEOCVCMSVEOSU4MyVEOCVBOS0lRDglQTMlRDklODMlRDglQTclRDglQUYlRDklOEElRDklODUlRDklOEElRDglQTktJUQ4JUE3JUQ5JTg0JUQ4JUIzJUQ5JTg3JUQ5JTg1LSVEOCVBNyVEOSU4NCVEOCVBNyVEOCVBRSVEOCVCNiVEOCVCMS0lRDklODQlRDklODQlRDglQUElRDglQUYvIjtzOjEwOiJ0aWt0b2tfdXJsIjtzOjM4OiJodHRwczovL3d3dy50aWt0b2suY29tL0BncmVlbi5hcnJvdzY0NSI7czoxMjoidGVsZWdyYW1fdXJsIjtzOjI1OiJodHRwczovL3QubWUvZ3JlZW5hcnJvd2FjIjtzOjEyOiJzbmFwY2hhdF91cmwiO3M6NDA6Imh0dHBzOi8vd3d3LnNuYXBjaGF0LmNvbS9AZWxzYWhtYWNhZGVtaWMiO3M6MTU6Imdvb2dsZV9tYXBzX3VybCI7czoxMTI5OiJodHRwczovL3d3dy5nb29nbGUuY29tL21hcHM/cT0lRDklODUlRDglQjElRDklODMlRDglQjIrJUQ4JUEzJUQ5JTgzJUQ4JUE3JUQ4JUFGJUQ5JThBJUQ5JTg1JUQ5JThBJUQ4JUE5KyVEOCVBNyVEOSU4NCVEOCVCMyVEOSU4NyVEOSU4NSslRDglQTclRDklODQlRDglQTMlRDglQUUlRDglQjYlRDglQjErJUQ5JTg0JUQ5JTg0JUQ4JUFBJUQ4JUFGJUQ4JUIxJUQ5JThBJUQ4JUE4JUQ4JThDKyVEOCVBNyVEOSU4NCVEOCVCNCVEOCVBNyVEOCVCMSVEOCVCOSslRDglQTclRDklODQlRDglQjklRDglQTclRDklODUlRDglOEMrJUQ4JUE3JUQ5JTg0JUQ4JUFFJUQ4JUI2JUQ4JUIxJUQ4JUE3JUQ4JUExJUQ4JThDKyVEOSU4NSVEOSU4MyVEOCVBOSslRDglQTclRDklODQlRDklODUlRDklODMlRDglQjElRDklODUlRDglQTkrLSslRDglQUQlRDklOEErJUQ4JUE3JUQ5JTg0JUQ4JUI0JUQ4JUIxJUQ4JUE3JUQ4JUE2JUQ4JUI5JUQ4JThDKyVEOSU4NSVEOSU4MyVEOCVBOSsyNDI2NyVEOCU4QyslRDglQTclRDklODQlRDklODUlRDklODUlRDklODQlRDklODMlRDglQTkrJUQ4JUE3JUQ5JTg0JUQ4JUI5JUQ4JUIxJUQ4JUE4JUQ5JThBJUQ4JUE5KyVEOCVBNyVEOSU4NCVEOCVCMyVEOCVCOSVEOSU4OCVEOCVBRiVEOSU4QSVEOCVBOSslRDglQTclRDklODQlRDglQjMlRDglQjklRDklODglRDglQUYlRDklOEElRDglQTkmZnRpZD0weDE1YzIwMThjMDNhMDhkZjE6MHhkYmRjMzUwNTIyZTZkOGQ4JmVudHJ5PWdwcyZsdWNzPSw5NDI0NjQ4MCw5NDI0MjUwOCw5NDIyNDgyNSw5NDIyNzI0Nyw5NDIyNzI0OCw0NzA3MTcwNCw0NzA2OTUwOCw5NDIxODY0MSw5NDIyODM1NCw5NDIzMzA3OSw5NDIwMzAxOSw0NzA4NDMwNCw5NDIwODQ1OCw5NDIwODQ0NyZnX2VwPUNBSVNFakkwTGpVd0xqQXVOekEwTkRJM09Ea3hNQmdBSU5lQ0F5cC1MRGswTWpRMk5EZ3dMRGswTWpReU5UQTRMRGswTWpJME9ESTFMRGswTWpJM01qUTNMRGswTWpJM01qUTRMRFEzTURjeE56QTBMRFEzTURZNU5UQTRMRGswTWpFNE5qUXhMRGswTWpJNE16VTBMRGswTWpNek1EYzVMRGswTWpBek1ERTVMRFEzTURnME16QTBMRGswTWpBNE5EVTRMRGswTWpBNE5EUTNRZ0pGUnclM0QlM0QmZ19zdD1jb20uZ29vZ2xlLm1hcHMucHJldmlldy5jb3B5Ijt9czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO30=', '1756141605');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-settings.group.seo', 'TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6MTA6e3M6MTA6InNpdGVfdGl0bGUiO3M6Nzk6Itij2YPYp9iv2YrZhdmK2Kkg2KfZhNiz2YfZhSDYp9mE2KPYrti22LEg2YTZhNiq2K/YsdmK2KggLSDZhdmD2Kkg2KfZhNmF2YPYsdmF2KkiO3M6MTM6InNpdGVfa2V5d29yZHMiO3M6MTUxOiLYo9mD2KfYr9mK2YXZitipINin2YTYs9mH2YUg2KfZhNij2K7YttixLCDYqtiv2LHZitioLCDYr9mI2LHYp9iqLCDYqNix2YXYrNipLCDYpdiv2KfYsdipLCDZhNi62KfYqiwg2KrZgtmG2YrYqSwg2YXZg9ipINin2YTZhdmD2LHZhdipLCDYp9mE2LPYudmI2K/ZitipIjtzOjExOiJzaXRlX2F1dGhvciI7czo1NToi2KPZg9in2K/ZitmF2YrYqSDYp9mE2LPZh9mFINin2YTYo9iu2LbYsSDZhNmE2KrYr9ix2YrYqCI7czo4OiJvZ190aXRsZSI7czo3OToi2KPZg9in2K/ZitmF2YrYqSDYp9mE2LPZh9mFINin2YTYo9iu2LbYsSDZhNmE2KrYr9ix2YrYqCAtINmF2YPYqSDYp9mE2YXZg9ix2YXYqSI7czoxNDoib2dfZGVzY3JpcHRpb24iO3M6MjIwOiLYo9mD2KfYr9mK2YXZitipINin2YTYs9mH2YUg2KfZhNij2K7YttixINmE2YTYqtiv2LHZitioINio2YXZg9ipINin2YTZhdmD2LHZhdipIC0g2K/ZiNix2KfYqiDYqtiv2LHZitio2YrYqSDZhdiq2K7Ytdi12Kkg2YHZiiDYp9mE2KjYsdmF2KzYqSDZiNin2YTYpdiv2KfYsdipINmI2KfZhNmE2LrYp9iqINmI2KfZhNiq2YLZhtmK2Kkg2YXYuSDYo9mB2LbZhCDYp9mE2YXYr9ix2KjZitmGIjtzOjg6Im9nX2ltYWdlIjtOO3M6MTI6InR3aXR0ZXJfY2FyZCI7czoxOToic3VtbWFyeV9sYXJnZV9pbWFnZSI7czoxNjoiZ29vZ2xlX2FuYWx5dGljcyI7TjtzOjIxOiJnb29nbGVfc2VhcmNoX2NvbnNvbGUiO047czoxNDoiYmluZ193ZWJtYXN0ZXIiO047fXM6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDt9', '1756141605');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-settings.group.system', 'TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6OTp7czoxNjoibWFpbnRlbmFuY2VfbW9kZSI7YjowO3M6MTk6Im1haW50ZW5hbmNlX21lc3NhZ2UiO3M6MTAxOiLZhti52KrYsNix2Iwg2KfZhNmF2YjZgti5INmC2YrYryDYp9mE2LXZitin2YbYqSDYrdin2YTZitin2YsuINmK2LHYrNmJINin2YTZhdit2KfZiNmE2Kkg2YTYp9it2YLYp9mLLiI7czoyNToidXNlcl9yZWdpc3RyYXRpb25fZW5hYmxlZCI7YjoxO3M6Mjc6ImVtYWlsX3ZlcmlmaWNhdGlvbl9yZXF1aXJlZCI7YjoxO3M6MjA6Im1heF9maWxlX3VwbG9hZF9zaXplIjtpOjEwO3M6MTg6ImFsbG93ZWRfZmlsZV90eXBlcyI7czo0MToianBnLGpwZWcscG5nLGdpZixwZGYsZG9jLGRvY3gsbXA0LG1vdixhdmkiO3M6MTU6InNlc3Npb25fdGltZW91dCI7aToxMjA7czoxOToicGFzc3dvcmRfbWluX2xlbmd0aCI7aTo4O3M6MjQ6InBhc3N3b3JkX3JlcXVpcmVfc3BlY2lhbCI7YjoxO31zOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7fQ==', '1756141605');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-settings.group.notifications', 'TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6Njp7czoyNzoiZW1haWxfbm90aWZpY2F0aW9uc19lbmFibGVkIjtiOjE7czoyNToic21zX25vdGlmaWNhdGlvbnNfZW5hYmxlZCI7YjowO3M6MjY6InB1c2hfbm90aWZpY2F0aW9uc19lbmFibGVkIjtiOjE7czoyMzoibmV3X2NvdXJzZV9ub3RpZmljYXRpb24iO2I6MTtzOjI2OiJjb3Vyc2VfdXBkYXRlX25vdGlmaWNhdGlvbiI7YjoxO3M6MjA6InBheW1lbnRfbm90aWZpY2F0aW9uIjtiOjE7fXM6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDt9', '1756141605');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.og_image', 'N;', '1756237534');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.google_analytics', 'N;', '1756237534');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.site_whatsapp', 's:16:\"+966 50 826 0274\";', '1756234513');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.facebook_url', 's:207:\"https://www.facebook.com/people/%D8%A3%D9%83%D8%A7%D8%AF%D9%8A%D9%85%D9%8A%D8%A9-%D8%A7%D9%84%D8%B3%D9%87%D9%85-%D8%A7%D9%84%D8%A3%D8%AE%D8%B6%D8%B1-%D9%84%D9%84%D8%AA%D8%AF%D8%B1%D9%8A%D8%A8/61571521234103/\";', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.twitter_url', 's:26:\"https://x.com/greenarrowac\";', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.instagram_url', 's:44:\"https://www.instagram.com/greenarrowacademy/\";', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.youtube_url', 's:139:\"https://www.youtube.com/@%D8%A3%D9%83%D8%A7%D8%AF%D9%8A%D9%85%D9%8A%D8%A9%D8%A7%D9%84%D8%B3%D9%87%D9%85%D8%A7%D9%84%D8%A3%D8%AE%D8%B6%D8%B1\";', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.linkedin_url', 's:200:\"https://www.linkedin.com/company/%D8%B4%D8%B1%D9%83%D8%A9-%D8%A3%D9%83%D8%A7%D8%AF%D9%8A%D9%85%D9%8A%D8%A9-%D8%A7%D9%84%D8%B3%D9%87%D9%85-%D8%A7%D9%84%D8%A7%D8%AE%D8%B6%D8%B1-%D9%84%D9%84%D8%AA%D8%AF/\";', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.tiktok_url', 's:38:\"https://www.tiktok.com/@green.arrow645\";', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.telegram_url', 's:25:\"https://t.me/greenarrowac\";', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.snapchat_url', 's:40:\"https://www.snapchat.com/@elsahmacademic\";', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.google_maps_url', 's:1129:\"https://www.google.com/maps?q=%D9%85%D8%B1%D9%83%D8%B2+%D8%A3%D9%83%D8%A7%D8%AF%D9%8A%D9%85%D9%8A%D8%A9+%D8%A7%D9%84%D8%B3%D9%87%D9%85+%D8%A7%D9%84%D8%A3%D8%AE%D8%B6%D8%B1+%D9%84%D9%84%D8%AA%D8%AF%D8%B1%D9%8A%D8%A8%D8%8C+%D8%A7%D9%84%D8%B4%D8%A7%D8%B1%D8%B9+%D8%A7%D9%84%D8%B9%D8%A7%D9%85%D8%8C+%D8%A7%D9%84%D8%AE%D8%B6%D8%B1%D8%A7%D8%A1%D8%8C+%D9%85%D9%83%D8%A9+%D8%A7%D9%84%D9%85%D9%83%D8%B1%D9%85%D8%A9+-+%D8%AD%D9%8A+%D8%A7%D9%84%D8%B4%D8%B1%D8%A7%D8%A6%D8%B9%D8%8C+%D9%85%D9%83%D8%A9+24267%D8%8C+%D8%A7%D9%84%D9%85%D9%85%D9%84%D9%83%D8%A9+%D8%A7%D9%84%D8%B9%D8%B1%D8%A8%D9%8A%D8%A9+%D8%A7%D9%84%D8%B3%D8%B9%D9%88%D8%AF%D9%8A%D8%A9+%D8%A7%D9%84%D8%B3%D8%B9%D9%88%D8%AF%D9%8A%D8%A9&ftid=0x15c2018c03a08df1:0xdbdc350522e6d8d8&entry=gps&lucs=,94246480,94242508,94224825,94227247,94227248,47071704,47069508,94218641,94228354,94233079,94203019,47084304,94208458,94208447&g_ep=CAISEjI0LjUwLjAuNzA0NDI3ODkxMBgAINeCAyp-LDk0MjQ2NDgwLDk0MjQyNTA4LDk0MjI0ODI1LDk0MjI3MjQ3LDk0MjI3MjQ4LDQ3MDcxNzA0LDQ3MDY5NTA4LDk0MjE4NjQxLDk0MjI4MzU0LDk0MjMzMDc5LDk0MjAzMDE5LDQ3MDg0MzA0LDk0MjA4NDU4LDk0MjA4NDQ3QgJFRw%3D%3D&g_st=com.google.maps.preview.copy\";', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.discord_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.twitch_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.pinterest_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.reddit_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.github_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.medium_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.behance_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.dribbble_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.spotify_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.apple_music_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.soundcloud_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.vimeo_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.flickr_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.quora_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.stack_overflow_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.wordpress_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.blogger_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.tumblr_url', 'N;', '1756234527');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.xing_url', 'N;', '1756234528');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.skype_username', 'N;', '1756234528');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.wechat_url', 'N;', '1756234528');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.line_url', 'N;', '1756234528');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.kakao_url', 'N;', '1756234528');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.naver_url', 'N;', '1756234528');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.baidu_url', 'N;', '1756234528');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.qq_url', 'N;', '1756234528');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.weibo_url', 'N;', '1756234528');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.site_address', 's:123:\"مكة المكرمة - حي الخضراء - الشارع العام - مقابل قاعة البساتين للأفراح\";', '1756234528');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-settings.public', 'TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6MzA6e3M6OToic2l0ZV9uYW1lIjtzOjU1OiLYo9mD2KfYr9mK2YXZitipINin2YTYs9mH2YUg2KfZhNij2K7YttixINmE2YTYqtiv2LHZitioIjtzOjE2OiJzaXRlX2Rlc2NyaXB0aW9uIjtzOjIyMDoi2KPZg9in2K/ZitmF2YrYqSDYp9mE2LPZh9mFINin2YTYo9iu2LbYsSDZhNmE2KrYr9ix2YrYqCDYqNmF2YPYqSDYp9mE2YXZg9ix2YXYqSAtINiv2YjYsdin2Kog2KrYr9ix2YrYqNmK2Kkg2YXYqtiu2LXYtdipINmB2Yog2KfZhNio2LHZhdis2Kkg2YjYp9mE2KXYr9in2LHYqSDZiNin2YTZhNi62KfYqiDZiNin2YTYqtmC2YbZitipINmF2Lkg2KPZgdi22YQg2KfZhNmF2K/Ysdio2YrZhiI7czoxMDoic2l0ZV9lbWFpbCI7czoyODoiZ3JlZW5hcnJvd2FjYWRlbWljQGdtYWlsLmNvbSI7czoxMDoic2l0ZV9waG9uZSI7czoxMDoiMDUwODI2MDI3NCI7czoxMzoic2l0ZV93aGF0c2FwcCI7czoxNjoiKzk2NiA1MCA4MjYgMDI3NCI7czoxMjoic2l0ZV9hZGRyZXNzIjtzOjEyMzoi2YXZg9ipINin2YTZhdmD2LHZhdipIC0g2K3ZiiDYp9mE2K7Yttix2KfYoSAtINin2YTYtNin2LHYuSDYp9mE2LnYp9mFIC0g2YXZgtin2KjZhCDZgtin2LnYqSDYp9mE2KjYs9in2KrZitmGINmE2YTYo9mB2LHYp9itIjtzOjE4OiJzaXRlX3dvcmtpbmdfaG91cnMiO3M6NDU6Itin2YTYs9io2KogLSDYp9mE2K7ZhdmK2LM6IDI6MDAg2YUgLSAxMDowMCDZhSI7czo5OiJzaXRlX2xvZ28iO3M6ODM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdG9yYWdlL3NldHRpbmdzL2R2RnpDeWRmdG0xYmp1cFhxdXBMUHN4eHZkMXZtWEpLalRRUFFnVzgucG5nIjtzOjE1OiJzaXRlX2xvZ29fbGlnaHQiO3M6ODM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdG9yYWdlL3NldHRpbmdzL2c0cEJUeHNBdmhjazZ1OGVWYkJ4ZE1VZUtQRXAwWkdBa1F4dmFFZDgucG5nIjtzOjEyOiJzaXRlX2Zhdmljb24iO3M6ODM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdG9yYWdlL3NldHRpbmdzL09uNE51Z1AxeWt2VDkyT0FwN1I0MlFIblNBRzJsd2xNNzdEamEyY3EucG5nIjtzOjE4OiJzaXRlX3ByaW1hcnlfY29sb3IiO3M6NzoiIzEwYjk4MSI7czoyMDoic2l0ZV9zZWNvbmRhcnlfY29sb3IiO3M6NzoiIzFmMjkzNyI7czoxNzoic2l0ZV9hY2NlbnRfY29sb3IiO3M6NzoiI2Y1OWUwYiI7czo4OiJjdXJyZW5jeSI7czozOiJTQVIiO3M6MTI6ImZhY2Vib29rX3VybCI7czoyMDc6Imh0dHBzOi8vd3d3LmZhY2Vib29rLmNvbS9wZW9wbGUvJUQ4JUEzJUQ5JTgzJUQ4JUE3JUQ4JUFGJUQ5JThBJUQ5JTg1JUQ5JThBJUQ4JUE5LSVEOCVBNyVEOSU4NCVEOCVCMyVEOSU4NyVEOSU4NS0lRDglQTclRDklODQlRDglQTMlRDglQUUlRDglQjYlRDglQjEtJUQ5JTg0JUQ5JTg0JUQ4JUFBJUQ4JUFGJUQ4JUIxJUQ5JThBJUQ4JUE4LzYxNTcxNTIxMjM0MTAzLyI7czoxMToidHdpdHRlcl91cmwiO3M6MjY6Imh0dHBzOi8veC5jb20vZ3JlZW5hcnJvd2FjIjtzOjEzOiJpbnN0YWdyYW1fdXJsIjtzOjQ0OiJodHRwczovL3d3dy5pbnN0YWdyYW0uY29tL2dyZWVuYXJyb3dhY2FkZW15LyI7czoxMToieW91dHViZV91cmwiO3M6MTM5OiJodHRwczovL3d3dy55b3V0dWJlLmNvbS9AJUQ4JUEzJUQ5JTgzJUQ4JUE3JUQ4JUFGJUQ5JThBJUQ5JTg1JUQ5JThBJUQ4JUE5JUQ4JUE3JUQ5JTg0JUQ4JUIzJUQ5JTg3JUQ5JTg1JUQ4JUE3JUQ5JTg0JUQ4JUEzJUQ4JUFFJUQ4JUI2JUQ4JUIxIjtzOjEyOiJsaW5rZWRpbl91cmwiO3M6MjAwOiJodHRwczovL3d3dy5saW5rZWRpbi5jb20vY29tcGFueS8lRDglQjQlRDglQjElRDklODMlRDglQTktJUQ4JUEzJUQ5JTgzJUQ4JUE3JUQ4JUFGJUQ5JThBJUQ5JTg1JUQ5JThBJUQ4JUE5LSVEOCVBNyVEOSU4NCVEOCVCMyVEOSU4NyVEOSU4NS0lRDglQTclRDklODQlRDglQTclRDglQUUlRDglQjYlRDglQjEtJUQ5JTg0JUQ5JTg0JUQ4JUFBJUQ4JUFGLyI7czoxMDoidGlrdG9rX3VybCI7czozODoiaHR0cHM6Ly93d3cudGlrdG9rLmNvbS9AZ3JlZW4uYXJyb3c2NDUiO3M6MTI6InRlbGVncmFtX3VybCI7czoyNToiaHR0cHM6Ly90Lm1lL2dyZWVuYXJyb3dhYyI7czoxMjoic25hcGNoYXRfdXJsIjtzOjQwOiJodHRwczovL3d3dy5zbmFwY2hhdC5jb20vQGVsc2FobWFjYWRlbWljIjtzOjE1OiJnb29nbGVfbWFwc191cmwiO3M6MTEyOToiaHR0cHM6Ly93d3cuZ29vZ2xlLmNvbS9tYXBzP3E9JUQ5JTg1JUQ4JUIxJUQ5JTgzJUQ4JUIyKyVEOCVBMyVEOSU4MyVEOCVBNyVEOCVBRiVEOSU4QSVEOSU4NSVEOSU4QSVEOCVBOSslRDglQTclRDklODQlRDglQjMlRDklODclRDklODUrJUQ4JUE3JUQ5JTg0JUQ4JUEzJUQ4JUFFJUQ4JUI2JUQ4JUIxKyVEOSU4NCVEOSU4NCVEOCVBQSVEOCVBRiVEOCVCMSVEOSU4QSVEOCVBOCVEOCU4QyslRDglQTclRDklODQlRDglQjQlRDglQTclRDglQjElRDglQjkrJUQ4JUE3JUQ5JTg0JUQ4JUI5JUQ4JUE3JUQ5JTg1JUQ4JThDKyVEOCVBNyVEOSU4NCVEOCVBRSVEOCVCNiVEOCVCMSVEOCVBNyVEOCVBMSVEOCU4QyslRDklODUlRDklODMlRDglQTkrJUQ4JUE3JUQ5JTg0JUQ5JTg1JUQ5JTgzJUQ4JUIxJUQ5JTg1JUQ4JUE5Ky0rJUQ4JUFEJUQ5JThBKyVEOCVBNyVEOSU4NCVEOCVCNCVEOCVCMSVEOCVBNyVEOCVBNiVEOCVCOSVEOCU4QyslRDklODUlRDklODMlRDglQTkrMjQyNjclRDglOEMrJUQ4JUE3JUQ5JTg0JUQ5JTg1JUQ5JTg1JUQ5JTg0JUQ5JTgzJUQ4JUE5KyVEOCVBNyVEOSU4NCVEOCVCOSVEOCVCMSVEOCVBOCVEOSU4QSVEOCVBOSslRDglQTclRDklODQlRDglQjMlRDglQjklRDklODglRDglQUYlRDklOEElRDglQTkrJUQ4JUE3JUQ5JTg0JUQ4JUIzJUQ4JUI5JUQ5JTg4JUQ4JUFGJUQ5JThBJUQ4JUE5JmZ0aWQ9MHgxNWMyMDE4YzAzYTA4ZGYxOjB4ZGJkYzM1MDUyMmU2ZDhkOCZlbnRyeT1ncHMmbHVjcz0sOTQyNDY0ODAsOTQyNDI1MDgsOTQyMjQ4MjUsOTQyMjcyNDcsOTQyMjcyNDgsNDcwNzE3MDQsNDcwNjk1MDgsOTQyMTg2NDEsOTQyMjgzNTQsOTQyMzMwNzksOTQyMDMwMTksNDcwODQzMDQsOTQyMDg0NTgsOTQyMDg0NDcmZ19lcD1DQUlTRWpJMExqVXdMakF1TnpBME5ESTNPRGt4TUJnQUlOZUNBeXAtTERrME1qUTJORGd3TERrME1qUXlOVEE0TERrME1qSTBPREkxTERrME1qSTNNalEzTERrME1qSTNNalE0TERRM01EY3hOekEwTERRM01EWTVOVEE0TERrME1qRTROalF4TERrME1qSTRNelUwTERrME1qTXpNRGM1TERrME1qQXpNREU1TERRM01EZzBNekEwTERrME1qQTRORFU0TERrME1qQTRORFEzUWdKRlJ3JTNEJTNEJmdfc3Q9Y29tLmdvb2dsZS5tYXBzLnByZXZpZXcuY29weSI7czoxMDoic2l0ZV90aXRsZSI7czo3OToi2KPZg9in2K/ZitmF2YrYqSDYp9mE2LPZh9mFINin2YTYo9iu2LbYsSDZhNmE2KrYr9ix2YrYqCAtINmF2YPYqSDYp9mE2YXZg9ix2YXYqSI7czoxMzoic2l0ZV9rZXl3b3JkcyI7czoxNTE6Itij2YPYp9iv2YrZhdmK2Kkg2KfZhNiz2YfZhSDYp9mE2KPYrti22LEsINiq2K/YsdmK2KgsINiv2YjYsdin2KosINio2LHZhdis2KksINil2K/Yp9ix2KksINmE2LrYp9iqLCDYqtmC2YbZitipLCDZhdmD2Kkg2KfZhNmF2YPYsdmF2KksINin2YTYs9i52YjYr9mK2KkiO3M6MTE6InNpdGVfYXV0aG9yIjtzOjU1OiLYo9mD2KfYr9mK2YXZitipINin2YTYs9mH2YUg2KfZhNij2K7YttixINmE2YTYqtiv2LHZitioIjtzOjg6Im9nX3RpdGxlIjtzOjc5OiLYo9mD2KfYr9mK2YXZitipINin2YTYs9mH2YUg2KfZhNij2K7YttixINmE2YTYqtiv2LHZitioIC0g2YXZg9ipINin2YTZhdmD2LHZhdipIjtzOjE0OiJvZ19kZXNjcmlwdGlvbiI7czoyMjA6Itij2YPYp9iv2YrZhdmK2Kkg2KfZhNiz2YfZhSDYp9mE2KPYrti22LEg2YTZhNiq2K/YsdmK2Kgg2KjZhdmD2Kkg2KfZhNmF2YPYsdmF2KkgLSDYr9mI2LHYp9iqINiq2K/YsdmK2KjZitipINmF2KrYrti12LXYqSDZgdmKINin2YTYqNix2YXYrNipINmI2KfZhNil2K/Yp9ix2Kkg2YjYp9mE2YTYutin2Kog2YjYp9mE2KrZgtmG2YrYqSDZhdi5INij2YHYttmEINin2YTZhdiv2LHYqNmK2YYiO3M6ODoib2dfaW1hZ2UiO047czoxMjoidHdpdHRlcl9jYXJkIjtzOjE5OiJzdW1tYXJ5X2xhcmdlX2ltYWdlIjt9czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO30=', '1756236412');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.site_title', 's:79:\"أكاديمية السهم الأخضر للتدريب - مكة المكرمة\";', '1756236695');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.site_description', 's:220:\"أكاديمية السهم الأخضر للتدريب بمكة المكرمة - دورات تدريبية متخصصة في البرمجة والإدارة واللغات والتقنية مع أفضل المدربين\";', '1756236695');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.site_keywords', 's:151:\"أكاديمية السهم الأخضر, تدريب, دورات, برمجة, إدارة, لغات, تقنية, مكة المكرمة, السعودية\";', '1756236695');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.site_favicon', 's:83:\"http://127.0.0.1:8000/storage/settings/On4NugP1ykvT92OAp7R42QHnSAG2lwlM77Dja2cq.png\";', '1756236695');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.og_title', 's:79:\"أكاديمية السهم الأخضر للتدريب - مكة المكرمة\";', '1756236695');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.og_description', 's:220:\"أكاديمية السهم الأخضر للتدريب بمكة المكرمة - دورات تدريبية متخصصة في البرمجة والإدارة واللغات والتقنية مع أفضل المدربين\";', '1756236696');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.twitter_card', 's:19:\"summary_large_image\";', '1756236696');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.site_phone', 's:10:\"0508260274\";', '1756236696');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.site_email', 's:28:\"greenarrowacademic@gmail.com\";', '1756236696');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.site_working_hours', 's:45:\"السبت - الخميس: 2:00 م - 10:00 م\";', '1756236696');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.site_logo', 's:83:\"http://127.0.0.1:8000/storage/settings/dvFzCydftm1bjupXqupLPsxxvd1vmXJKjTQPQgW8.png\";', '1756236696');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-setting.site_name', 's:55:\"أكاديمية السهم الأخضر للتدريب\";', '1756236696');

CREATE TABLE `cache_locks` (`key` varchar(255) not null, `owner` varchar(255) not null, `expiration` int(11) not null, primary key (`key`));


CREATE TABLE `jobs` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `queue` varchar(255) not null, `payload` longtext not null, `attempts` int(11) not null, `reserved_at` int(11), `available_at` int(11) not null, `created_at` int(11) not null);


CREATE TABLE `job_batches` (`id` varchar(255) not null, `name` varchar(255) not null, `total_jobs` int(11) not null, `pending_jobs` int(11) not null, `failed_jobs` int(11) not null, `failed_job_ids` longtext not null, `options` longtext, `cancelled_at` int(11), `created_at` int(11) not null, `finished_at` int(11), primary key (`id`));


CREATE TABLE `failed_jobs` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `uuid` varchar(255) not null, `connection` longtext not null, `queue` longtext not null, `payload` longtext not null, `exception` longtext not null, `failed_at` timestamp not null default CURRENT_TIMESTAMP);


CREATE TABLE `roles_and_permissions_tables` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `created_at` timestamp, `updated_at` timestamp);


CREATE TABLE `categories` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `name_ar` varchar(255) not null, `name_en` varchar(255), `slug` varchar(255) not null, `description_ar` longtext, `description_en` longtext, `icon` varchar(255), `color` varchar(255) not null default '#10B981', `image` varchar(255), `is_active` boolean not null default '1', `sort_order` int(11) not null default '0', `created_at` timestamp, `updated_at` timestamp);

INSERT INTO `categories` (`id`, `name_ar`, `name_en`, `slug`, `description_ar`, `description_en`, `icon`, `color`, `image`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES ('1', 'البرمجة وتطوير المواقع', 'Programming & Web Development', 'programming', 'تعلم أحدث تقنيات البرمجة وتطوير المواقع الإلكترونية والتطبيقات', 'Learn the latest programming technologies and web development', 'bi-code-slash', '#3B82F6', NULL, '1', '1', '2025-08-25 11:55:08', '2025-08-25 11:55:08');
INSERT INTO `categories` (`id`, `name_ar`, `name_en`, `slug`, `description_ar`, `description_en`, `icon`, `color`, `image`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES ('2', 'الإدارة والقيادة', 'Management & Leadership', 'management', 'طور مهاراتك القيادية والإدارية مع دورات متخصصة', 'Develop your leadership and management skills', 'bi-people', '#10B981', NULL, '1', '2', '2025-08-25 11:55:08', '2025-08-25 11:55:08');
INSERT INTO `categories` (`id`, `name_ar`, `name_en`, `slug`, `description_ar`, `description_en`, `icon`, `color`, `image`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES ('3', 'اللغات الأجنبية', 'Foreign Languages', 'languages', 'تعلم اللغات الأجنبية مع مدربين متخصصين ومناهج حديثة', 'Learn foreign languages with specialized instructors', 'bi-translate', '#F59E0B', NULL, '1', '3', '2025-08-25 11:55:08', '2025-08-25 11:55:08');
INSERT INTO `categories` (`id`, `name_ar`, `name_en`, `slug`, `description_ar`, `description_en`, `icon`, `color`, `image`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES ('4', 'التقنية والذكاء الاصطناعي', 'Technology & AI', 'ai-tech', 'اكتشف عالم الذكاء الاصطناعي والتعلم الآلي وعلوم البيانات', 'Discover AI, machine learning, and data science', 'bi-cpu', '#8B5CF6', NULL, '1', '4', '2025-08-25 11:55:08', '2025-08-25 11:55:08');
INSERT INTO `categories` (`id`, `name_ar`, `name_en`, `slug`, `description_ar`, `description_en`, `icon`, `color`, `image`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES ('5', 'دورات الأطفال', 'Kids Courses', 'kids', 'برامج تعليمية مخصصة للأطفال تطور مهاراتهم الإبداعية', 'Educational programs designed for children', 'bi-emoji-smile', '#EF4444', NULL, '1', '5', '2025-08-25 11:55:08', '2025-08-25 11:55:08');
INSERT INTO `categories` (`id`, `name_ar`, `name_en`, `slug`, `description_ar`, `description_en`, `icon`, `color`, `image`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES ('6', 'التسويق الرقمي', 'Digital Marketing', 'marketing', 'تعلم استراتيجيات التسويق الرقمي الحديثة', 'Learn modern digital marketing strategies', 'bi-megaphone', '#06B6D4', NULL, '1', '6', '2025-08-25 11:55:08', '2025-08-25 11:55:08');
INSERT INTO `categories` (`id`, `name_ar`, `name_en`, `slug`, `description_ar`, `description_en`, `icon`, `color`, `image`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES ('7', 'تصميم الجرافيك والوسائط', 'Graphic Design & Media', 'design', 'طور مهاراتك في التصميم الجرافيكي والوسائط المتعددة', 'Develop your graphic design and multimedia skills', 'bi-palette', '#EC4899', NULL, '1', '7', '2025-08-25 11:55:08', '2025-08-25 11:55:08');
INSERT INTO `categories` (`id`, `name_ar`, `name_en`, `slug`, `description_ar`, `description_en`, `icon`, `color`, `image`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES ('8', 'الأعمال والريادة', 'Business & Entrepreneurship', 'business', 'تعلم أساسيات إدارة الأعمال والريادة وبناء المشاريع', 'Learn business management and entrepreneurship', 'bi-briefcase', '#84CC16', NULL, '1', '8', '2025-08-25 11:55:08', '2025-08-25 11:55:08');

CREATE TABLE `courses` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `title_ar` varchar(255) not null, `title_en` varchar(255), `slug` varchar(255) not null, `description_ar` longtext not null, `description_en` longtext, `objectives_ar` longtext, `objectives_en` longtext, `requirements_ar` longtext, `requirements_en` longtext, `category_id` int(11) not null, `instructor_id` int(11) not null, `price` numeric not null default '0', `discount_price` numeric, `is_free` boolean not null default '0', `start_date` timestamp, `end_date` timestamp, `duration_hours` int(11), `max_students` int(11) not null default '50', `thumbnail` varchar(255), `banner` varchar(255), `intro_video` varchar(255), `level` varchar(255) ) not null default 'beginner', `type` varchar(255) ) not null default 'online', `status` varchar(255) ) not null default 'draft', `is_featured` boolean not null default '0', `certificate_enabled` boolean not null default '1', `meta_title_ar` varchar(255), `meta_title_en` varchar(255), `meta_description_ar` longtext, `meta_description_en` longtext, `meta_keywords_ar` longtext, `meta_keywords_en` longtext, `enrolled_count` int(11) not null default '0', `rating` numeric not null default '0', `reviews_count` int(11) not null default '0', `views_count` int(11) not null default '0', `created_at` timestamp, `updated_at` timestamp, foreign key(`category_id`) references `categories`(`id`) on delete cascade, foreign key(`instructor_id`) references `users`(`id`) on delete cascade);

INSERT INTO `courses` (`id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `objectives_ar`, `objectives_en`, `requirements_ar`, `requirements_en`, `category_id`, `instructor_id`, `price`, `discount_price`, `is_free`, `start_date`, `end_date`, `duration_hours`, `max_students`, `thumbnail`, `banner`, `intro_video`, `level`, `type`, `status`, `is_featured`, `certificate_enabled`, `meta_title_ar`, `meta_title_en`, `meta_description_ar`, `meta_description_en`, `meta_keywords_ar`, `meta_keywords_en`, `enrolled_count`, `rating`, `reviews_count`, `views_count`, `created_at`, `updated_at`) VALUES ('1', 'تطوير المواقع باستخدام Laravel', 'Web Development with Laravel', 'ttoyr-almoakaa-bastkhdam-laravel', 'دورة شاملة في تطوير المواقع باستخدام إطار العمل Laravel مع التطبيق العملي والمشاريع الحقيقية', NULL, 'تعلم أساسيات Laravel، إنشاء تطبيقات ويب متكاملة، التعامل مع قواعد البيانات، تطوير واجهات المستخدم', NULL, 'معرفة أساسية بـ PHP و HTML و CSS، فهم أساسيات البرمجة', NULL, '1', '34', '1500', NULL, '0', NULL, NULL, '40', '50', NULL, NULL, NULL, 'intermediate', 'online', 'published', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, '45', '4.8', '23', '452', '2025-08-25 11:55:08', '2025-08-26 16:24:33');
INSERT INTO `courses` (`id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `objectives_ar`, `objectives_en`, `requirements_ar`, `requirements_en`, `category_id`, `instructor_id`, `price`, `discount_price`, `is_free`, `start_date`, `end_date`, `duration_hours`, `max_students`, `thumbnail`, `banner`, `intro_video`, `level`, `type`, `status`, `is_featured`, `certificate_enabled`, `meta_title_ar`, `meta_title_en`, `meta_description_ar`, `meta_description_en`, `meta_keywords_ar`, `meta_keywords_en`, `enrolled_count`, `rating`, `reviews_count`, `views_count`, `created_at`, `updated_at`) VALUES ('2', 'إدارة الفرق والقيادة الفعالة', 'Team Management & Effective Leadership', 'team-management-leadership', 'دورة شاملة في تطوير مهارات القيادة والإدارة الحديثة مع التركيز على إدارة الفرق بكفاءة وحل المشكلات وتحفيز الموظفين. ستتعلم أحدث أساليب القيادة الفعالة وأدوات إدارة المشاريع.', NULL, '• فهم أساسيات القيادة الفعالة وأنماط القيادة المختلفة
• تطوير مهارات إدارة الفرق وتحفيز الموظفين
• تعلم أساليب حل المشكلات واتخاذ القرارات
• إتقان مهارات التواصل والتفاوض
• تطبيق أدوات إدارة المشاريع الحديثة
• تطوير الاستراتيجيات التنظيمية', NULL, '• لا توجد متطلبات مسبقة - مناسبة لجميع المستويات
• الرغبة في تطوير المهارات القيادية
• الاستعداد للتعلم والتطبيق العملي
• خبرة عمل أساسية (مفضلة وليست مطلوبة)', NULL, '2', '34', '1200', NULL, '0', NULL, NULL, '30', '50', NULL, NULL, NULL, 'beginner', 'online', 'published', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, '38', '4.9', '19', '385', '2025-08-25 11:55:08', '2025-08-26 16:26:35');
INSERT INTO `courses` (`id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `objectives_ar`, `objectives_en`, `requirements_ar`, `requirements_en`, `category_id`, `instructor_id`, `price`, `discount_price`, `is_free`, `start_date`, `end_date`, `duration_hours`, `max_students`, `thumbnail`, `banner`, `intro_video`, `level`, `type`, `status`, `is_featured`, `certificate_enabled`, `meta_title_ar`, `meta_title_en`, `meta_description_ar`, `meta_description_en`, `meta_keywords_ar`, `meta_keywords_en`, `enrolled_count`, `rating`, `reviews_count`, `views_count`, `created_at`, `updated_at`) VALUES ('3', 'اللغة الإنجليزية للمبتدئين', 'English for Beginners', 'allgh-alanglyzy-llmbtdyyn', 'تعلم أساسيات اللغة الإنجليزية من الصفر مع التركيز على المحادثة والتواصل اليومي', NULL, 'إتقان أساسيات اللغة، التحدث بثقة، فهم النصوص البسيطة، كتابة الجمل الأساسية', NULL, 'لا توجد متطلبات مسبقة، مناسب للمبتدئين تماماً', NULL, '3', '34', '800', NULL, '0', NULL, NULL, '50', '50', NULL, NULL, NULL, 'beginner', 'online', 'published', '0', '1', NULL, NULL, NULL, NULL, NULL, NULL, '67', '4.7', '34', '520', '2025-08-25 11:55:08', '2025-08-26 16:24:33');
INSERT INTO `courses` (`id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `objectives_ar`, `objectives_en`, `requirements_ar`, `requirements_en`, `category_id`, `instructor_id`, `price`, `discount_price`, `is_free`, `start_date`, `end_date`, `duration_hours`, `max_students`, `thumbnail`, `banner`, `intro_video`, `level`, `type`, `status`, `is_featured`, `certificate_enabled`, `meta_title_ar`, `meta_title_en`, `meta_description_ar`, `meta_description_en`, `meta_keywords_ar`, `meta_keywords_en`, `enrolled_count`, `rating`, `reviews_count`, `views_count`, `created_at`, `updated_at`) VALUES ('4', 'مقدمة في الذكاء الاصطناعي', 'Introduction to Artificial Intelligence', 'mkdm-fy-althkaaa-alastnaaay', 'فهم أساسيات الذكاء الاصطناعي وتطبيقاته في الحياة العملية مع أمثلة عملية', NULL, 'فهم مفاهيم الذكاء الاصطناعي، التعلم الآلي، التطبيقات العملية، أدوات AI الحديثة', NULL, 'معرفة أساسية بالرياضيات والبرمجة، فهم أساسي للحاسوب', NULL, '4', '34', '2000', NULL, '0', NULL, NULL, '35', '50', NULL, NULL, NULL, 'intermediate', 'online', 'published', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, '28', '4.6', '15', '322', '2025-08-25 11:55:08', '2025-08-26 16:24:33');
INSERT INTO `courses` (`id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `objectives_ar`, `objectives_en`, `requirements_ar`, `requirements_en`, `category_id`, `instructor_id`, `price`, `discount_price`, `is_free`, `start_date`, `end_date`, `duration_hours`, `max_students`, `thumbnail`, `banner`, `intro_video`, `level`, `type`, `status`, `is_featured`, `certificate_enabled`, `meta_title_ar`, `meta_title_en`, `meta_description_ar`, `meta_description_en`, `meta_keywords_ar`, `meta_keywords_en`, `enrolled_count`, `rating`, `reviews_count`, `views_count`, `created_at`, `updated_at`) VALUES ('5', 'البرمجة للأطفال مع Scratch', 'Kids Programming with Scratch', 'albrmg-llatfal-maa-scratch', 'تعليم الأطفال أساسيات البرمجة بطريقة مرحة وتفاعلية مع التركيز على تطوير التفكير المنطقي', NULL, 'فهم مفاهيم البرمجة الأساسية، إنشاء ألعاب بسيطة، تطوير التفكير المنطقي، تعزيز الإبداع', NULL, 'العمر من 8-14 سنة، حاسوب متصل بالإنترنت', NULL, '5', '34', '600', NULL, '0', NULL, NULL, '20', '50', NULL, NULL, NULL, 'beginner', 'online', 'published', '0', '1', NULL, NULL, NULL, NULL, NULL, NULL, '89', '4.9', '42', '680', '2025-08-25 11:55:08', '2025-08-26 16:24:33');
INSERT INTO `courses` (`id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `objectives_ar`, `objectives_en`, `requirements_ar`, `requirements_en`, `category_id`, `instructor_id`, `price`, `discount_price`, `is_free`, `start_date`, `end_date`, `duration_hours`, `max_students`, `thumbnail`, `banner`, `intro_video`, `level`, `type`, `status`, `is_featured`, `certificate_enabled`, `meta_title_ar`, `meta_title_en`, `meta_description_ar`, `meta_description_en`, `meta_keywords_ar`, `meta_keywords_en`, `enrolled_count`, `rating`, `reviews_count`, `views_count`, `created_at`, `updated_at`) VALUES ('6', 'التسويق عبر وسائل التواصل الاجتماعي', 'Social Media Marketing', 'altsoyk-aabr-osayl-altoasl-alagtmaaay', 'استراتيجيات التسويق الحديثة عبر منصات التواصل الاجتماعي مع التركيز على النتائج العملية', NULL, 'إنشاء حملات تسويقية فعالة، تحليل البيانات، زيادة التفاعل، بناء العلامة التجارية', NULL, 'معرفة أساسية بوسائل التواصل الاجتماعي، حساب على المنصات المختلفة', NULL, '6', '34', '1000', NULL, '0', NULL, NULL, '25', '50', NULL, NULL, NULL, 'beginner', 'online', 'published', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, '52', '4.5', '28', '410', '2025-08-25 11:55:08', '2025-08-26 16:24:33');
INSERT INTO `courses` (`id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `objectives_ar`, `objectives_en`, `requirements_ar`, `requirements_en`, `category_id`, `instructor_id`, `price`, `discount_price`, `is_free`, `start_date`, `end_date`, `duration_hours`, `max_students`, `thumbnail`, `banner`, `intro_video`, `level`, `type`, `status`, `is_featured`, `certificate_enabled`, `meta_title_ar`, `meta_title_en`, `meta_description_ar`, `meta_description_en`, `meta_keywords_ar`, `meta_keywords_en`, `enrolled_count`, `rating`, `reviews_count`, `views_count`, `created_at`, `updated_at`) VALUES ('7', 'تصميم الشعارات والهوية البصرية', 'Logo Design & Visual Identity', 'tsmym-alshaaarat-oalhoy-albsry', 'تعلم تصميم الشعارات والهوية البصرية الاحترافية باستخدام أحدث البرامج والتقنيات', NULL, 'تصميم شعارات احترافية، تطوير الهوية البصرية، استخدام برامج التصميم، فهم مبادئ التصميم', NULL, 'حاسوب مع برامج التصميم، حس فني، رغبة في التعلم', NULL, '7', '34', '1300', NULL, '0', NULL, NULL, '30', '50', NULL, NULL, NULL, 'beginner', 'online', 'published', '0', '1', NULL, NULL, NULL, NULL, NULL, NULL, '41', '4.7', '22', '350', '2025-08-25 11:55:08', '2025-08-26 16:24:33');
INSERT INTO `courses` (`id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `objectives_ar`, `objectives_en`, `requirements_ar`, `requirements_en`, `category_id`, `instructor_id`, `price`, `discount_price`, `is_free`, `start_date`, `end_date`, `duration_hours`, `max_students`, `thumbnail`, `banner`, `intro_video`, `level`, `type`, `status`, `is_featured`, `certificate_enabled`, `meta_title_ar`, `meta_title_en`, `meta_description_ar`, `meta_description_en`, `meta_keywords_ar`, `meta_keywords_en`, `enrolled_count`, `rating`, `reviews_count`, `views_count`, `created_at`, `updated_at`) VALUES ('8', 'إنشاء المشاريع الريادية', 'Entrepreneurship & Startup Creation', 'anshaaa-almsharyaa-alryady', 'تعلم أساسيات إنشاء وإدارة المشاريع الريادية من الفكرة إلى النجاح', NULL, 'تطوير الأفكار التجارية، كتابة خطط الأعمال، إدارة الموارد، استراتيجيات النمو', NULL, 'لا توجد متطلبات مسبقة، مناسب للرياديين والمستثمرين', NULL, '8', '34', '1800', NULL, '0', NULL, NULL, '35', '50', NULL, NULL, NULL, 'intermediate', 'online', 'published', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, '33', '4.8', '17', '290', '2025-08-25 11:55:08', '2025-08-26 16:24:33');
INSERT INTO `courses` (`id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `objectives_ar`, `objectives_en`, `requirements_ar`, `requirements_en`, `category_id`, `instructor_id`, `price`, `discount_price`, `is_free`, `start_date`, `end_date`, `duration_hours`, `max_students`, `thumbnail`, `banner`, `intro_video`, `level`, `type`, `status`, `is_featured`, `certificate_enabled`, `meta_title_ar`, `meta_title_en`, `meta_description_ar`, `meta_description_en`, `meta_keywords_ar`, `meta_keywords_en`, `enrolled_count`, `rating`, `reviews_count`, `views_count`, `created_at`, `updated_at`) VALUES ('9', 'مقدمة في البرمجة', 'Introduction to Programming', 'intro-programming', 'دورة شاملة لتعلم أساسيات البرمجة', 'Comprehensive course for learning programming basics', NULL, NULL, NULL, NULL, '1', '34', '299', NULL, '0', NULL, NULL, NULL, '50', NULL, NULL, NULL, 'beginner', 'online', 'published', '0', '1', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '2025-08-26 16:06:05', '2025-08-26 16:24:33');
INSERT INTO `courses` (`id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `objectives_ar`, `objectives_en`, `requirements_ar`, `requirements_en`, `category_id`, `instructor_id`, `price`, `discount_price`, `is_free`, `start_date`, `end_date`, `duration_hours`, `max_students`, `thumbnail`, `banner`, `intro_video`, `level`, `type`, `status`, `is_featured`, `certificate_enabled`, `meta_title_ar`, `meta_title_en`, `meta_description_ar`, `meta_description_en`, `meta_keywords_ar`, `meta_keywords_en`, `enrolled_count`, `rating`, `reviews_count`, `views_count`, `created_at`, `updated_at`) VALUES ('10', 'تصميم المواقع الإلكترونية', 'Web Design', 'web-design', 'تعلم تصميم المواقع الإلكترونية الحديثة', 'Learn modern web design', NULL, NULL, NULL, NULL, '7', '34', '199', NULL, '0', NULL, NULL, NULL, '50', NULL, NULL, NULL, 'beginner', 'online', 'published', '0', '1', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '26', '2025-08-26 16:06:05', '2025-08-26 16:24:33');
INSERT INTO `courses` (`id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `objectives_ar`, `objectives_en`, `requirements_ar`, `requirements_en`, `category_id`, `instructor_id`, `price`, `discount_price`, `is_free`, `start_date`, `end_date`, `duration_hours`, `max_students`, `thumbnail`, `banner`, `intro_video`, `level`, `type`, `status`, `is_featured`, `certificate_enabled`, `meta_title_ar`, `meta_title_en`, `meta_description_ar`, `meta_description_en`, `meta_keywords_ar`, `meta_keywords_en`, `enrolled_count`, `rating`, `reviews_count`, `views_count`, `created_at`, `updated_at`) VALUES ('11', 'التسويق الرقمي', 'Digital Marketing', 'digital-marketing', 'استراتيجيات التسويق الرقمي الفعالة', 'Effective digital marketing strategies', NULL, NULL, NULL, NULL, '6', '34', '399', NULL, '0', NULL, NULL, NULL, '50', NULL, NULL, NULL, 'beginner', 'online', 'published', '0', '1', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '2025-08-26 16:06:05', '2025-08-26 16:24:33');

CREATE TABLE `lessons` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `course_id` int(11) not null, `title_ar` varchar(255) not null, `title_en` varchar(255), `slug` varchar(255) not null, `description_ar` longtext, `description_en` longtext, `type` varchar(255) ) not null default 'video', `video_url` varchar(255), `video_duration` varchar(255), `pdf_file` varchar(255), `longtext_content` longtext, `attachments` longtext, `live_session_date` timestamp, `google_meet_link` varchar(255), `meeting_id` varchar(255), `meeting_password` varchar(255), `is_free` boolean not null default '0', `is_published` boolean not null default '1', `sort_order` int(11) not null default '0', `duration_minutes` int(11) not null default '0', `views_count` int(11) not null default '0', `completed_count` int(11) not null default '0', `created_at` timestamp, `updated_at` timestamp, foreign key(`course_id`) references `courses`(`id`) on delete cascade);

INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('1', '2', 'مقدمة في القيادة والإدارة', NULL, 'mkdm-fy-alkyad-oaladar', 'نظرة عامة على مفهوم القيادة والإدارة، الفرق بين القائد والمدير، وأهمية القيادة الفعالة في المنظمات الحديثة.', NULL, 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, '
## مقدمة في القيادة والإدارة

### ما هي القيادة؟
القيادة هي عملية التأثير على الآخرين لتحقيق أهداف مشتركة. القائد الفعال هو من يستطيع تحفيز فريقه وإلهامهم للعمل بأفضل ما لديهم.

### الفرق بين القائد والمدير
- **المدير**: يركز على المهام والعمليات، يتبع القواعد والإجراءات
- **القائد**: يركز على الأهداف والرؤية، يلهم ويحفز الفريق

### أهمية القيادة في المنظمات الحديثة
1. تحسين الأداء التنظيمي
2. زيادة رضا الموظفين
3. تعزيز الابتكار والإبداع
4. بناء ثقافة عمل إيجابية

### خصائص القيادة الفعالة
- التواصل الفعال
- الذكاء العاطفي
- القدرة على اتخاذ القرارات
- النزاهة والشفافية
- المرونة والتكيف

### التطبيق العملي
في هذا الدرس ستتعلم:
- كيفية تطوير رؤية واضحة لفريقك
- طرق تحفيز الموظفين
- مهارات التواصل القيادي
- أساليب بناء الثقة
                    ', '[\"\\u0645\\u062e\\u0637\\u0637-\\u0627\\u0644\\u0642\\u064a\\u0627\\u062f\\u0629-\\u0648\\u0627\\u0644\\u0625\\u062f\\u0627\\u0631\\u0629.pdf\",\"\\u0646\\u0645\\u0648\\u0630\\u062c-\\u062a\\u0642\\u064a\\u064a\\u0645-\\u0627\\u0644\\u0642\\u064a\\u0627\\u062f\\u0629.docx\",\"\\u0642\\u0627\\u0626\\u0645\\u0629-\\u0645\\u0631\\u0627\\u062c\\u0639\\u0629-\\u0627\\u0644\\u0642\\u0627\\u0626\\u062f-\\u0627\\u0644\\u0641\\u0639\\u0627\\u0644.pdf\"]', NULL, NULL, NULL, NULL, '1', '1', '1', '45', '0', '0', '2025-08-25 17:49:59', '2025-08-25 17:55:33');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('2', '2', 'أنماط القيادة المختلفة', NULL, 'anmat-alkyad-almkhtlf', 'استكشاف أنماط القيادة المختلفة: القيادة الديمقراطية، الاستبدادية، الحرة، والتحويلية. متى وكيف تستخدم كل نمط.', NULL, 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, '
## أنماط القيادة المختلفة

### 1. القيادة الاستبدادية (Autocratic)
**الخصائص:**
- اتخاذ القرارات منفرداً
- التحكم المطلق
- عدم مشاركة المعلومات

**متى تستخدم:**
- في حالات الطوارئ
- مع الموظفين الجدد
- عند الحاجة لسرعة في التنفيذ

### 2. القيادة الديمقراطية (Democratic)
**الخصائص:**
- مشاركة الفريق في القرارات
- التشاور والمناقشة
- بناء الإجماع

**متى تستخدم:**
- في المشاريع الإبداعية
- مع الفرق المتمرسة
- عند الحاجة لابتكار حلول

### 3. القيادة الحرة (Laissez-faire)
**الخصائص:**
- حرية كاملة للفريق
- تدخل محدود من القائد
- الاعتماد على المبادرة الذاتية

**متى تستخدم:**
- مع الخبراء المتخصصين
- في بيئات العمل المرنة
- عند الحاجة للإبداع

### 4. القيادة التحويلية (Transformational)
**الخصائص:**
- إلهام وتطوير الفريق
- رؤية واضحة للمستقبل
- تحفيز التغيير الإيجابي

**متى تستخدم:**
- في فترات التغيير
- مع الفرق عالية الأداء
- عند الحاجة للتحول التنظيمي

### اختيار النمط المناسب
يعتمد اختيار نمط القيادة على:
- طبيعة المهمة
- خبرة الفريق
- الوقت المتاح
- الثقافة التنظيمية
                    ', '[\"\\u062f\\u0644\\u064a\\u0644-\\u0623\\u0646\\u0645\\u0627\\u0637-\\u0627\\u0644\\u0642\\u064a\\u0627\\u062f\\u0629.pdf\",\"\\u0627\\u0633\\u062a\\u0628\\u064a\\u0627\\u0646-\\u0646\\u0645\\u0637-\\u0627\\u0644\\u0642\\u064a\\u0627\\u062f\\u0629.docx\",\"\\u062d\\u0627\\u0644\\u0627\\u062a-\\u0639\\u0645\\u0644\\u064a\\u0629-\\u0644\\u0623\\u0646\\u0645\\u0627\\u0637-\\u0627\\u0644\\u0642\\u064a\\u0627\\u062f\\u0629.pdf\"]', NULL, NULL, NULL, NULL, '0', '1', '2', '60', '0', '0', '2025-08-25 17:49:59', '2025-08-25 17:55:33');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('3', '2', 'بناء وإدارة الفرق الفعالة', NULL, 'bnaaa-oadar-alfrk-alfaaal', 'كيفية بناء فريق عمل فعال، مراحل تطور الفريق، أدوار أعضاء الفريق، وإدارة ديناميكيات الفريق.', NULL, 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, '
## بناء وإدارة الفرق الفعالة

### مراحل تطور الفريق (Tuckman Model)

#### 1. مرحلة التشكيل (Forming)
- التعارف بين الأعضاء
- تحديد الأدوار والمسؤوليات
- بناء الثقة الأولية

#### 2. مرحلة العصف الذهني (Storming)
- ظهور الصراعات والخلافات
- مناقشة الأهداف والطرق
- تحديد القيادة

#### 3. مرحلة المعايير (Norming)
- تطوير قواعد العمل
- بناء العلاقات
- تحسين التواصل

#### 4. مرحلة الأداء (Performing)
- العمل بكفاءة عالية
- تحقيق الأهداف
- الابتكار والإبداع

#### 5. مرحلة الإنهاء (Adjourning)
- إنهاء المشروع
- تقييم النتائج
- الاحتفال بالإنجازات

### أدوار أعضاء الفريق (Belbin Team Roles)
1. **المنسق (Coordinator)**: يوجه الفريق نحو الأهداف
2. **المشكل (Shaper)**: يدفع الفريق للأمام
3. **المبتكر (Plant)**: يقدم الأفكار الإبداعية
4. **المحلل (Monitor Evaluator)**: يحلل الخيارات
5. **المنفذ (Implementer)**: يحول الأفكار إلى واقع
6. **المكمل (Completer Finisher)**: يضمن إكمال المهام
7. **الباحث عن الموارد (Resource Investigator)**: يجلب المعلومات والموارد
8. **المتخصص (Specialist)**: يوفر المعرفة المتخصصة
9. **العامل الجماعي (Team Worker)**: يدعم الفريق

### إدارة ديناميكيات الفريق
- حل الصراعات بفعالية
- تحسين التواصل
- بناء الثقة المتبادلة
- تحفيز التعاون
                    ', '[\"\\u062f\\u0644\\u064a\\u0644-\\u0628\\u0646\\u0627\\u0621-\\u0627\\u0644\\u0641\\u0631\\u0642.pdf\",\"\\u0646\\u0645\\u0648\\u0630\\u062c-\\u062a\\u0642\\u064a\\u064a\\u0645-\\u0623\\u062f\\u0648\\u0627\\u0631-\\u0627\\u0644\\u0641\\u0631\\u064a\\u0642.docx\",\"\\u0627\\u0633\\u062a\\u0631\\u0627\\u062a\\u064a\\u062c\\u064a\\u0627\\u062a-\\u062d\\u0644-\\u0627\\u0644\\u0635\\u0631\\u0627\\u0639\\u0627\\u062a.pdf\"]', NULL, NULL, NULL, NULL, '0', '1', '3', '75', '0', '0', '2025-08-25 17:49:59', '2025-08-25 17:55:33');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('4', '2', 'مهارات التواصل القيادي', NULL, 'mharat-altoasl-alkyady', 'تطوير مهارات التواصل الفعال، الاستماع النشط، تقديم التغذية الراجعة، والتواصل مع مختلف أنواع الشخصيات.', NULL, 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, '
## محتوى الدرس

هذا الدرس يتضمن:
- شرح مفصل للمفاهيم
- أمثلة عملية
- تمارين تطبيقية
- موارد إضافية للقراءة

### النقاط الرئيسية
1. فهم المفاهيم الأساسية
2. تطبيق المعرفة عملياً
3. تطوير المهارات المطلوبة
4. تقييم التعلم

### التطبيق العملي
- تمارين فردية
- أنشطة جماعية
- حالات عملية
- تقييم ذاتي

### الموارد الإضافية
- قراءات موصى بها
- فيديوهات تعليمية
- مقالات مهمة
- روابط مفيدة
                    ', '[\"\\u0645\\u0644\\u062e\\u0635-\\u0627\\u0644\\u062f\\u0631\\u0633.pdf\",\"\\u062a\\u0645\\u0627\\u0631\\u064a\\u0646-\\u062a\\u0637\\u0628\\u064a\\u0642\\u064a\\u0629.docx\",\"\\u0645\\u0648\\u0627\\u0631\\u062f-\\u0625\\u0636\\u0627\\u0641\\u064a\\u0629.pdf\"]', NULL, NULL, NULL, NULL, '0', '1', '4', '50', '0', '0', '2025-08-25 17:49:59', '2025-08-25 17:55:33');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('5', '2', 'تحفيز الموظفين وإدارة الأداء', NULL, 'thfyz-almothfyn-oadar-aladaaa', 'نظريات التحفيز، كيفية تحفيز الموظفين، إدارة الأداء، وتطوير خطط التطوير المهني.', NULL, 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, '
## محتوى الدرس

هذا الدرس يتضمن:
- شرح مفصل للمفاهيم
- أمثلة عملية
- تمارين تطبيقية
- موارد إضافية للقراءة

### النقاط الرئيسية
1. فهم المفاهيم الأساسية
2. تطبيق المعرفة عملياً
3. تطوير المهارات المطلوبة
4. تقييم التعلم

### التطبيق العملي
- تمارين فردية
- أنشطة جماعية
- حالات عملية
- تقييم ذاتي

### الموارد الإضافية
- قراءات موصى بها
- فيديوهات تعليمية
- مقالات مهمة
- روابط مفيدة
                    ', '[\"\\u0645\\u0644\\u062e\\u0635-\\u0627\\u0644\\u062f\\u0631\\u0633.pdf\",\"\\u062a\\u0645\\u0627\\u0631\\u064a\\u0646-\\u062a\\u0637\\u0628\\u064a\\u0642\\u064a\\u0629.docx\",\"\\u0645\\u0648\\u0627\\u0631\\u062f-\\u0625\\u0636\\u0627\\u0641\\u064a\\u0629.pdf\"]', NULL, NULL, NULL, NULL, '0', '1', '5', '65', '0', '0', '2025-08-25 17:49:59', '2025-08-25 17:55:33');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('6', '2', 'حل المشكلات واتخاذ القرارات', NULL, 'hl-almshklat-oatkhath-alkrarat', 'طرق حل المشكلات المنهجية، أدوات اتخاذ القرارات، تحليل المخاطر، وتطوير الحلول الإبداعية.', NULL, 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, '
## محتوى الدرس

هذا الدرس يتضمن:
- شرح مفصل للمفاهيم
- أمثلة عملية
- تمارين تطبيقية
- موارد إضافية للقراءة

### النقاط الرئيسية
1. فهم المفاهيم الأساسية
2. تطبيق المعرفة عملياً
3. تطوير المهارات المطلوبة
4. تقييم التعلم

### التطبيق العملي
- تمارين فردية
- أنشطة جماعية
- حالات عملية
- تقييم ذاتي

### الموارد الإضافية
- قراءات موصى بها
- فيديوهات تعليمية
- مقالات مهمة
- روابط مفيدة
                    ', '[\"\\u0645\\u0644\\u062e\\u0635-\\u0627\\u0644\\u062f\\u0631\\u0633.pdf\",\"\\u062a\\u0645\\u0627\\u0631\\u064a\\u0646-\\u062a\\u0637\\u0628\\u064a\\u0642\\u064a\\u0629.docx\",\"\\u0645\\u0648\\u0627\\u0631\\u062f-\\u0625\\u0636\\u0627\\u0641\\u064a\\u0629.pdf\"]', NULL, NULL, NULL, NULL, '0', '1', '6', '55', '0', '0', '2025-08-25 17:49:59', '2025-08-25 17:55:33');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('7', '2', 'إدارة الصراعات والتفاوض', NULL, 'adar-alsraaaat-oaltfaod', 'فهم مصادر الصراعات، استراتيجيات حل الصراعات، مهارات التفاوض، وإدارة الخلافات في مكان العمل.', NULL, 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, '
## محتوى الدرس

هذا الدرس يتضمن:
- شرح مفصل للمفاهيم
- أمثلة عملية
- تمارين تطبيقية
- موارد إضافية للقراءة

### النقاط الرئيسية
1. فهم المفاهيم الأساسية
2. تطبيق المعرفة عملياً
3. تطوير المهارات المطلوبة
4. تقييم التعلم

### التطبيق العملي
- تمارين فردية
- أنشطة جماعية
- حالات عملية
- تقييم ذاتي

### الموارد الإضافية
- قراءات موصى بها
- فيديوهات تعليمية
- مقالات مهمة
- روابط مفيدة
                    ', '[\"\\u0645\\u0644\\u062e\\u0635-\\u0627\\u0644\\u062f\\u0631\\u0633.pdf\",\"\\u062a\\u0645\\u0627\\u0631\\u064a\\u0646-\\u062a\\u0637\\u0628\\u064a\\u0642\\u064a\\u0629.docx\",\"\\u0645\\u0648\\u0627\\u0631\\u062f-\\u0625\\u0636\\u0627\\u0641\\u064a\\u0629.pdf\"]', NULL, NULL, NULL, NULL, '0', '1', '7', '70', '0', '0', '2025-08-25 17:49:59', '2025-08-25 17:55:33');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('8', '2', 'إدارة التغيير والابتكار', NULL, 'adar-altghyyr-oalabtkar', 'كيفية قيادة التغيير في المنظمة، إدارة مقاومة التغيير، تعزيز ثقافة الابتكار، والتكيف مع التحديات الجديدة.', NULL, 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, '
## محتوى الدرس

هذا الدرس يتضمن:
- شرح مفصل للمفاهيم
- أمثلة عملية
- تمارين تطبيقية
- موارد إضافية للقراءة

### النقاط الرئيسية
1. فهم المفاهيم الأساسية
2. تطبيق المعرفة عملياً
3. تطوير المهارات المطلوبة
4. تقييم التعلم

### التطبيق العملي
- تمارين فردية
- أنشطة جماعية
- حالات عملية
- تقييم ذاتي

### الموارد الإضافية
- قراءات موصى بها
- فيديوهات تعليمية
- مقالات مهمة
- روابط مفيدة
                    ', '[\"\\u0645\\u0644\\u062e\\u0635-\\u0627\\u0644\\u062f\\u0631\\u0633.pdf\",\"\\u062a\\u0645\\u0627\\u0631\\u064a\\u0646-\\u062a\\u0637\\u0628\\u064a\\u0642\\u064a\\u0629.docx\",\"\\u0645\\u0648\\u0627\\u0631\\u062f-\\u0625\\u0636\\u0627\\u0641\\u064a\\u0629.pdf\"]', NULL, NULL, NULL, NULL, '0', '1', '8', '60', '0', '0', '2025-08-25 17:49:59', '2025-08-25 17:55:33');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('9', '2', 'التخطيط الاستراتيجي وإدارة المشاريع', NULL, 'altkhtyt-alastratygy-oadar-almsharyaa', 'أساسيات التخطيط الاستراتيجي، إدارة المشاريع، تحديد الأهداف، وقياس النتائج.', NULL, 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, '
## محتوى الدرس

هذا الدرس يتضمن:
- شرح مفصل للمفاهيم
- أمثلة عملية
- تمارين تطبيقية
- موارد إضافية للقراءة

### النقاط الرئيسية
1. فهم المفاهيم الأساسية
2. تطبيق المعرفة عملياً
3. تطوير المهارات المطلوبة
4. تقييم التعلم

### التطبيق العملي
- تمارين فردية
- أنشطة جماعية
- حالات عملية
- تقييم ذاتي

### الموارد الإضافية
- قراءات موصى بها
- فيديوهات تعليمية
- مقالات مهمة
- روابط مفيدة
                    ', '[\"\\u0645\\u0644\\u062e\\u0635-\\u0627\\u0644\\u062f\\u0631\\u0633.pdf\",\"\\u062a\\u0645\\u0627\\u0631\\u064a\\u0646-\\u062a\\u0637\\u0628\\u064a\\u0642\\u064a\\u0629.docx\",\"\\u0645\\u0648\\u0627\\u0631\\u062f-\\u0625\\u0636\\u0627\\u0641\\u064a\\u0629.pdf\"]', NULL, NULL, NULL, NULL, '0', '1', '9', '80', '0', '0', '2025-08-25 17:49:59', '2025-08-25 17:55:33');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('10', '2', 'الذكاء العاطفي في القيادة', NULL, 'althkaaa-alaaatfy-fy-alkyad', 'تطوير الذكاء العاطفي، إدارة المشاعر، فهم مشاعر الآخرين، وبناء علاقات قوية في العمل.', NULL, 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, '
## محتوى الدرس

هذا الدرس يتضمن:
- شرح مفصل للمفاهيم
- أمثلة عملية
- تمارين تطبيقية
- موارد إضافية للقراءة

### النقاط الرئيسية
1. فهم المفاهيم الأساسية
2. تطبيق المعرفة عملياً
3. تطوير المهارات المطلوبة
4. تقييم التعلم

### التطبيق العملي
- تمارين فردية
- أنشطة جماعية
- حالات عملية
- تقييم ذاتي

### الموارد الإضافية
- قراءات موصى بها
- فيديوهات تعليمية
- مقالات مهمة
- روابط مفيدة
                    ', '[\"\\u0645\\u0644\\u062e\\u0635-\\u0627\\u0644\\u062f\\u0631\\u0633.pdf\",\"\\u062a\\u0645\\u0627\\u0631\\u064a\\u0646-\\u062a\\u0637\\u0628\\u064a\\u0642\\u064a\\u0629.docx\",\"\\u0645\\u0648\\u0627\\u0631\\u062f-\\u0625\\u0636\\u0627\\u0641\\u064a\\u0629.pdf\"]', NULL, NULL, NULL, NULL, '0', '1', '10', '45', '0', '0', '2025-08-25 17:49:59', '2025-08-25 17:55:33');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('11', '2', 'إدارة الوقت وتحديد الأولويات', NULL, 'adar-alokt-othdyd-alaoloyat', 'تقنيات إدارة الوقت الفعالة، تحديد الأولويات، التخطيط اليومي، وتجنب التسويف.', NULL, 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, '
## محتوى الدرس

هذا الدرس يتضمن:
- شرح مفصل للمفاهيم
- أمثلة عملية
- تمارين تطبيقية
- موارد إضافية للقراءة

### النقاط الرئيسية
1. فهم المفاهيم الأساسية
2. تطبيق المعرفة عملياً
3. تطوير المهارات المطلوبة
4. تقييم التعلم

### التطبيق العملي
- تمارين فردية
- أنشطة جماعية
- حالات عملية
- تقييم ذاتي

### الموارد الإضافية
- قراءات موصى بها
- فيديوهات تعليمية
- مقالات مهمة
- روابط مفيدة
                    ', '[\"\\u0645\\u0644\\u062e\\u0635-\\u0627\\u0644\\u062f\\u0631\\u0633.pdf\",\"\\u062a\\u0645\\u0627\\u0631\\u064a\\u0646-\\u062a\\u0637\\u0628\\u064a\\u0642\\u064a\\u0629.docx\",\"\\u0645\\u0648\\u0627\\u0631\\u062f-\\u0625\\u0636\\u0627\\u0641\\u064a\\u0629.pdf\"]', NULL, NULL, NULL, NULL, '0', '1', '11', '50', '0', '0', '2025-08-25 17:49:59', '2025-08-25 17:55:33');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('12', '2', 'التطوير المهني والقيادة المستدامة', NULL, 'alttoyr-almhny-oalkyad-almstdam', 'تطوير خطة التطوير المهني، القيادة المستدامة، التوازن بين العمل والحياة، والاستمرار في التعلم.', NULL, 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, '
## محتوى الدرس

هذا الدرس يتضمن:
- شرح مفصل للمفاهيم
- أمثلة عملية
- تمارين تطبيقية
- موارد إضافية للقراءة

### النقاط الرئيسية
1. فهم المفاهيم الأساسية
2. تطبيق المعرفة عملياً
3. تطوير المهارات المطلوبة
4. تقييم التعلم

### التطبيق العملي
- تمارين فردية
- أنشطة جماعية
- حالات عملية
- تقييم ذاتي

### الموارد الإضافية
- قراءات موصى بها
- فيديوهات تعليمية
- مقالات مهمة
- روابط مفيدة
                    ', '[\"\\u0645\\u0644\\u062e\\u0635-\\u0627\\u0644\\u062f\\u0631\\u0633.pdf\",\"\\u062a\\u0645\\u0627\\u0631\\u064a\\u0646-\\u062a\\u0637\\u0628\\u064a\\u0642\\u064a\\u0629.docx\",\"\\u0645\\u0648\\u0627\\u0631\\u062f-\\u0625\\u0636\\u0627\\u0641\\u064a\\u0629.pdf\"]', NULL, NULL, NULL, NULL, '0', '1', '12', '60', '0', '0', '2025-08-25 17:49:59', '2025-08-25 17:55:33');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('13', '2', 'دليل القيادة الفعالة - PDF', NULL, 'dlyl-alkyad-alfaaal-pdf', 'دليل شامل يحتوي على جميع النقاط المهمة في القيادة الفعالة، نماذج عملية، وقوالب جاهزة للاستخدام.', NULL, 'pdf', NULL, NULL, NULL, '
# دليل القيادة الفعالة الشامل

## المحتويات

### الفصل الأول: أساسيات القيادة
- تعريف القيادة وأنواعها
- الفرق بين القيادة والإدارة
- خصائص القائد الفعال
- نظريات القيادة الحديثة

### الفصل الثاني: مهارات القيادة الأساسية
- مهارات التواصل
- مهارات الاستماع النشط
- مهارات تقديم التغذية الراجعة
- مهارات التحفيز

### الفصل الثالث: إدارة الفرق
- بناء الفرق الفعالة
- مراحل تطور الفريق
- أدوار أعضاء الفريق
- إدارة الصراعات

### الفصل الرابع: حل المشكلات واتخاذ القرارات
- طرق حل المشكلات
- أدوات اتخاذ القرارات
- تحليل المخاطر
- تطوير الحلول الإبداعية

### الفصل الخامس: التخطيط الاستراتيجي
- أساسيات التخطيط الاستراتيجي
- تحديد الأهداف
- تطوير الاستراتيجيات
- قياس النتائج

### الفصل السادس: إدارة التغيير
- قيادة التغيير
- إدارة مقاومة التغيير
- تعزيز ثقافة الابتكار
- التكيف مع التحديات

### الفصل السابع: التطوير المهني
- خطة التطوير المهني
- القيادة المستدامة
- التوازن بين العمل والحياة
- الاستمرار في التعلم

## النماذج والقالب الجاهزة
- نموذج تقييم الأداء
- قالب خطة التطوير
- استبيان رضا الموظفين
- نموذج تقييم القيادة

## المراجع الإضافية
- كتب موصى بها
- مقالات مهمة
- مواقع إلكترونية مفيدة
- دورات تدريبية إضافية
                    ', '[\"\\u062f\\u0644\\u064a\\u0644-\\u0627\\u0644\\u0642\\u064a\\u0627\\u062f\\u0629-\\u0627\\u0644\\u0641\\u0639\\u0627\\u0644\\u0629-\\u0627\\u0644\\u0634\\u0627\\u0645\\u0644.pdf\",\"\\u0646\\u0645\\u0627\\u0630\\u062c-\\u0648-\\u0642\\u0648\\u0627\\u0644\\u0628-\\u062c\\u0627\\u0647\\u0632\\u0629.zip\",\"\\u0645\\u0631\\u0627\\u062c\\u0639-\\u0625\\u0636\\u0627\\u0641\\u064a\\u0629.pdf\",\"\\u062e\\u0637\\u0629-\\u062a\\u0637\\u0648\\u064a\\u0631-\\u0634\\u062e\\u0635\\u064a\\u0629.docx\"]', NULL, NULL, NULL, NULL, '0', '1', '13', '30', '0', '0', '2025-08-25 17:49:59', '2025-08-25 17:55:33');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('14', '2', 'ورشة عمل تطبيقية - إدارة الفرق', NULL, 'orsh-aaml-ttbyky-adar-alfrk', 'ورشة عمل تفاعلية لتطبيق ما تم تعلمه في إدارة الفرق، مع حالات عملية وتمارين جماعية.', NULL, 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, '
## محتوى الدرس

هذا الدرس يتضمن:
- شرح مفصل للمفاهيم
- أمثلة عملية
- تمارين تطبيقية
- موارد إضافية للقراءة

### النقاط الرئيسية
1. فهم المفاهيم الأساسية
2. تطبيق المعرفة عملياً
3. تطوير المهارات المطلوبة
4. تقييم التعلم

### التطبيق العملي
- تمارين فردية
- أنشطة جماعية
- حالات عملية
- تقييم ذاتي

### الموارد الإضافية
- قراءات موصى بها
- فيديوهات تعليمية
- مقالات مهمة
- روابط مفيدة
                    ', '[\"\\u0645\\u0644\\u062e\\u0635-\\u0627\\u0644\\u062f\\u0631\\u0633.pdf\",\"\\u062a\\u0645\\u0627\\u0631\\u064a\\u0646-\\u062a\\u0637\\u0628\\u064a\\u0642\\u064a\\u0629.docx\",\"\\u0645\\u0648\\u0627\\u0631\\u062f-\\u0625\\u0636\\u0627\\u0641\\u064a\\u0629.pdf\"]', NULL, NULL, NULL, NULL, '0', '1', '14', '90', '0', '0', '2025-08-25 17:49:59', '2025-08-25 17:55:33');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('15', '2', 'الاختبار النهائي والتقييم', NULL, 'alakhtbar-alnhayy-oaltkyym', 'اختبار شامل لتقييم مدى استيعاب المحتوى، مع مراجعة شاملة للمفاهيم الرئيسية.', NULL, 'text', NULL, NULL, NULL, '
# الاختبار النهائي والتقييم الشامل

## تعليمات الاختبار
- مدة الاختبار: 60 دقيقة
- عدد الأسئلة: 8 أسئلة
- درجة النجاح: 80%
- يمكن إعادة الاختبار مرة واحدة

## محتوى الاختبار
1. **أسئلة متعددة الخيارات**: تقييم الفهم النظري
2. **حالات عملية**: تطبيق المفاهيم على مواقف واقعية
3. **تقييم ذاتي**: تقييم المهارات المكتسبة
4. **خطة تطوير**: وضع خطة للتطوير المستقبلي

## معايير التقييم
- **90-100%**: ممتاز - إتقان كامل للمفاهيم
- **80-89%**: جيد جداً - فهم عميق للمحتوى
- **70-79%**: جيد - فهم أساسي للمفاهيم
- **أقل من 70%**: يحتاج مراجعة إضافية

## بعد الاختبار
- تحليل النتائج
- تحديد نقاط القوة والضعف
- وضع خطة تطوير شخصية
- الحصول على شهادة إتمام الدورة

## الشهادة
سيتم إصدار شهادة معتمدة من أكاديمية السهم الأخضر للتدريب عند اجتياز الاختبار بنجاح.

## التطوير المستمر
- المشاركة في ورش العمل التطبيقية
- الانضمام لمجتمع المتعلمين
- متابعة الدورات المتقدمة
- التطبيق العملي في بيئة العمل
                    ', '[\"\\u062f\\u0644\\u064a\\u0644-\\u0627\\u0644\\u0627\\u062e\\u062a\\u0628\\u0627\\u0631-\\u0627\\u0644\\u0646\\u0647\\u0627\\u0626\\u064a.pdf\",\"\\u0646\\u0645\\u0648\\u0630\\u062c-\\u0627\\u0644\\u062a\\u0642\\u064a\\u064a\\u0645-\\u0627\\u0644\\u0630\\u0627\\u062a\\u064a.docx\",\"\\u062e\\u0637\\u0629-\\u0627\\u0644\\u062a\\u0637\\u0648\\u064a\\u0631-\\u0627\\u0644\\u0645\\u0647\\u0646\\u064a.docx\",\"\\u0634\\u0647\\u0627\\u062f\\u0629-\\u0625\\u062a\\u0645\\u0627\\u0645-\\u0627\\u0644\\u062f\\u0648\\u0631\\u0629.pdf\"]', NULL, NULL, NULL, NULL, '0', '1', '15', '45', '0', '0', '2025-08-25 17:49:59', '2025-08-25 17:55:33');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('16', '9', 'مقدمة في البرمجة', 'Introduction to Programming', 'intro-programming-lesson-1', 'محتوى الدرس الأول', 'Lesson 1 content', 'video', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '1', '30', '0', '0', '2025-08-26 16:06:30', '2025-08-26 16:06:30');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('17', '9', 'المتغيرات والبيانات', 'Variables and Data Types', 'intro-programming-lesson-2', 'محتوى الدرس الثاني', 'Lesson 2 content', 'video', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '2', '45', '0', '0', '2025-08-26 16:06:30', '2025-08-26 16:06:30');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('18', '9', 'محاضرة مباشرة - حل المشاكل', 'Live Session - Problem Solving', 'intro-programming-live-session', 'محاضرة مباشرة', 'Live session', 'live_session', NULL, NULL, NULL, NULL, NULL, '2025-08-27 14:00:00', NULL, NULL, NULL, '0', '1', '3', '60', '0', '0', '2025-08-26 16:06:30', '2025-08-26 16:06:30');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('19', '1', 'درس اختبار 1', 'Test Lesson 1', 'test-lesson-1', 'وصف درس اختبار 1', 'Description for test lesson 1', 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '1', '30', '0', '0', '2025-08-26 17:49:05', '2025-08-26 17:49:05');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('20', '1', 'درس اختبار 2', 'Test Lesson 2', 'test-lesson-2', 'وصف درس اختبار 2', 'Description for test lesson 2', 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '2', '30', '0', '0', '2025-08-26 17:49:05', '2025-08-26 17:49:05');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('21', '1', 'درس اختبار 3', 'Test Lesson 3', 'test-lesson-3', 'وصف درس اختبار 3', 'Description for test lesson 3', 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '3', '30', '0', '0', '2025-08-26 17:49:05', '2025-08-26 17:49:05');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('22', '1', 'درس اختبار 4', 'Test Lesson 4', 'test-lesson-4', 'وصف درس اختبار 4', 'Description for test lesson 4', 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '4', '30', '0', '0', '2025-08-26 17:49:05', '2025-08-26 17:49:05');
INSERT INTO `lessons` (`id`, `course_id`, `title_ar`, `title_en`, `slug`, `description_ar`, `description_en`, `type`, `video_url`, `video_duration`, `pdf_file`, `text_content`, `attachments`, `live_session_date`, `google_meet_link`, `meeting_id`, `meeting_password`, `is_free`, `is_published`, `sort_order`, `duration_minutes`, `views_count`, `completed_count`, `created_at`, `updated_at`) VALUES ('23', '1', 'درس اختبار 5', 'Test Lesson 5', 'test-lesson-5', 'وصف درس اختبار 5', 'Description for test lesson 5', 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '5', '30', '0', '0', '2025-08-26 17:49:05', '2025-08-26 17:49:05');

CREATE TABLE `enrollments` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `user_id` int(11) not null, `course_id` int(11) not null, `payment_id` int(11), `status` varchar(255) ) not null default 'pending', `enrolled_at` timestamp not null, `expires_at` timestamp, `completed_at` timestamp, `progress_percentage` int(11) not null default '0', `lessons_completed` int(11) not null default '0', `total_lessons` int(11) not null default '0', `quiz_attempts` int(11) not null default '0', `quiz_average` numeric, `live_sessions_attended` int(11) not null default '0', `total_live_sessions` int(11) not null default '0', `rating` int(11), `review` longtext, `reviewed_at` timestamp, `certificate_issued` boolean not null default '0', `certificate_issued_at` timestamp, `certificate_number` varchar(255), `last_accessed_at` timestamp, `last_lesson_id` int(11), `created_at` timestamp, `updated_at` timestamp, `total_hours_watched` numeric not null default '0', `activated_at` timestamp, foreign key(`user_id`) references `users`(`id`) on delete cascade, foreign key(`course_id`) references `courses`(`id`) on delete cascade, foreign key(`payment_id`) references `payments`(`id`) on delete set null, foreign key(`last_lesson_id`) references `lessons`(`id`) on delete set null);

INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `payment_id`, `status`, `enrolled_at`, `expires_at`, `completed_at`, `progress_percentage`, `lessons_completed`, `total_lessons`, `quiz_attempts`, `quiz_average`, `live_sessions_attended`, `total_live_sessions`, `rating`, `review`, `reviewed_at`, `certificate_issued`, `certificate_issued_at`, `certificate_number`, `last_accessed_at`, `last_lesson_id`, `created_at`, `updated_at`, `total_hours_watched`, `activated_at`) VALUES ('1', '12', '2', '1', 'completed', '2025-08-25 16:20:11', NULL, '2025-08-26 17:52:20', '100', '15', '15', '0', NULL, '0', '0', NULL, NULL, NULL, '1', '2025-08-26 17:52:20', 'GA-2025-000001', '2025-08-26 18:28:51', '4', '2025-08-25 16:20:11', '2025-08-26 18:28:51', '0', NULL);
INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `payment_id`, `status`, `enrolled_at`, `expires_at`, `completed_at`, `progress_percentage`, `lessons_completed`, `total_lessons`, `quiz_attempts`, `quiz_average`, `live_sessions_attended`, `total_live_sessions`, `rating`, `review`, `reviewed_at`, `certificate_issued`, `certificate_issued_at`, `certificate_number`, `last_accessed_at`, `last_lesson_id`, `created_at`, `updated_at`, `total_hours_watched`, `activated_at`) VALUES ('2', '33', '9', NULL, 'pending', '2025-08-16 16:06:54', NULL, NULL, '65', '2', '3', '0', NULL, '0', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2025-08-26 16:06:54', '2025-08-26 17:33:46', '1.25', NULL);
INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `payment_id`, `status`, `enrolled_at`, `expires_at`, `completed_at`, `progress_percentage`, `lessons_completed`, `total_lessons`, `quiz_attempts`, `quiz_average`, `live_sessions_attended`, `total_live_sessions`, `rating`, `review`, `reviewed_at`, `certificate_issued`, `certificate_issued_at`, `certificate_number`, `last_accessed_at`, `last_lesson_id`, `created_at`, `updated_at`, `total_hours_watched`, `activated_at`) VALUES ('3', '33', '10', NULL, 'active', '2025-08-21 16:06:54', NULL, NULL, '30', '1', '5', '0', NULL, '0', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2025-08-26 16:06:54', '2025-08-26 16:06:54', '0.5', NULL);
INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `payment_id`, `status`, `enrolled_at`, `expires_at`, `completed_at`, `progress_percentage`, `lessons_completed`, `total_lessons`, `quiz_attempts`, `quiz_average`, `live_sessions_attended`, `total_live_sessions`, `rating`, `review`, `reviewed_at`, `certificate_issued`, `certificate_issued_at`, `certificate_number`, `last_accessed_at`, `last_lesson_id`, `created_at`, `updated_at`, `total_hours_watched`, `activated_at`) VALUES ('4', '12', '10', '2', 'active', '2025-08-26 16:07:01', NULL, NULL, '0', '0', '0', '0', NULL, '0', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2025-08-26 16:07:01', '2025-08-26 17:32:44', '0', NULL);
INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `payment_id`, `status`, `enrolled_at`, `expires_at`, `completed_at`, `progress_percentage`, `lessons_completed`, `total_lessons`, `quiz_attempts`, `quiz_average`, `live_sessions_attended`, `total_live_sessions`, `rating`, `review`, `reviewed_at`, `certificate_issued`, `certificate_issued_at`, `certificate_number`, `last_accessed_at`, `last_lesson_id`, `created_at`, `updated_at`, `total_hours_watched`, `activated_at`) VALUES ('5', '12', '4', NULL, 'active', '2025-08-26 16:46:13', NULL, NULL, '0', '0', '0', '0', NULL, '0', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2025-08-26 16:46:13', '2025-08-26 17:32:44', '0', NULL);
INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `payment_id`, `status`, `enrolled_at`, `expires_at`, `completed_at`, `progress_percentage`, `lessons_completed`, `total_lessons`, `quiz_attempts`, `quiz_average`, `live_sessions_attended`, `total_live_sessions`, `rating`, `review`, `reviewed_at`, `certificate_issued`, `certificate_issued_at`, `certificate_number`, `last_accessed_at`, `last_lesson_id`, `created_at`, `updated_at`, `total_hours_watched`, `activated_at`) VALUES ('6', '37', '1', NULL, 'completed', '2025-08-26 17:49:05', NULL, '2025-08-26 17:49:05', '100', '5', '5', '0', NULL, '0', '0', NULL, NULL, NULL, '1', '2025-08-26 17:49:06', 'GA-2025-000006', NULL, NULL, '2025-08-26 17:49:05', '2025-08-26 17:49:06', '0', '2025-08-26 17:49:05');

CREATE TABLE `payments` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `user_id` int(11) not null, `course_id` int(11) not null, `payment_id` varchar(255) not null, `invoice_number` varchar(255) not null, `amount` numeric not null, `discount_amount` numeric not null default '0', `tax_amount` numeric not null default '0', `total_amount` numeric not null, `currency` varchar(255) not null default 'SAR', `payment_method` varchar(255) ) not null default 'online', `payment_gateway` varchar(255) ), `status` varchar(255) ) not null default 'pending', `paid_at` timestamp, `expires_at` timestamp, `gateway_transaction_id` varchar(255), `gateway_reference` varchar(255), `gateway_response` longtext, `billing_data` longtext, `invoice_pdf` varchar(255), `refunded_amount` numeric not null default '0', `refunded_at` timestamp, `refund_reason` varchar(255), `notes` longtext, `failure_reason` longtext, `created_at` timestamp, `updated_at` timestamp, `payment_data` longtext, foreign key(`user_id`) references `users`(`id`) on delete cascade, foreign key(`course_id`) references `courses`(`id`) on delete cascade);

INSERT INTO `payments` (`id`, `user_id`, `course_id`, `payment_id`, `invoice_number`, `amount`, `discount_amount`, `tax_amount`, `total_amount`, `currency`, `payment_method`, `payment_gateway`, `status`, `paid_at`, `expires_at`, `gateway_transaction_id`, `gateway_reference`, `gateway_response`, `billing_data`, `invoice_pdf`, `refunded_amount`, `refunded_at`, `refund_reason`, `notes`, `failure_reason`, `created_at`, `updated_at`, `payment_data`) VALUES ('1', '12', '2', 'GA-20250825-DE7C466E', 'INV-2025-000001', '1200', '0', '180', '1380', 'SAR', 'online', NULL, 'pending', NULL, '2025-09-01 16:20:11', NULL, NULL, NULL, '{\"name\":\"\\u0627\\u0644\\u0637\\u0627\\u0644\\u0628 \\u0631\\u0642\\u0645 2\",\"email\":\"student2@example.com\",\"phone\":\"+201204593124\",\"address\":null}', NULL, '0', NULL, NULL, NULL, NULL, '2025-08-25 16:20:11', '2025-08-25 16:20:11', NULL);
INSERT INTO `payments` (`id`, `user_id`, `course_id`, `payment_id`, `invoice_number`, `amount`, `discount_amount`, `tax_amount`, `total_amount`, `currency`, `payment_method`, `payment_gateway`, `status`, `paid_at`, `expires_at`, `gateway_transaction_id`, `gateway_reference`, `gateway_response`, `billing_data`, `invoice_pdf`, `refunded_amount`, `refunded_at`, `refund_reason`, `notes`, `failure_reason`, `created_at`, `updated_at`, `payment_data`) VALUES ('2', '12', '10', 'GA-20250826-1D073CA4', 'INV-2025-000002', '199', '0', '29.85', '228.85', 'SAR', 'cash', NULL, 'pending', NULL, '2025-09-02 16:07:01', NULL, NULL, NULL, '{\"name\":\"\\u0627\\u062d\\u0645\\u062f \\u0645\\u062d\\u0645\\u062f\",\"email\":\"student2@example.com\",\"phone\":\"+201204593124\",\"address\":\"\"}', NULL, '0', NULL, NULL, NULL, NULL, '2025-08-26 16:07:01', '2025-08-26 16:07:01', NULL);
INSERT INTO `payments` (`id`, `user_id`, `course_id`, `payment_id`, `invoice_number`, `amount`, `discount_amount`, `tax_amount`, `total_amount`, `currency`, `payment_method`, `payment_gateway`, `status`, `paid_at`, `expires_at`, `gateway_transaction_id`, `gateway_reference`, `gateway_response`, `billing_data`, `invoice_pdf`, `refunded_amount`, `refunded_at`, `refund_reason`, `notes`, `failure_reason`, `created_at`, `updated_at`, `payment_data`) VALUES ('3', '12', '10', 'GA-20250826-A213E48C', 'INV-2025-000003', '199', '0', '29.85', '228.85', 'SAR', 'cash', NULL, 'pending', NULL, '2025-09-02 16:10:22', NULL, NULL, NULL, '{\"name\":\"\\u0627\\u062d\\u0645\\u062f \\u0645\\u062d\\u0645\\u062f\",\"email\":\"student2@example.com\",\"phone\":\"+201204593124\",\"address\":\"\"}', NULL, '0', NULL, NULL, NULL, NULL, '2025-08-26 16:10:22', '2025-08-26 16:10:22', NULL);
INSERT INTO `payments` (`id`, `user_id`, `course_id`, `payment_id`, `invoice_number`, `amount`, `discount_amount`, `tax_amount`, `total_amount`, `currency`, `payment_method`, `payment_gateway`, `status`, `paid_at`, `expires_at`, `gateway_transaction_id`, `gateway_reference`, `gateway_response`, `billing_data`, `invoice_pdf`, `refunded_amount`, `refunded_at`, `refund_reason`, `notes`, `failure_reason`, `created_at`, `updated_at`, `payment_data`) VALUES ('4', '12', '10', 'GA-20250826-2EE9CB68', 'INV-2025-000004', '199', '0', '29.85', '228.85', 'SAR', 'cash', NULL, 'pending', NULL, '2025-09-02 16:10:50', NULL, NULL, NULL, '{\"name\":\"\\u0627\\u062d\\u0645\\u062f \\u0645\\u062d\\u0645\\u062f\",\"email\":\"student2@example.com\",\"phone\":\"+201204593124\",\"address\":\"\"}', NULL, '0', NULL, NULL, NULL, NULL, '2025-08-26 16:10:50', '2025-08-26 16:10:50', NULL);
INSERT INTO `payments` (`id`, `user_id`, `course_id`, `payment_id`, `invoice_number`, `amount`, `discount_amount`, `tax_amount`, `total_amount`, `currency`, `payment_method`, `payment_gateway`, `status`, `paid_at`, `expires_at`, `gateway_transaction_id`, `gateway_reference`, `gateway_response`, `billing_data`, `invoice_pdf`, `refunded_amount`, `refunded_at`, `refund_reason`, `notes`, `failure_reason`, `created_at`, `updated_at`, `payment_data`) VALUES ('5', '12', '10', 'GA-20250826-FEE18C6C', 'INV-2025-000005', '199', '0', '29.85', '228.85', 'SAR', 'cash', NULL, 'pending', NULL, '2025-09-02 16:11:16', NULL, NULL, NULL, '{\"name\":\"\\u0627\\u062d\\u0645\\u062f \\u0645\\u062d\\u0645\\u062f\",\"email\":\"student2@example.com\",\"phone\":\"+201204593124\",\"address\":\"\"}', NULL, '0', NULL, NULL, NULL, NULL, '2025-08-26 16:11:16', '2025-08-26 16:11:16', NULL);
INSERT INTO `payments` (`id`, `user_id`, `course_id`, `payment_id`, `invoice_number`, `amount`, `discount_amount`, `tax_amount`, `total_amount`, `currency`, `payment_method`, `payment_gateway`, `status`, `paid_at`, `expires_at`, `gateway_transaction_id`, `gateway_reference`, `gateway_response`, `billing_data`, `invoice_pdf`, `refunded_amount`, `refunded_at`, `refund_reason`, `notes`, `failure_reason`, `created_at`, `updated_at`, `payment_data`) VALUES ('6', '12', '10', 'GA-20250826-12ED9D8E', 'INV-2025-000006', '199', '0', '29.85', '228.85', 'SAR', 'cash', NULL, 'pending', NULL, '2025-09-02 16:12:31', NULL, NULL, NULL, '{\"name\":\"\\u0627\\u062d\\u0645\\u062f \\u0645\\u062d\\u0645\\u062f\",\"email\":\"student2@example.com\",\"phone\":\"+201204593124\",\"address\":\"\"}', NULL, '0', NULL, NULL, NULL, NULL, '2025-08-26 16:12:31', '2025-08-26 16:12:31', NULL);
INSERT INTO `payments` (`id`, `user_id`, `course_id`, `payment_id`, `invoice_number`, `amount`, `discount_amount`, `tax_amount`, `total_amount`, `currency`, `payment_method`, `payment_gateway`, `status`, `paid_at`, `expires_at`, `gateway_transaction_id`, `gateway_reference`, `gateway_response`, `billing_data`, `invoice_pdf`, `refunded_amount`, `refunded_at`, `refund_reason`, `notes`, `failure_reason`, `created_at`, `updated_at`, `payment_data`) VALUES ('7', '12', '10', 'GA-20250826-B4AE5F24', 'INV-2025-000007', '199', '0', '29.85', '228.85', 'SAR', 'cash', NULL, 'pending', NULL, '2025-09-02 16:12:42', NULL, NULL, NULL, '{\"name\":\"\\u0627\\u062d\\u0645\\u062f \\u0645\\u062d\\u0645\\u062f\",\"email\":\"student2@example.com\",\"phone\":\"+201204593124\",\"address\":\"\"}', NULL, '0', NULL, NULL, NULL, NULL, '2025-08-26 16:12:42', '2025-08-26 16:12:42', NULL);
INSERT INTO `payments` (`id`, `user_id`, `course_id`, `payment_id`, `invoice_number`, `amount`, `discount_amount`, `tax_amount`, `total_amount`, `currency`, `payment_method`, `payment_gateway`, `status`, `paid_at`, `expires_at`, `gateway_transaction_id`, `gateway_reference`, `gateway_response`, `billing_data`, `invoice_pdf`, `refunded_amount`, `refunded_at`, `refund_reason`, `notes`, `failure_reason`, `created_at`, `updated_at`, `payment_data`) VALUES ('8', '12', '10', 'GA-20250826-8C2C2F85', 'INV-2025-000008', '199', '0', '29.85', '228.85', 'SAR', 'cash', NULL, 'completed', NULL, '2025-09-02 16:13:13', NULL, NULL, NULL, '{\"name\":\"\\u0627\\u062d\\u0645\\u062f \\u0645\\u062d\\u0645\\u062f\",\"email\":\"student2@example.com\",\"phone\":\"+201204593124\",\"address\":\"\"}', NULL, '0', NULL, NULL, NULL, NULL, '2025-08-26 16:13:13', '2025-08-26 18:36:40', NULL);

CREATE TABLE `quizzes` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `course_id` int(11) not null, `lesson_id` int(11), `title_ar` varchar(255) not null, `title_en` varchar(255), `description_ar` longtext, `description_en` longtext, `duration_minutes` int(11) not null default '30', `passing_score` int(11) not null default '70', `is_active` boolean not null default '1', `allow_retake` boolean not null default '1', `max_attempts` int(11) not null default '3', `show_results` boolean not null default '1', `randomize_questions` boolean not null default '0', `due_date` timestamp, `total_questions` int(11) not null default '0', `total_points` int(11) not null default '0', `created_at` timestamp, `updated_at` timestamp, foreign key(`course_id`) references `courses`(`id`) on delete cascade, foreign key(`lesson_id`) references `lessons`(`id`) on delete cascade);

INSERT INTO `quizzes` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `duration_minutes`, `passing_score`, `is_active`, `allow_retake`, `max_attempts`, `show_results`, `randomize_questions`, `due_date`, `total_questions`, `total_points`, `created_at`, `updated_at`) VALUES ('1', '2', '1', 'كويز: مقدمة في القيادة والإدارة', NULL, 'اختبار قصير لتقييم فهمك لمفاهيم القيادة والإدارة الأساسية', NULL, '15', '70', '1', '1', '3', '1', '0', NULL, '0', '0', '2025-08-25 17:53:32', '2025-08-25 17:53:32');
INSERT INTO `quizzes` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `duration_minutes`, `passing_score`, `is_active`, `allow_retake`, `max_attempts`, `show_results`, `randomize_questions`, `due_date`, `total_questions`, `total_points`, `created_at`, `updated_at`) VALUES ('2', '2', '1', 'كويز: مقدمة في القيادة والإدارة', NULL, 'اختبار قصير لتقييم فهمك لمفاهيم القيادة والإدارة الأساسية', NULL, '15', '70', '1', '1', '3', '1', '0', NULL, '0', '0', '2025-08-25 17:54:23', '2025-08-25 17:54:23');
INSERT INTO `quizzes` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `duration_minutes`, `passing_score`, `is_active`, `allow_retake`, `max_attempts`, `show_results`, `randomize_questions`, `due_date`, `total_questions`, `total_points`, `created_at`, `updated_at`) VALUES ('3', '2', '2', 'كويز: أنماط القيادة المختلفة', NULL, 'اختبار لتقييم فهمك لأنماط القيادة المختلفة ومتى تستخدم كل نمط', NULL, '20', '75', '1', '1', '3', '1', '0', NULL, '0', '0', '2025-08-25 17:54:23', '2025-08-25 17:54:23');
INSERT INTO `quizzes` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `duration_minutes`, `passing_score`, `is_active`, `allow_retake`, `max_attempts`, `show_results`, `randomize_questions`, `due_date`, `total_questions`, `total_points`, `created_at`, `updated_at`) VALUES ('4', '2', '15', 'الاختبار النهائي الشامل', NULL, 'اختبار شامل لتقييم جميع المفاهيم والمهارات التي تم تعلمها في الدورة', NULL, '60', '80', '1', '1', '3', '1', '0', NULL, '0', '0', '2025-08-25 17:54:23', '2025-08-25 17:54:23');
INSERT INTO `quizzes` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `duration_minutes`, `passing_score`, `is_active`, `allow_retake`, `max_attempts`, `show_results`, `randomize_questions`, `due_date`, `total_questions`, `total_points`, `created_at`, `updated_at`) VALUES ('5', '9', NULL, 'اختبار أساسيات البرمجة', 'Programming Basics Quiz', 'اختبار شامل لأساسيات البرمجة', 'Comprehensive quiz for programming basics', '30', '70', '1', '1', '3', '1', '0', NULL, '0', '0', '2025-08-26 16:06:54', '2025-08-26 16:06:54');

CREATE TABLE `certificates` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `user_id` int(11) not null, `course_id` int(11) not null, `enrollment_id` int(11) not null, `certificate_number` varchar(255) not null, `issued_at` timestamp, `pdf_path` varchar(255), `verification_code` varchar(255) not null, `is_verified` boolean not null default '0', `notes` longtext, `created_at` timestamp, `updated_at` timestamp, foreign key(`user_id`) references `users`(`id`) on delete cascade, foreign key(`course_id`) references `courses`(`id`) on delete cascade, foreign key(`enrollment_id`) references `enrollments`(`id`) on delete cascade);

INSERT INTO `certificates` (`id`, `user_id`, `course_id`, `enrollment_id`, `certificate_number`, `issued_at`, `pdf_path`, `verification_code`, `is_verified`, `notes`, `created_at`, `updated_at`) VALUES ('1', '33', '9', '2', 'CERT-68ADDBDCD8E6D', '2025-08-24 16:07:56', NULL, 'C7B0E5DB', '1', NULL, '2025-08-26 16:07:56', '2025-08-26 16:07:56');
INSERT INTO `certificates` (`id`, `user_id`, `course_id`, `enrollment_id`, `certificate_number`, `issued_at`, `pdf_path`, `verification_code`, `is_verified`, `notes`, `created_at`, `updated_at`) VALUES ('2', '37', '1', '6', 'GA-2025-000006', '2025-08-26 17:49:06', NULL, '85DE518D', '0', NULL, '2025-08-26 17:49:06', '2025-08-26 17:49:06');
INSERT INTO `certificates` (`id`, `user_id`, `course_id`, `enrollment_id`, `certificate_number`, `issued_at`, `pdf_path`, `verification_code`, `is_verified`, `notes`, `created_at`, `updated_at`) VALUES ('3', '12', '2', '1', 'GA-2025-000001', '2025-08-26 17:52:20', NULL, '4430AE02', '0', NULL, '2025-08-26 17:52:20', '2025-08-26 17:52:20');

CREATE TABLE `notifications` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `title` varchar(255) not null, `message` longtext not null, `type` varchar(255) ) not null default 'info', `user_id` int(11), `read_at` timestamp, `data` longtext, `created_at` timestamp, `updated_at` timestamp, foreign key(`user_id`) references `users`(`id`) on delete cascade);

INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `user_id`, `read_at`, `data`, `created_at`, `updated_at`) VALUES ('1', 'مرحباً بك في لوحة الإدارة', 'تم تسجيل دخولك بنجاح إلى لوحة إدارة أكاديمية السهم الأخضر', 'success', '1', NULL, NULL, '2025-08-25 09:06:07', '2025-08-25 09:06:07');
INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `user_id`, `read_at`, `data`, `created_at`, `updated_at`) VALUES ('2', 'دورة جديدة مضافة', 'تم إضافة دورة \"تعلم البرمجة من الصفر\" بنجاح', 'info', '1', NULL, NULL, '2025-08-25 08:36:07', '2025-08-25 08:36:07');
INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `user_id`, `read_at`, `data`, `created_at`, `updated_at`) VALUES ('3', 'تسجيل طالب جديد', 'انضم أحمد محمد إلى أكاديمية السهم الأخضر', 'info', '1', NULL, NULL, '2025-08-25 07:06:07', '2025-08-25 07:06:07');
INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `user_id`, `read_at`, `data`, `created_at`, `updated_at`) VALUES ('4', 'دفعة جديدة', 'تم استلام دفعة بقيمة 500 ريال من الطالب محمد أحمد', 'success', '1', NULL, NULL, '2025-08-25 04:06:07', '2025-08-25 04:06:07');
INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `user_id`, `read_at`, `data`, `created_at`, `updated_at`) VALUES ('5', 'رسالة تواصل جديدة', 'رسالة جديدة من سارة أحمد بخصوص دورة البرمجة', 'warning', '1', NULL, NULL, '2025-08-24 09:06:07', '2025-08-24 09:06:07');
INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `user_id`, `read_at`, `data`, `created_at`, `updated_at`) VALUES ('6', 'تحديث النظام', 'تم تحديث النظام إلى الإصدار الجديد بنجاح', 'info', '1', NULL, NULL, '2025-08-23 09:06:07', '2025-08-23 09:06:07');
INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `user_id`, `read_at`, `data`, `created_at`, `updated_at`) VALUES ('7', 'مرحباً بك في لوحة الإدارة', 'تم تسجيل دخولك بنجاح إلى لوحة إدارة أكاديمية السهم الأخضر', 'success', '1', '2025-08-25 09:53:00', NULL, '2025-08-25 09:49:17', '2025-08-25 09:53:00');
INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `user_id`, `read_at`, `data`, `created_at`, `updated_at`) VALUES ('8', 'دورة جديدة مضافة', 'تم إضافة دورة \"تعلم البرمجة من الصفر\" بنجاح', 'info', '1', NULL, NULL, '2025-08-25 09:49:17', '2025-08-25 09:49:17');
INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `user_id`, `read_at`, `data`, `created_at`, `updated_at`) VALUES ('9', 'تسجيل طالب جديد', 'انضم أحمد محمد إلى أكاديمية السهم الأخضر', 'info', '1', NULL, NULL, '2025-08-25 09:49:17', '2025-08-25 09:49:17');
INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `user_id`, `read_at`, `data`, `created_at`, `updated_at`) VALUES ('10', 'دفعة جديدة', 'تم استلام دفعة بقيمة 500 ريال من الطالب محمد أحمد', 'success', '1', NULL, NULL, '2025-08-25 09:49:17', '2025-08-25 09:49:17');
INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `user_id`, `read_at`, `data`, `created_at`, `updated_at`) VALUES ('11', 'رسالة تواصل جديدة', 'رسالة جديدة من سارة أحمد بخصوص دورة البرمجة', 'warning', '1', NULL, NULL, '2025-08-25 09:49:17', '2025-08-25 09:49:17');
INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `user_id`, `read_at`, `data`, `created_at`, `updated_at`) VALUES ('12', 'مرحباً بك في لوحة الإدارة', 'تم تسجيل دخولك بنجاح إلى لوحة إدارة أكاديمية السهم الأخضر', 'success', '1', NULL, NULL, '2025-08-25 12:57:49', '2025-08-25 12:57:49');
INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `user_id`, `read_at`, `data`, `created_at`, `updated_at`) VALUES ('13', 'دورة جديدة مضافة', 'تم إضافة دورة \"تعلم البرمجة من الصفر\" بنجاح', 'info', '1', NULL, NULL, '2025-08-25 12:27:49', '2025-08-25 12:27:49');
INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `user_id`, `read_at`, `data`, `created_at`, `updated_at`) VALUES ('14', 'تسجيل طالب جديد', 'انضم أحمد محمد إلى أكاديمية السهم الأخضر', 'info', '1', NULL, NULL, '2025-08-25 10:57:49', '2025-08-25 10:57:49');
INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `user_id`, `read_at`, `data`, `created_at`, `updated_at`) VALUES ('15', 'دفعة جديدة', 'تم استلام دفعة بقيمة 500 ريال من الطالب محمد أحمد', 'success', '1', NULL, NULL, '2025-08-25 07:57:49', '2025-08-25 07:57:49');
INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `user_id`, `read_at`, `data`, `created_at`, `updated_at`) VALUES ('16', 'رسالة تواصل جديدة', 'رسالة جديدة من سارة أحمد بخصوص دورة البرمجة', 'warning', '1', NULL, NULL, '2025-08-24 12:57:49', '2025-08-24 12:57:49');
INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `user_id`, `read_at`, `data`, `created_at`, `updated_at`) VALUES ('17', 'تحديث النظام', 'تم تحديث النظام إلى الإصدار الجديد بنجاح', 'info', '1', NULL, NULL, '2025-08-23 12:57:49', '2025-08-23 12:57:49');

CREATE TABLE `blog_posts` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `author_id` int(11) not null, `title_ar` varchar(255) not null, `title_en` varchar(255), `slug` varchar(255) not null, `excerpt_ar` longtext, `excerpt_en` longtext, `content_ar` longtext not null, `content_en` longtext, `featured_image` varchar(255), `gallery` longtext, `category` varchar(255) not null default 'general', `tags` longtext, `status` varchar(255) ) not null default 'draft', `is_featured` boolean not null default '0', `comments_enabled` boolean not null default '1', `published_at` timestamp, `meta_title_ar` varchar(255), `meta_title_en` varchar(255), `meta_description_ar` longtext, `meta_description_en` longtext, `meta_keywords_ar` longtext, `meta_keywords_en` longtext, `views_count` int(11) not null default '0', `likes_count` int(11) not null default '0', `shares_count` int(11) not null default '0', `reading_time` numeric not null default '0', `created_at` timestamp, `updated_at` timestamp, foreign key(`author_id`) references `users`(`id`) on delete cascade);

INSERT INTO `blog_posts` (`id`, `author_id`, `title_ar`, `title_en`, `slug`, `excerpt_ar`, `excerpt_en`, `content_ar`, `content_en`, `featured_image`, `gallery`, `category`, `tags`, `status`, `is_featured`, `comments_enabled`, `published_at`, `meta_title_ar`, `meta_title_en`, `meta_description_ar`, `meta_description_en`, `meta_keywords_ar`, `meta_keywords_en`, `views_count`, `likes_count`, `shares_count`, `reading_time`, `created_at`, `updated_at`) VALUES ('1', '1', 'كيف تختار الدورة التدريبية المناسبة لمستقبلك المهني', 'كيف تختار الدورة التدريبية المناسبة لمستقبلك المهني', 'kyf-tkhtar-aldor-altdryby-almnasb-lmstkblk-almhny', 'دليل شامل لاختيار الدورات التدريبية التي تناسب أهدافك المهنية وتطور مهاراتك في السوق التنافسي', 'دليل شامل لاختيار الدورات التدريبية التي تناسب أهدافك المهنية وتطور مهاراتك في السوق التنافسي', '<h2>مقدمة</h2>
<p>في عالم يتغير بسرعة، أصبح التعليم المستمر ضرورة حتمية للنجاح المهني. لكن مع تعدد الخيارات والبرامج التدريبية، قد يكون اختيار الدورة المناسبة تحدياً كبيراً.</p>

<h2>العوامل الأساسية لاختيار الدورة التدريبية</h2>

<h3>1. تحديد الأهداف المهنية</h3>
<p>قبل اختيار أي دورة تدريبية، يجب عليك تحديد أهدافك المهنية بوضوح. اسأل نفسك:</p>
<ul>
<li>ما هو المجال الذي تريد التخصص فيه؟</li>
<li>ما هي المهارات التي تحتاج لتطويرها؟</li>
<li>ما هي الفرص الوظيفية المتاحة بعد إكمال الدورة؟</li>
</ul>

<h3>2. تقييم جودة المحتوى</h3>
<p>في أكاديمية السهم الأخضر، نحرص على تقديم محتوى عالي الجودة يتم تحديثه باستمرار لمواكبة أحدث التطورات في المجال.</p>

<h3>3. خبرة المدربين</h3>
<p>نختار مدربينا بعناية فائقة، حيث يمتلكون خبرة عملية واسعة وشهادات معتمدة في مجالات تخصصهم.</p>

<h2>مزايا الدورات في أكاديمية السهم الأخضر</h2>

<h3>الجودة العالية</h3>
<p>نلتزم بأعلى معايير الجودة في جميع دوراتنا، من المحتوى التعليمي إلى طرق التدريس والتقييم.</p>

<h3>المرونة في التعلم</h3>
<p>نقدم خيارات تعليمية مرنة تناسب جميع أنماط الحياة، من الدورات المباشرة إلى الدورات عبر الإنترنت.</p>

<h3>الدعم المستمر</h3>
<p>نوفر دعم فني وتعليمي متواصل لطلابنا، لضمان حصولهم على أفضل تجربة تعليمية ممكنة.</p>

<h2>نصائح للنجاح في الدورات التدريبية</h2>

<ol>
<li><strong>التخطيط الجيد:</strong> حدد جدولاً زمنياً واقعياً لإكمال الدورة</li>
<li><strong>الممارسة المستمرة:</strong> طبق ما تتعلمه في مشاريع عملية</li>
<li><strong>التفاعل مع المدربين:</strong> لا تتردد في طرح الأسئلة والاستفسارات</li>
<li><strong>التواصل مع الزملاء:</strong> انضم لمجتمعات التعلم وشارك خبراتك</li>
</ol>

<h2>الخاتمة</h2>
<p>اختيار الدورة التدريبية المناسبة هو استثمار في مستقبلك المهني. في أكاديمية السهم الأخضر، نساعدك في اتخاذ القرار الصحيح وتوفير أفضل تجربة تعليمية ممكنة.</p>', '<h2>مقدمة</h2>
<p>في عالم يتغير بسرعة، أصبح التعليم المستمر ضرورة حتمية للنجاح المهني. لكن مع تعدد الخيارات والبرامج التدريبية، قد يكون اختيار الدورة المناسبة تحدياً كبيراً.</p>

<h2>العوامل الأساسية لاختيار الدورة التدريبية</h2>

<h3>1. تحديد الأهداف المهنية</h3>
<p>قبل اختيار أي دورة تدريبية، يجب عليك تحديد أهدافك المهنية بوضوح. اسأل نفسك:</p>
<ul>
<li>ما هو المجال الذي تريد التخصص فيه؟</li>
<li>ما هي المهارات التي تحتاج لتطويرها؟</li>
<li>ما هي الفرص الوظيفية المتاحة بعد إكمال الدورة؟</li>
</ul>

<h3>2. تقييم جودة المحتوى</h3>
<p>في أكاديمية السهم الأخضر، نحرص على تقديم محتوى عالي الجودة يتم تحديثه باستمرار لمواكبة أحدث التطورات في المجال.</p>

<h3>3. خبرة المدربين</h3>
<p>نختار مدربينا بعناية فائقة، حيث يمتلكون خبرة عملية واسعة وشهادات معتمدة في مجالات تخصصهم.</p>

<h2>مزايا الدورات في أكاديمية السهم الأخضر</h2>

<h3>الجودة العالية</h3>
<p>نلتزم بأعلى معايير الجودة في جميع دوراتنا، من المحتوى التعليمي إلى طرق التدريس والتقييم.</p>

<h3>المرونة في التعلم</h3>
<p>نقدم خيارات تعليمية مرنة تناسب جميع أنماط الحياة، من الدورات المباشرة إلى الدورات عبر الإنترنت.</p>

<h3>الدعم المستمر</h3>
<p>نوفر دعم فني وتعليمي متواصل لطلابنا، لضمان حصولهم على أفضل تجربة تعليمية ممكنة.</p>

<h2>نصائح للنجاح في الدورات التدريبية</h2>

<ol>
<li><strong>التخطيط الجيد:</strong> حدد جدولاً زمنياً واقعياً لإكمال الدورة</li>
<li><strong>الممارسة المستمرة:</strong> طبق ما تتعلمه في مشاريع عملية</li>
<li><strong>التفاعل مع المدربين:</strong> لا تتردد في طرح الأسئلة والاستفسارات</li>
<li><strong>التواصل مع الزملاء:</strong> انضم لمجتمعات التعلم وشارك خبراتك</li>
</ol>

<h2>الخاتمة</h2>
<p>اختيار الدورة التدريبية المناسبة هو استثمار في مستقبلك المهني. في أكاديمية السهم الأخضر، نساعدك في اتخاذ القرار الصحيح وتوفير أفضل تجربة تعليمية ممكنة.</p>', 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', NULL, 'التطوير المهني', '[\"\\u062f\\u0648\\u0631\\u0627\\u062a \\u062a\\u062f\\u0631\\u064a\\u0628\\u064a\\u0629\",\"\\u0627\\u0644\\u062a\\u0637\\u0648\\u064a\\u0631 \\u0627\\u0644\\u0645\\u0647\\u0646\\u064a\",\"\\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645 \\u0627\\u0644\\u0645\\u0633\\u062a\\u0645\\u0631\",\"\\u0627\\u062e\\u062a\\u064a\\u0627\\u0631 \\u0627\\u0644\\u062f\\u0648\\u0631\\u0627\\u062a\"]', 'published', '1', '1', '2025-08-20 12:25:02', 'كيف تختار الدورة التدريبية المناسبة - أكاديمية السهم الأخضر', 'كيف تختار الدورة التدريبية المناسبة - أكاديمية السهم الأخضر', 'دليل شامل لاختيار الدورات التدريبية المناسبة لمستقبلك المهني في أكاديمية السهم الأخضر', 'دليل شامل لاختيار الدورات التدريبية المناسبة لمستقبلك المهني في أكاديمية السهم الأخضر', 'دورات تدريبية, التطوير المهني, التعليم المستمر, أكاديمية السهم الأخضر', 'دورات تدريبية, التطوير المهني, التعليم المستمر, أكاديمية السهم الأخضر', '347', '0', '0', '8.5', '2025-08-25 12:25:02', '2025-08-25 12:25:02');
INSERT INTO `blog_posts` (`id`, `author_id`, `title_ar`, `title_en`, `slug`, `excerpt_ar`, `excerpt_en`, `content_ar`, `content_en`, `featured_image`, `gallery`, `category`, `tags`, `status`, `is_featured`, `comments_enabled`, `published_at`, `meta_title_ar`, `meta_title_en`, `meta_description_ar`, `meta_description_en`, `meta_keywords_ar`, `meta_keywords_en`, `views_count`, `likes_count`, `shares_count`, `reading_time`, `created_at`, `updated_at`) VALUES ('2', '1', 'أهمية الجودة في التعليم: رؤية أكاديمية السهم الأخضر', 'أهمية الجودة في التعليم: رؤية أكاديمية السهم الأخضر', 'ahmy-algod-fy-altaalym-roy-akadymy-alshm-alakhdr', 'اكتشف كيف تحافظ أكاديمية السهم الأخضر على أعلى معايير الجودة في التعليم والتدريب', 'اكتشف كيف تحافظ أكاديمية السهم الأخضر على أعلى معايير الجودة في التعليم والتدريب', '<h2>الجودة في التعليم: ركيزة أساسية</h2>
<p>في عالم يتسم بالتنافسية العالية، أصبحت جودة التعليم العامل الحاسم في نجاح المؤسسات التعليمية وتميزها. في أكاديمية السهم الأخضر، نضع الجودة في صميم رؤيتنا ورسالتنا.</p>

<h2>معايير الجودة في أكاديمية السهم الأخضر</h2>

<h3>1. جودة المحتوى التعليمي</h3>
<p>نحرص على تطوير محتوى تعليمي عالي الجودة يتميز بـ:</p>
<ul>
<li>التحديث المستمر لمواكبة التطورات الحديثة</li>
<li>المراجعة الدورية من خبراء المجال</li>
<li>التطبيق العملي للمفاهيم النظرية</li>
<li>التنوع في طرق العرض والتوضيح</li>
</ul>

<h3>2. كفاءة المدربين</h3>
<p>نختار مدربينا بعناية فائقة بناءً على:</p>
<ul>
<li>الخبرة العملية الواسعة</li>
<li>الشهادات العلمية المعتمدة</li>
<li>القدرة على التواصل الفعال</li>
<li>التطوير المستمر للمهارات</li>
</ul>

<h3>3. البنية التحتية المتطورة</h3>
<p>نوفر بيئة تعليمية متطورة تشمل:</p>
<ul>
<li>فصول دراسية مجهزة بأحدث التقنيات</li>
<li>مختبرات عملية متخصصة</li>
<li>منصات تعليمية إلكترونية متقدمة</li>
<li>مكتبة رقمية شاملة</li>
</ul>

<h2>ضمان الجودة المستمر</h2>

<h3>التقييم الدوري</h3>
<p>نقوم بتقييم دوري شامل لجميع جوانب العملية التعليمية:</p>
<ul>
<li>تقييم رضا الطلاب</li>
<li>مراجعة أداء المدربين</li>
<li>تحديث المحتوى التعليمي</li>
<li>تحسين البنية التحتية</li>
</ul>

<h3>التطوير المستمر</h3>
<p>نؤمن بأهمية التطوير المستمر ونعمل على:</p>
<ul>
<li>تطوير برامج تدريبية جديدة</li>
<li>تحسين طرق التدريس</li>
<li>استخدام أحدث التقنيات التعليمية</li>
<li>التعاون مع مؤسسات تعليمية عالمية</li>
</ul>

<h2>نتائج الجودة العالية</h2>

<h3>معدلات النجاح المرتفعة</h3>
<p>نفخر بمعدلات النجاح المرتفعة لطلابنا، حيث يحقق أكثر من 95% منهم أهدافهم التعليمية.</p>

<h3>رضا الطلاب</h3>
<p>يحصل طلابنا على تجربة تعليمية استثنائية، مما ينعكس على رضاهم العالي عن خدماتنا.</p>

<h3>الاعتراف المهني</h3>
<p>شهاداتنا معترف بها في السوق المحلي والدولي، مما يفتح أبواب الفرص الوظيفية لخريجينا.</p>

<h2>الخاتمة</h2>
<p>الجودة ليست مجرد شعار في أكاديمية السهم الأخضر، بل هي نمط حياة نعيشه يومياً. نلتزم بتقديم أفضل تجربة تعليمية ممكنة لطلابنا، ونسعى دائماً للتميز والابتكار في مجال التعليم والتدريب.</p>', '<h2>الجودة في التعليم: ركيزة أساسية</h2>
<p>في عالم يتسم بالتنافسية العالية، أصبحت جودة التعليم العامل الحاسم في نجاح المؤسسات التعليمية وتميزها. في أكاديمية السهم الأخضر، نضع الجودة في صميم رؤيتنا ورسالتنا.</p>

<h2>معايير الجودة في أكاديمية السهم الأخضر</h2>

<h3>1. جودة المحتوى التعليمي</h3>
<p>نحرص على تطوير محتوى تعليمي عالي الجودة يتميز بـ:</p>
<ul>
<li>التحديث المستمر لمواكبة التطورات الحديثة</li>
<li>المراجعة الدورية من خبراء المجال</li>
<li>التطبيق العملي للمفاهيم النظرية</li>
<li>التنوع في طرق العرض والتوضيح</li>
</ul>

<h3>2. كفاءة المدربين</h3>
<p>نختار مدربينا بعناية فائقة بناءً على:</p>
<ul>
<li>الخبرة العملية الواسعة</li>
<li>الشهادات العلمية المعتمدة</li>
<li>القدرة على التواصل الفعال</li>
<li>التطوير المستمر للمهارات</li>
</ul>

<h3>3. البنية التحتية المتطورة</h3>
<p>نوفر بيئة تعليمية متطورة تشمل:</p>
<ul>
<li>فصول دراسية مجهزة بأحدث التقنيات</li>
<li>مختبرات عملية متخصصة</li>
<li>منصات تعليمية إلكترونية متقدمة</li>
<li>مكتبة رقمية شاملة</li>
</ul>

<h2>ضمان الجودة المستمر</h2>

<h3>التقييم الدوري</h3>
<p>نقوم بتقييم دوري شامل لجميع جوانب العملية التعليمية:</p>
<ul>
<li>تقييم رضا الطلاب</li>
<li>مراجعة أداء المدربين</li>
<li>تحديث المحتوى التعليمي</li>
<li>تحسين البنية التحتية</li>
</ul>

<h3>التطوير المستمر</h3>
<p>نؤمن بأهمية التطوير المستمر ونعمل على:</p>
<ul>
<li>تطوير برامج تدريبية جديدة</li>
<li>تحسين طرق التدريس</li>
<li>استخدام أحدث التقنيات التعليمية</li>
<li>التعاون مع مؤسسات تعليمية عالمية</li>
</ul>

<h2>نتائج الجودة العالية</h2>

<h3>معدلات النجاح المرتفعة</h3>
<p>نفخر بمعدلات النجاح المرتفعة لطلابنا، حيث يحقق أكثر من 95% منهم أهدافهم التعليمية.</p>

<h3>رضا الطلاب</h3>
<p>يحصل طلابنا على تجربة تعليمية استثنائية، مما ينعكس على رضاهم العالي عن خدماتنا.</p>

<h3>الاعتراف المهني</h3>
<p>شهاداتنا معترف بها في السوق المحلي والدولي، مما يفتح أبواب الفرص الوظيفية لخريجينا.</p>

<h2>الخاتمة</h2>
<p>الجودة ليست مجرد شعار في أكاديمية السهم الأخضر، بل هي نمط حياة نعيشه يومياً. نلتزم بتقديم أفضل تجربة تعليمية ممكنة لطلابنا، ونسعى دائماً للتميز والابتكار في مجال التعليم والتدريب.</p>', 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', NULL, 'الجودة التعليمية', '[\"\\u062c\\u0648\\u062f\\u0629 \\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645\",\"\\u0645\\u0639\\u0627\\u064a\\u064a\\u0631 \\u0627\\u0644\\u062c\\u0648\\u062f\\u0629\",\"\\u0627\\u0644\\u062a\\u0637\\u0648\\u064a\\u0631 \\u0627\\u0644\\u0645\\u0633\\u062a\\u0645\\u0631\",\"\\u0623\\u0643\\u0627\\u062f\\u064a\\u0645\\u064a\\u0629 \\u0627\\u0644\\u0633\\u0647\\u0645 \\u0627\\u0644\\u0623\\u062e\\u0636\\u0631\"]', 'published', '1', '1', '2025-08-22 12:25:02', 'أهمية الجودة في التعليم - أكاديمية السهم الأخضر', 'أهمية الجودة في التعليم - أكاديمية السهم الأخضر', 'اكتشف معايير الجودة العالية في أكاديمية السهم الأخضر وكيف نضمن أفضل تجربة تعليمية', 'اكتشف معايير الجودة العالية في أكاديمية السهم الأخضر وكيف نضمن أفضل تجربة تعليمية', 'جودة التعليم, معايير الجودة, التطوير المستمر, أكاديمية السهم الأخضر', 'جودة التعليم, معايير الجودة, التطوير المستمر, أكاديمية السهم الأخضر', '74', '0', '0', '10.2', '2025-08-25 12:25:02', '2025-08-25 12:32:05');
INSERT INTO `blog_posts` (`id`, `author_id`, `title_ar`, `title_en`, `slug`, `excerpt_ar`, `excerpt_en`, `content_ar`, `content_en`, `featured_image`, `gallery`, `category`, `tags`, `status`, `is_featured`, `comments_enabled`, `published_at`, `meta_title_ar`, `meta_title_en`, `meta_description_ar`, `meta_description_en`, `meta_keywords_ar`, `meta_keywords_en`, `views_count`, `likes_count`, `shares_count`, `reading_time`, `created_at`, `updated_at`) VALUES ('3', '1', 'تطوير الأداء المهني: استراتيجيات عملية للنجاح', 'تطوير الأداء المهني: استراتيجيات عملية للنجاح', 'ttoyr-aladaaa-almhny-astratygyat-aamly-llngah', 'تعرف على الاستراتيجيات العملية لتطوير أدائك المهني وتحقيق النجاح في حياتك العملية', 'تعرف على الاستراتيجيات العملية لتطوير أدائك المهني وتحقيق النجاح في حياتك العملية', '<h2>تطوير الأداء المهني: الطريق إلى النجاح</h2>
<p>في عالم العمل التنافسي، أصبح تطوير الأداء المهني ضرورة حتمية للبقاء والتقدم. في أكاديمية السهم الأخضر، نقدم استراتيجيات عملية لمساعدتك في تطوير أدائك المهني.</p>

<h2>استراتيجيات تطوير الأداء المهني</h2>

<h3>1. تحديد الأهداف الواضحة</h3>
<p>الخطوة الأولى في تطوير الأداء المهني هي تحديد أهداف واضحة وقابلة للقياس:</p>
<ul>
<li>حدد أهدافك قصيرة المدى وطويلة المدى</li>
<li>اجعل أهدافك قابلة للقياس والتتبع</li>
<li>ضع جدولاً زمنياً واقعياً لتحقيقها</li>
<li>راجع أهدافك دورياً وقم بتحديثها عند الحاجة</li>
</ul>

<h3>2. تطوير المهارات الأساسية</h3>
<p>ركز على تطوير المهارات الأساسية التي يحتاجها سوق العمل:</p>
<ul>
<li><strong>المهارات التقنية:</strong> تعلم أحدث التقنيات في مجالك</li>
<li><strong>المهارات الناعمة:</strong> طور مهارات التواصل والقيادة</li>
<li><strong>المهارات الرقمية:</strong> أتقن استخدام الأدوات الرقمية الحديثة</li>
<li><strong>مهارات حل المشكلات:</strong> طور قدرتك على التحليل واتخاذ القرارات</li>
</ul>

<h3>3. التعلم المستمر</h3>
<p>في أكاديمية السهم الأخضر، نؤمن بأهمية التعلم المستمر:</p>
<ul>
<li>انضم لدورات تدريبية متخصصة</li>
<li>اقرأ الكتب والمقالات في مجالك</li>
<li>حضر المؤتمرات والندوات المهنية</li>
<li>تابع التطورات الحديثة في مجالك</li>
</ul>

<h2>دور أكاديمية السهم الأخضر في تطوير الأداء</h2>

<h3>برامج تدريبية متخصصة</h3>
<p>نقدم مجموعة متنوعة من البرامج التدريبية المصممة لتطوير الأداء المهني:</p>
<ul>
<li>دورات في القيادة والإدارة</li>
<li>برامج تطوير المهارات التقنية</li>
<li>دورات في التسويق والمبيعات</li>
<li>برامج في التطوير الشخصي</li>
</ul>

<h3>التدريب العملي</h3>
<p>نركز على الجانب العملي في تدريبنا:</p>
<ul>
<li>مشاريع عملية تطبيقية</li>
<li>حالات دراسية واقعية</li>
<li>محاكاة بيئات العمل</li>
<li>تدريب على حل المشكلات</li>
</ul>

<h2>مؤشرات الأداء المهني</h2>

<h3>مؤشرات الكمية</h3>
<ul>
<li>زيادة الإنتاجية</li>
<li>تحسين جودة العمل</li>
<li>تقليل الأخطاء</li>
<li>زيادة المبيعات أو الإيرادات</li>
</ul>

<h3>مؤشرات النوعية</h3>
<ul>
<li>رضا العملاء</li>
<li>تحسين العلاقات المهنية</li>
<li>زيادة الثقة بالنفس</li>
<li>تطوير مهارات القيادة</li>
</ul>

<h2>نصائح للنجاح</h2>

<ol>
<li><strong>كن منفتحاً على التغيير:</strong> تقبل الأفكار الجديدة وطرق العمل الحديثة</li>
<li><strong>اطلب التغذية الراجعة:</strong> استمع لآراء الآخرين واستفد منها</li>
<li><strong>كن منظم:</strong> نظم وقتك ومهامك بشكل فعال</li>
<li><strong>تواصل بفعالية:</strong> طور مهارات التواصل مع الآخرين</li>
<li><strong>حافظ على التوازن:</strong> وازن بين العمل والحياة الشخصية</li>
</ol>

<h2>الخاتمة</h2>
<p>تطوير الأداء المهني رحلة مستمرة تتطلب الالتزام والجهد المستمر. في أكاديمية السهم الأخضر، نقدم لك الأدوات والاستراتيجيات اللازمة لتحقيق النجاح المهني وتطوير أدائك إلى أعلى المستويات.</p>', '<h2>تطوير الأداء المهني: الطريق إلى النجاح</h2>
<p>في عالم العمل التنافسي، أصبح تطوير الأداء المهني ضرورة حتمية للبقاء والتقدم. في أكاديمية السهم الأخضر، نقدم استراتيجيات عملية لمساعدتك في تطوير أدائك المهني.</p>

<h2>استراتيجيات تطوير الأداء المهني</h2>

<h3>1. تحديد الأهداف الواضحة</h3>
<p>الخطوة الأولى في تطوير الأداء المهني هي تحديد أهداف واضحة وقابلة للقياس:</p>
<ul>
<li>حدد أهدافك قصيرة المدى وطويلة المدى</li>
<li>اجعل أهدافك قابلة للقياس والتتبع</li>
<li>ضع جدولاً زمنياً واقعياً لتحقيقها</li>
<li>راجع أهدافك دورياً وقم بتحديثها عند الحاجة</li>
</ul>

<h3>2. تطوير المهارات الأساسية</h3>
<p>ركز على تطوير المهارات الأساسية التي يحتاجها سوق العمل:</p>
<ul>
<li><strong>المهارات التقنية:</strong> تعلم أحدث التقنيات في مجالك</li>
<li><strong>المهارات الناعمة:</strong> طور مهارات التواصل والقيادة</li>
<li><strong>المهارات الرقمية:</strong> أتقن استخدام الأدوات الرقمية الحديثة</li>
<li><strong>مهارات حل المشكلات:</strong> طور قدرتك على التحليل واتخاذ القرارات</li>
</ul>

<h3>3. التعلم المستمر</h3>
<p>في أكاديمية السهم الأخضر، نؤمن بأهمية التعلم المستمر:</p>
<ul>
<li>انضم لدورات تدريبية متخصصة</li>
<li>اقرأ الكتب والمقالات في مجالك</li>
<li>حضر المؤتمرات والندوات المهنية</li>
<li>تابع التطورات الحديثة في مجالك</li>
</ul>

<h2>دور أكاديمية السهم الأخضر في تطوير الأداء</h2>

<h3>برامج تدريبية متخصصة</h3>
<p>نقدم مجموعة متنوعة من البرامج التدريبية المصممة لتطوير الأداء المهني:</p>
<ul>
<li>دورات في القيادة والإدارة</li>
<li>برامج تطوير المهارات التقنية</li>
<li>دورات في التسويق والمبيعات</li>
<li>برامج في التطوير الشخصي</li>
</ul>

<h3>التدريب العملي</h3>
<p>نركز على الجانب العملي في تدريبنا:</p>
<ul>
<li>مشاريع عملية تطبيقية</li>
<li>حالات دراسية واقعية</li>
<li>محاكاة بيئات العمل</li>
<li>تدريب على حل المشكلات</li>
</ul>

<h2>مؤشرات الأداء المهني</h2>

<h3>مؤشرات الكمية</h3>
<ul>
<li>زيادة الإنتاجية</li>
<li>تحسين جودة العمل</li>
<li>تقليل الأخطاء</li>
<li>زيادة المبيعات أو الإيرادات</li>
</ul>

<h3>مؤشرات النوعية</h3>
<ul>
<li>رضا العملاء</li>
<li>تحسين العلاقات المهنية</li>
<li>زيادة الثقة بالنفس</li>
<li>تطوير مهارات القيادة</li>
</ul>

<h2>نصائح للنجاح</h2>

<ol>
<li><strong>كن منفتحاً على التغيير:</strong> تقبل الأفكار الجديدة وطرق العمل الحديثة</li>
<li><strong>اطلب التغذية الراجعة:</strong> استمع لآراء الآخرين واستفد منها</li>
<li><strong>كن منظم:</strong> نظم وقتك ومهامك بشكل فعال</li>
<li><strong>تواصل بفعالية:</strong> طور مهارات التواصل مع الآخرين</li>
<li><strong>حافظ على التوازن:</strong> وازن بين العمل والحياة الشخصية</li>
</ol>

<h2>الخاتمة</h2>
<p>تطوير الأداء المهني رحلة مستمرة تتطلب الالتزام والجهد المستمر. في أكاديمية السهم الأخضر، نقدم لك الأدوات والاستراتيجيات اللازمة لتحقيق النجاح المهني وتطوير أدائك إلى أعلى المستويات.</p>', 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', NULL, 'تطوير الأداء', '[\"\\u062a\\u0637\\u0648\\u064a\\u0631 \\u0627\\u0644\\u0623\\u062f\\u0627\\u0621\",\"\\u0627\\u0644\\u0646\\u062c\\u0627\\u062d \\u0627\\u0644\\u0645\\u0647\\u0646\\u064a\",\"\\u0627\\u0644\\u0645\\u0647\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u0645\\u0647\\u0646\\u064a\\u0629\",\"\\u0627\\u0644\\u062a\\u0637\\u0648\\u064a\\u0631 \\u0627\\u0644\\u0630\\u0627\\u062a\\u064a\"]', 'published', '0', '1', '2025-08-24 12:25:02', 'تطوير الأداء المهني - استراتيجيات عملية للنجاح', 'تطوير الأداء المهني - استراتيجيات عملية للنجاح', 'تعرف على الاستراتيجيات العملية لتطوير أدائك المهني وتحقيق النجاح في حياتك العملية', 'تعرف على الاستراتيجيات العملية لتطوير أدائك المهني وتحقيق النجاح في حياتك العملية', 'تطوير الأداء, النجاح المهني, المهارات المهنية, التطوير الذاتي', 'تطوير الأداء, النجاح المهني, المهارات المهنية, التطوير الذاتي', '321', '0', '0', '12.5', '2025-08-25 12:25:02', '2025-08-25 12:25:02');
INSERT INTO `blog_posts` (`id`, `author_id`, `title_ar`, `title_en`, `slug`, `excerpt_ar`, `excerpt_en`, `content_ar`, `content_en`, `featured_image`, `gallery`, `category`, `tags`, `status`, `is_featured`, `comments_enabled`, `published_at`, `meta_title_ar`, `meta_title_en`, `meta_description_ar`, `meta_description_en`, `meta_keywords_ar`, `meta_keywords_en`, `views_count`, `likes_count`, `shares_count`, `reading_time`, `created_at`, `updated_at`) VALUES ('4', '1', 'أحدث التقنيات في التعليم الإلكتروني: رؤية مستقبلية', 'أحدث التقنيات في التعليم الإلكتروني: رؤية مستقبلية', 'ahdth-altknyat-fy-altaalym-alalktrony-roy-mstkbly', 'اكتشف أحدث التقنيات والابتكارات في مجال التعليم الإلكتروني وكيف تستفيد منها أكاديمية السهم الأخضر', 'اكتشف أحدث التقنيات والابتكارات في مجال التعليم الإلكتروني وكيف تستفيد منها أكاديمية السهم الأخضر', '<h2>التعليم الإلكتروني: مستقبل التعليم</h2>
<p>يشهد العالم تحولاً جذرياً في مجال التعليم، حيث أصبح التعليم الإلكتروني جزءاً أساسياً من العملية التعليمية. في أكاديمية السهم الأخضر، نواكب هذه التطورات ونستثمر في أحدث التقنيات.</p>

<h2>أحدث التقنيات في التعليم الإلكتروني</h2>

<h3>1. الذكاء الاصطناعي في التعليم</h3>
<p>يستخدم الذكاء الاصطناعي في تطوير أنظمة تعليمية ذكية:</p>
<ul>
<li><strong>التعلم التكيفي:</strong> يتكيف المحتوى مع مستوى كل طالب</li>
<li><strong>التقييم الذكي:</strong> تقييم فوري ودقيق للأداء</li>
<li><strong>المساعدات الذكية:</strong> مساعدة فورية للطلاب</li>
<li><strong>تحليل البيانات:</strong> فهم أفضل لسلوك التعلم</li>
</ul>

<h3>2. الواقع المعزز والافتراضي</h3>
<p>تطبيقات متقدمة في التعليم:</p>
<ul>
<li><strong>المحاكاة الافتراضية:</strong> تجارب تعليمية واقعية</li>
<li><strong>الجولات الافتراضية:</strong> استكشاف بيئات مختلفة</li>
<li><strong>التدريب العملي:</strong> ممارسة المهارات في بيئة آمنة</li>
<li><strong>التفاعل ثلاثي الأبعاد:</strong> فهم أفضل للمفاهيم المعقدة</li>
</ul>

<h3>3. التعلم المتنقل</h3>
<p>التعلم في أي وقت ومكان:</p>
<ul>
<li>تطبيقات الهواتف الذكية</li>
<li>المحتوى المتجاوب</li>
<li>التعلم غير المتصل</li>
<li>التزامن عبر الأجهزة</li>
</ul>

<h2>استراتيجية أكاديمية السهم الأخضر</h2>

<h3>البنية التحتية التقنية</h3>
<p>نستثمر في بنية تحتية تقنية متطورة:</p>
<ul>
<li>منصات تعليمية متقدمة</li>
<li>خوادم عالية الأداء</li>
<li>أنظمة أمان متطورة</li>
<li>دعم تقني 24/7</li>
</ul>

<h3>تطوير المحتوى الرقمي</h3>
<p>نطور محتوى رقمي عالي الجودة:</p>
<ul>
<li>فيديوهات تعليمية تفاعلية</li>
<li>عروض تقديمية متقدمة</li>
<li>اختبارات إلكترونية</li>
<li>مكتبة رقمية شاملة</li>
</ul>

<h2>مزايا التعليم الإلكتروني</h2>

<h3>المرونة والراحة</h3>
<ul>
<li>التعلم في الوقت المناسب لك</li>
<li>إمكانية الوصول من أي مكان</li>
<li>توفير الوقت والجهد</li>
<li>التعلم بالوتيرة المناسبة</li>
</ul>

<h3>التفاعل والمشاركة</h3>
<ul>
<li>منتديات نقاش تفاعلية</li>
<li>مجموعات عمل افتراضية</li>
<li>تغذية راجعة فورية</li>
<li>تعاون مع زملاء من مختلف البلدان</li>
</ul>

<h2>التحديات والحلول</h2>

<h3>التحديات التقنية</h3>
<p>نواجه تحديات تقنية ونقدم حلولاً فعالة:</p>
<ul>
<li><strong>مشاكل الاتصال:</strong> محتوى متاح للتحميل</li>
<li><strong>التفاعل المحدود:</strong> أدوات تفاعل متقدمة</li>
<li><strong>جودة المحتوى:</strong> معايير جودة عالية</li>
<li><strong>الأمان:</strong> أنظمة حماية متطورة</li>
</ul>

<h2>مستقبل التعليم الإلكتروني</h2>

<h3>التوجهات المستقبلية</h3>
<ul>
<li>الذكاء الاصطناعي المتقدم</li>
<li>الواقع المعزز والافتراضي</li>
<li>التعلم الشخصي</li>
<li>البيانات الضخمة في التعليم</li>
</ul>

<h2>الخاتمة</h2>
<p>التعليم الإلكتروني ليس مجرد اتجاه عابر، بل هو مستقبل التعليم. في أكاديمية السهم الأخضر، نستثمر في أحدث التقنيات ونطور استراتيجيات تعليمية متقدمة لضمان حصول طلابنا على أفضل تجربة تعليمية ممكنة.</p>', '<h2>التعليم الإلكتروني: مستقبل التعليم</h2>
<p>يشهد العالم تحولاً جذرياً في مجال التعليم، حيث أصبح التعليم الإلكتروني جزءاً أساسياً من العملية التعليمية. في أكاديمية السهم الأخضر، نواكب هذه التطورات ونستثمر في أحدث التقنيات.</p>

<h2>أحدث التقنيات في التعليم الإلكتروني</h2>

<h3>1. الذكاء الاصطناعي في التعليم</h3>
<p>يستخدم الذكاء الاصطناعي في تطوير أنظمة تعليمية ذكية:</p>
<ul>
<li><strong>التعلم التكيفي:</strong> يتكيف المحتوى مع مستوى كل طالب</li>
<li><strong>التقييم الذكي:</strong> تقييم فوري ودقيق للأداء</li>
<li><strong>المساعدات الذكية:</strong> مساعدة فورية للطلاب</li>
<li><strong>تحليل البيانات:</strong> فهم أفضل لسلوك التعلم</li>
</ul>

<h3>2. الواقع المعزز والافتراضي</h3>
<p>تطبيقات متقدمة في التعليم:</p>
<ul>
<li><strong>المحاكاة الافتراضية:</strong> تجارب تعليمية واقعية</li>
<li><strong>الجولات الافتراضية:</strong> استكشاف بيئات مختلفة</li>
<li><strong>التدريب العملي:</strong> ممارسة المهارات في بيئة آمنة</li>
<li><strong>التفاعل ثلاثي الأبعاد:</strong> فهم أفضل للمفاهيم المعقدة</li>
</ul>

<h3>3. التعلم المتنقل</h3>
<p>التعلم في أي وقت ومكان:</p>
<ul>
<li>تطبيقات الهواتف الذكية</li>
<li>المحتوى المتجاوب</li>
<li>التعلم غير المتصل</li>
<li>التزامن عبر الأجهزة</li>
</ul>

<h2>استراتيجية أكاديمية السهم الأخضر</h2>

<h3>البنية التحتية التقنية</h3>
<p>نستثمر في بنية تحتية تقنية متطورة:</p>
<ul>
<li>منصات تعليمية متقدمة</li>
<li>خوادم عالية الأداء</li>
<li>أنظمة أمان متطورة</li>
<li>دعم تقني 24/7</li>
</ul>

<h3>تطوير المحتوى الرقمي</h3>
<p>نطور محتوى رقمي عالي الجودة:</p>
<ul>
<li>فيديوهات تعليمية تفاعلية</li>
<li>عروض تقديمية متقدمة</li>
<li>اختبارات إلكترونية</li>
<li>مكتبة رقمية شاملة</li>
</ul>

<h2>مزايا التعليم الإلكتروني</h2>

<h3>المرونة والراحة</h3>
<ul>
<li>التعلم في الوقت المناسب لك</li>
<li>إمكانية الوصول من أي مكان</li>
<li>توفير الوقت والجهد</li>
<li>التعلم بالوتيرة المناسبة</li>
</ul>

<h3>التفاعل والمشاركة</h3>
<ul>
<li>منتديات نقاش تفاعلية</li>
<li>مجموعات عمل افتراضية</li>
<li>تغذية راجعة فورية</li>
<li>تعاون مع زملاء من مختلف البلدان</li>
</ul>

<h2>التحديات والحلول</h2>

<h3>التحديات التقنية</h3>
<p>نواجه تحديات تقنية ونقدم حلولاً فعالة:</p>
<ul>
<li><strong>مشاكل الاتصال:</strong> محتوى متاح للتحميل</li>
<li><strong>التفاعل المحدود:</strong> أدوات تفاعل متقدمة</li>
<li><strong>جودة المحتوى:</strong> معايير جودة عالية</li>
<li><strong>الأمان:</strong> أنظمة حماية متطورة</li>
</ul>

<h2>مستقبل التعليم الإلكتروني</h2>

<h3>التوجهات المستقبلية</h3>
<ul>
<li>الذكاء الاصطناعي المتقدم</li>
<li>الواقع المعزز والافتراضي</li>
<li>التعلم الشخصي</li>
<li>البيانات الضخمة في التعليم</li>
</ul>

<h2>الخاتمة</h2>
<p>التعليم الإلكتروني ليس مجرد اتجاه عابر، بل هو مستقبل التعليم. في أكاديمية السهم الأخضر، نستثمر في أحدث التقنيات ونطور استراتيجيات تعليمية متقدمة لضمان حصول طلابنا على أفضل تجربة تعليمية ممكنة.</p>', 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', NULL, 'التعليم الإلكتروني', '[\"\\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645 \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"\\u0627\\u0644\\u062a\\u0642\\u0646\\u064a\\u0627\\u062a \\u0627\\u0644\\u062d\\u062f\\u064a\\u062b\\u0629\",\"\\u0627\\u0644\\u0630\\u0643\\u0627\\u0621 \\u0627\\u0644\\u0627\\u0635\\u0637\\u0646\\u0627\\u0639\\u064a\",\"\\u0627\\u0644\\u062a\\u0639\\u0644\\u0645 \\u0627\\u0644\\u0631\\u0642\\u0645\\u064a\"]', 'published', '0', '1', '2025-08-23 12:25:02', 'أحدث التقنيات في التعليم الإلكتروني - أكاديمية السهم الأخضر', 'أحدث التقنيات في التعليم الإلكتروني - أكاديمية السهم الأخضر', 'اكتشف أحدث التقنيات والابتكارات في مجال التعليم الإلكتروني وكيف تستفيد منها أكاديمية السهم الأخضر', 'اكتشف أحدث التقنيات والابتكارات في مجال التعليم الإلكتروني وكيف تستفيد منها أكاديمية السهم الأخضر', 'التعليم الإلكتروني, التقنيات الحديثة, الذكاء الاصطناعي, التعلم الرقمي', 'التعليم الإلكتروني, التقنيات الحديثة, الذكاء الاصطناعي, التعلم الرقمي', '331', '0', '0', '15.8', '2025-08-25 12:25:02', '2025-08-25 12:25:02');
INSERT INTO `blog_posts` (`id`, `author_id`, `title_ar`, `title_en`, `slug`, `excerpt_ar`, `excerpt_en`, `content_ar`, `content_en`, `featured_image`, `gallery`, `category`, `tags`, `status`, `is_featured`, `comments_enabled`, `published_at`, `meta_title_ar`, `meta_title_en`, `meta_description_ar`, `meta_description_en`, `meta_keywords_ar`, `meta_keywords_en`, `views_count`, `likes_count`, `shares_count`, `reading_time`, `created_at`, `updated_at`) VALUES ('5', '1', 'كيف تبني مسيرة مهنية ناجحة في مجال البرمجة', 'كيف تبني مسيرة مهنية ناجحة في مجال البرمجة', 'kyf-tbny-msyr-mhny-nagh-fy-mgal-albrmg', 'دليل شامل لبناء مسيرة مهنية ناجحة في مجال البرمجة والتطوير، من البداية إلى الاحتراف', 'دليل شامل لبناء مسيرة مهنية ناجحة في مجال البرمجة والتطوير، من البداية إلى الاحتراف', '<h2>البرمجة: مهنة المستقبل</h2>
<p>في عصر التكنولوجيا، أصبح مجال البرمجة من أكثر المجالات طلباً وربحية. في أكاديمية السهم الأخضر، نقدم برامج تدريبية شاملة لمساعدتك في بناء مسيرة مهنية ناجحة في هذا المجال.</p>

<h2>خطوات بناء مسيرة مهنية في البرمجة</h2>

<h3>1. اختيار المسار المناسب</h3>
<p>مجال البرمجة واسع ومتنوع، لذا من المهم اختيار المسار المناسب:</p>
<ul>
<li><strong>تطوير الويب:</strong> HTML, CSS, JavaScript, PHP, Python</li>
<li><strong>تطوير التطبيقات:</strong> Java, Swift, Kotlin, React Native</li>
<li><strong>علوم البيانات:</strong> Python, R, SQL, Machine Learning</li>
<li><strong>الأمن السيبراني:</strong> Ethical Hacking, Network Security</li>
</ul>

<h3>2. بناء الأساسيات القوية</h3>
<p>ابدأ بالأساسيات قبل الانتقال للمواضيع المتقدمة:</p>
<ul>
<li>تعلم منطق البرمجة والخوارزميات</li>
<li>أتقن لغة برمجة واحدة جيداً</li>
<li>فهم هياكل البيانات</li>
<li>تعلم قواعد البيانات</li>
</ul>

<h3>3. التطبيق العملي</h3>
<p>الممارسة هي أفضل طريقة للتعلم:</p>
<ul>
<li>ابدأ بمشاريع بسيطة</li>
<li>شارك في مشاريع مفتوحة المصدر</li>
<li>ابني محفظة أعمال شخصية</li>
<li>شارك في مسابقات البرمجة</li>
</ul>

<h2>دورات البرمجة في أكاديمية السهم الأخضر</h2>

<h3>دورات المبتدئين</h3>
<p>نقدم دورات للمبتدئين تشمل:</p>
<ul>
<li>أساسيات البرمجة</li>
<li>HTML و CSS للمبتدئين</li>
<li>JavaScript الأساسي</li>
<li>Python للمبتدئين</li>
</ul>

<h3>دورات متقدمة</h3>
<p>للطلاب المتقدمين نقدم:</p>
<ul>
<li>تطوير تطبيقات الويب المتقدمة</li>
<li>تطوير تطبيقات الهاتف</li>
<li>علوم البيانات والذكاء الاصطناعي</li>
<li>الأمن السيبراني</li>
</ul>

<h2>مهارات ضرورية للنجاح</h2>

<h3>المهارات التقنية</h3>
<ul>
<li>إتقان لغات البرمجة المختلفة</li>
<li>فهم قواعد البيانات</li>
<li>معرفة أطر العمل الحديثة</li>
<li>فهم مبادئ التصميم</li>
</ul>

<h3>المهارات الناعمة</h3>
<ul>
<li>حل المشكلات</li>
<li>العمل الجماعي</li>
<li>التواصل الفعال</li>
<li>إدارة الوقت</li>
</ul>

<h2>فرص العمل في مجال البرمجة</h2>

<h3>الوظائف المتاحة</h3>
<ul>
<li>مطور ويب</li>
<li>مطور تطبيقات الهاتف</li>
<li>مطور برامج سطح المكتب</li>
<li>مهندس برمجيات</li>
<li>محلل بيانات</li>
<li>مختبر برمجيات</li>
</ul>

<h3>القطاعات المختلفة</h3>
<ul>
<li>شركات التكنولوجيا</li>
<li>البنوك والمؤسسات المالية</li>
<li>الشركات الحكومية</li>
<li>الشركات الناشئة</li>
<li>العمل الحر</li>
</ul>

<h2>نصائح للنجاح</h2>

<ol>
<li><strong>تعلم باستمرار:</strong> التكنولوجيا تتطور بسرعة، لذا واصل التعلم</li>
<li><strong>انضم لمجتمعات البرمجة:</strong> شارك خبراتك وتعلم من الآخرين</li>
<li><strong>ابني مشاريع شخصية:</strong> أظهر مهاراتك من خلال مشاريعك</li>
<li><strong>احصل على شهادات معتمدة:</strong> عزز سيرتك الذاتية</li>
<li><strong>تابع التطورات:</strong> ابق على اطلاع بأحدث التقنيات</li>
</ol>

<h2>الخاتمة</h2>
<p>بناء مسيرة مهنية ناجحة في البرمجة يتطلب الجهد والالتزام، لكن النتائج تستحق العناء. في أكاديمية السهم الأخضر، نقدم لك الأدوات والمعرفة اللازمة لتحقيق النجاح في هذا المجال المثير.</p>', '<h2>البرمجة: مهنة المستقبل</h2>
<p>في عصر التكنولوجيا، أصبح مجال البرمجة من أكثر المجالات طلباً وربحية. في أكاديمية السهم الأخضر، نقدم برامج تدريبية شاملة لمساعدتك في بناء مسيرة مهنية ناجحة في هذا المجال.</p>

<h2>خطوات بناء مسيرة مهنية في البرمجة</h2>

<h3>1. اختيار المسار المناسب</h3>
<p>مجال البرمجة واسع ومتنوع، لذا من المهم اختيار المسار المناسب:</p>
<ul>
<li><strong>تطوير الويب:</strong> HTML, CSS, JavaScript, PHP, Python</li>
<li><strong>تطوير التطبيقات:</strong> Java, Swift, Kotlin, React Native</li>
<li><strong>علوم البيانات:</strong> Python, R, SQL, Machine Learning</li>
<li><strong>الأمن السيبراني:</strong> Ethical Hacking, Network Security</li>
</ul>

<h3>2. بناء الأساسيات القوية</h3>
<p>ابدأ بالأساسيات قبل الانتقال للمواضيع المتقدمة:</p>
<ul>
<li>تعلم منطق البرمجة والخوارزميات</li>
<li>أتقن لغة برمجة واحدة جيداً</li>
<li>فهم هياكل البيانات</li>
<li>تعلم قواعد البيانات</li>
</ul>

<h3>3. التطبيق العملي</h3>
<p>الممارسة هي أفضل طريقة للتعلم:</p>
<ul>
<li>ابدأ بمشاريع بسيطة</li>
<li>شارك في مشاريع مفتوحة المصدر</li>
<li>ابني محفظة أعمال شخصية</li>
<li>شارك في مسابقات البرمجة</li>
</ul>

<h2>دورات البرمجة في أكاديمية السهم الأخضر</h2>

<h3>دورات المبتدئين</h3>
<p>نقدم دورات للمبتدئين تشمل:</p>
<ul>
<li>أساسيات البرمجة</li>
<li>HTML و CSS للمبتدئين</li>
<li>JavaScript الأساسي</li>
<li>Python للمبتدئين</li>
</ul>

<h3>دورات متقدمة</h3>
<p>للطلاب المتقدمين نقدم:</p>
<ul>
<li>تطوير تطبيقات الويب المتقدمة</li>
<li>تطوير تطبيقات الهاتف</li>
<li>علوم البيانات والذكاء الاصطناعي</li>
<li>الأمن السيبراني</li>
</ul>

<h2>مهارات ضرورية للنجاح</h2>

<h3>المهارات التقنية</h3>
<ul>
<li>إتقان لغات البرمجة المختلفة</li>
<li>فهم قواعد البيانات</li>
<li>معرفة أطر العمل الحديثة</li>
<li>فهم مبادئ التصميم</li>
</ul>

<h3>المهارات الناعمة</h3>
<ul>
<li>حل المشكلات</li>
<li>العمل الجماعي</li>
<li>التواصل الفعال</li>
<li>إدارة الوقت</li>
</ul>

<h2>فرص العمل في مجال البرمجة</h2>

<h3>الوظائف المتاحة</h3>
<ul>
<li>مطور ويب</li>
<li>مطور تطبيقات الهاتف</li>
<li>مطور برامج سطح المكتب</li>
<li>مهندس برمجيات</li>
<li>محلل بيانات</li>
<li>مختبر برمجيات</li>
</ul>

<h3>القطاعات المختلفة</h3>
<ul>
<li>شركات التكنولوجيا</li>
<li>البنوك والمؤسسات المالية</li>
<li>الشركات الحكومية</li>
<li>الشركات الناشئة</li>
<li>العمل الحر</li>
</ul>

<h2>نصائح للنجاح</h2>

<ol>
<li><strong>تعلم باستمرار:</strong> التكنولوجيا تتطور بسرعة، لذا واصل التعلم</li>
<li><strong>انضم لمجتمعات البرمجة:</strong> شارك خبراتك وتعلم من الآخرين</li>
<li><strong>ابني مشاريع شخصية:</strong> أظهر مهاراتك من خلال مشاريعك</li>
<li><strong>احصل على شهادات معتمدة:</strong> عزز سيرتك الذاتية</li>
<li><strong>تابع التطورات:</strong> ابق على اطلاع بأحدث التقنيات</li>
</ol>

<h2>الخاتمة</h2>
<p>بناء مسيرة مهنية ناجحة في البرمجة يتطلب الجهد والالتزام، لكن النتائج تستحق العناء. في أكاديمية السهم الأخضر، نقدم لك الأدوات والمعرفة اللازمة لتحقيق النجاح في هذا المجال المثير.</p>', 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', NULL, 'البرمجة والتطوير', '[\"\\u0627\\u0644\\u0628\\u0631\\u0645\\u062c\\u0629\",\"\\u062a\\u0637\\u0648\\u064a\\u0631 \\u0627\\u0644\\u0648\\u064a\\u0628\",\"\\u062a\\u0637\\u0648\\u064a\\u0631 \\u0627\\u0644\\u062a\\u0637\\u0628\\u064a\\u0642\\u0627\\u062a\",\"\\u0639\\u0644\\u0648\\u0645 \\u0627\\u0644\\u0628\\u064a\\u0627\\u0646\\u0627\\u062a\"]', 'published', '0', '1', '2025-08-21 12:25:02', 'كيف تبني مسيرة مهنية ناجحة في مجال البرمجة', 'كيف تبني مسيرة مهنية ناجحة في مجال البرمجة', 'دليل شامل لبناء مسيرة مهنية ناجحة في مجال البرمجة والتطوير، من البداية إلى الاحتراف', 'دليل شامل لبناء مسيرة مهنية ناجحة في مجال البرمجة والتطوير، من البداية إلى الاحتراف', 'البرمجة, تطوير الويب, تطوير التطبيقات, علوم البيانات', 'البرمجة, تطوير الويب, تطوير التطبيقات, علوم البيانات', '264', '0', '0', '18.3', '2025-08-25 12:25:02', '2025-08-25 12:25:02');
INSERT INTO `blog_posts` (`id`, `author_id`, `title_ar`, `title_en`, `slug`, `excerpt_ar`, `excerpt_en`, `content_ar`, `content_en`, `featured_image`, `gallery`, `category`, `tags`, `status`, `is_featured`, `comments_enabled`, `published_at`, `meta_title_ar`, `meta_title_en`, `meta_description_ar`, `meta_description_en`, `meta_keywords_ar`, `meta_keywords_en`, `views_count`, `likes_count`, `shares_count`, `reading_time`, `created_at`, `updated_at`) VALUES ('6', '1', 'إدارة المشاريع الحديثة: منهجيات وأدوات فعالة', 'إدارة المشاريع الحديثة: منهجيات وأدوات فعالة', 'adar-almsharyaa-alhdyth-mnhgyat-oadoat-faaal', 'تعرف على أحدث منهجيات إدارة المشاريع والأدوات الفعالة المستخدمة في الشركات العالمية', 'تعرف على أحدث منهجيات إدارة المشاريع والأدوات الفعالة المستخدمة في الشركات العالمية', '<h2>إدارة المشاريع: فن وعلم</h2>
<p>إدارة المشاريع أصبحت مهارة أساسية في عالم الأعمال الحديث. في أكاديمية السهم الأخضر، نقدم دورات متخصصة في إدارة المشاريع لمساعدتك في تطوير هذه المهارة المهمة.</p>

<h2>منهجيات إدارة المشاريع الحديثة</h2>

<h3>1. منهجية Agile</h3>
<p>منهجية مرنة تركز على التطوير التدريجي:</p>
<ul>
<li><strong>Scrum:</strong> إطار عمل مرن للتطوير</li>
<li><strong>Kanban:</strong> نظام بصري لإدارة المهام</li>
<li><strong>Lean:</strong> تقليل الهدر وزيادة القيمة</li>
<li><strong>XP:</strong> البرمجة المتطرفة</li>
</ul>

<h3>2. منهجية Waterfall</h3>
<p>منهجية تقليدية منظمة:</p>
<ul>
<li>تحليل المتطلبات</li>
<li>التصميم</li>
<li>التطوير</li>
<li>الاختبار</li>
<li>النشر</li>
</ul>

<h3>3. منهجية Hybrid</h3>
<p>دمج أفضل ما في المنهجيات المختلفة</p>

<h2>أدوات إدارة المشاريع الحديثة</h2>

<h3>أدوات التخطيط</h3>
<ul>
<li><strong>Microsoft Project:</strong> أداة شاملة لإدارة المشاريع</li>
<li><strong>Asana:</strong> إدارة المهام والتعاون</li>
<li><strong>Trello:</strong> لوحات مرئية للمشاريع</li>
<li><strong>Jira:</strong> إدارة المشاريع التقنية</li>
</ul>

<h3>أدوات التواصل</h3>
<ul>
<li>Slack للتواصل الفوري</li>
<li>Microsoft Teams للاجتماعات</li>
<li>Zoom للمؤتمرات المرئية</li>
<li>Google Meet للتعاون</li>
</ul>

<h2>دورات إدارة المشاريع في أكاديمية السهم الأخضر</h2>

<h3>دورات أساسية</h3>
<p>نقدم دورات أساسية تشمل:</p>
<ul>
<li>أساسيات إدارة المشاريع</li>
<li>منهجية Agile</li>
<li>أدوات إدارة المشاريع</li>
<li>إدارة المخاطر</li>
</ul>

<h3>دورات متقدمة</h3>
<p>للطلاب المتقدمين نقدم:</p>
<ul>
<li>شهادة PMP</li>
<li>إدارة المشاريع الرقمية</li>
<li>إدارة المشاريع في مجال التكنولوجيا</li>
<li>إدارة التغيير التنظيمي</li>
</ul>

<h2>مهارات مدير المشروع الناجح</h2>

<h3>المهارات القيادية</h3>
<ul>
<li>القدرة على القيادة والتوجيه</li>
<li>مهارات التواصل الفعال</li>
<li>حل المشكلات واتخاذ القرارات</li>
<li>إدارة الصراعات</li>
</ul>

<h3>المهارات التقنية</h3>
<ul>
<li>فهم التقنيات المستخدمة</li>
<li>إتقان أدوات إدارة المشاريع</li>
<li>تحليل البيانات</li>
<li>إدارة الميزانيات</li>
</ul>

<h2>تحديات إدارة المشاريع</h2>

<h3>التحديات الشائعة</h3>
<ul>
<li>تحديد المتطلبات بدقة</li>
<li>إدارة التوقعات</li>
<li>التعامل مع التغييرات</li>
<li>إدارة الموارد</li>
<li>ضمان الجودة</li>
</ul>

<h3>الحلول الفعالة</h3>
<ul>
<li>التواصل المستمر مع أصحاب المصلحة</li>
<li>استخدام منهجيات مرنة</li>
<li>التخطيط الجيد للمخاطر</li>
<li>المراجعة والتقييم المستمر</li>
</ul>

<h2>مستقبل إدارة المشاريع</h2>

<h3>التوجهات الحديثة</h3>
<ul>
<li>الذكاء الاصطناعي في إدارة المشاريع</li>
<li>إدارة المشاريع عن بُعد</li>
<li>البيانات الضخمة والتحليلات</li>
<li>الاستدامة في إدارة المشاريع</li>
</ul>

<h2>الخاتمة</h2>
<p>إدارة المشاريع مهارة أساسية في عالم الأعمال الحديث. في أكاديمية السهم الأخضر، نقدم لك المعرفة والأدوات اللازمة لتصبح مدير مشاريع ناجح ومحترف.</p>', '<h2>إدارة المشاريع: فن وعلم</h2>
<p>إدارة المشاريع أصبحت مهارة أساسية في عالم الأعمال الحديث. في أكاديمية السهم الأخضر، نقدم دورات متخصصة في إدارة المشاريع لمساعدتك في تطوير هذه المهارة المهمة.</p>

<h2>منهجيات إدارة المشاريع الحديثة</h2>

<h3>1. منهجية Agile</h3>
<p>منهجية مرنة تركز على التطوير التدريجي:</p>
<ul>
<li><strong>Scrum:</strong> إطار عمل مرن للتطوير</li>
<li><strong>Kanban:</strong> نظام بصري لإدارة المهام</li>
<li><strong>Lean:</strong> تقليل الهدر وزيادة القيمة</li>
<li><strong>XP:</strong> البرمجة المتطرفة</li>
</ul>

<h3>2. منهجية Waterfall</h3>
<p>منهجية تقليدية منظمة:</p>
<ul>
<li>تحليل المتطلبات</li>
<li>التصميم</li>
<li>التطوير</li>
<li>الاختبار</li>
<li>النشر</li>
</ul>

<h3>3. منهجية Hybrid</h3>
<p>دمج أفضل ما في المنهجيات المختلفة</p>

<h2>أدوات إدارة المشاريع الحديثة</h2>

<h3>أدوات التخطيط</h3>
<ul>
<li><strong>Microsoft Project:</strong> أداة شاملة لإدارة المشاريع</li>
<li><strong>Asana:</strong> إدارة المهام والتعاون</li>
<li><strong>Trello:</strong> لوحات مرئية للمشاريع</li>
<li><strong>Jira:</strong> إدارة المشاريع التقنية</li>
</ul>

<h3>أدوات التواصل</h3>
<ul>
<li>Slack للتواصل الفوري</li>
<li>Microsoft Teams للاجتماعات</li>
<li>Zoom للمؤتمرات المرئية</li>
<li>Google Meet للتعاون</li>
</ul>

<h2>دورات إدارة المشاريع في أكاديمية السهم الأخضر</h2>

<h3>دورات أساسية</h3>
<p>نقدم دورات أساسية تشمل:</p>
<ul>
<li>أساسيات إدارة المشاريع</li>
<li>منهجية Agile</li>
<li>أدوات إدارة المشاريع</li>
<li>إدارة المخاطر</li>
</ul>

<h3>دورات متقدمة</h3>
<p>للطلاب المتقدمين نقدم:</p>
<ul>
<li>شهادة PMP</li>
<li>إدارة المشاريع الرقمية</li>
<li>إدارة المشاريع في مجال التكنولوجيا</li>
<li>إدارة التغيير التنظيمي</li>
</ul>

<h2>مهارات مدير المشروع الناجح</h2>

<h3>المهارات القيادية</h3>
<ul>
<li>القدرة على القيادة والتوجيه</li>
<li>مهارات التواصل الفعال</li>
<li>حل المشكلات واتخاذ القرارات</li>
<li>إدارة الصراعات</li>
</ul>

<h3>المهارات التقنية</h3>
<ul>
<li>فهم التقنيات المستخدمة</li>
<li>إتقان أدوات إدارة المشاريع</li>
<li>تحليل البيانات</li>
<li>إدارة الميزانيات</li>
</ul>

<h2>تحديات إدارة المشاريع</h2>

<h3>التحديات الشائعة</h3>
<ul>
<li>تحديد المتطلبات بدقة</li>
<li>إدارة التوقعات</li>
<li>التعامل مع التغييرات</li>
<li>إدارة الموارد</li>
<li>ضمان الجودة</li>
</ul>

<h3>الحلول الفعالة</h3>
<ul>
<li>التواصل المستمر مع أصحاب المصلحة</li>
<li>استخدام منهجيات مرنة</li>
<li>التخطيط الجيد للمخاطر</li>
<li>المراجعة والتقييم المستمر</li>
</ul>

<h2>مستقبل إدارة المشاريع</h2>

<h3>التوجهات الحديثة</h3>
<ul>
<li>الذكاء الاصطناعي في إدارة المشاريع</li>
<li>إدارة المشاريع عن بُعد</li>
<li>البيانات الضخمة والتحليلات</li>
<li>الاستدامة في إدارة المشاريع</li>
</ul>

<h2>الخاتمة</h2>
<p>إدارة المشاريع مهارة أساسية في عالم الأعمال الحديث. في أكاديمية السهم الأخضر، نقدم لك المعرفة والأدوات اللازمة لتصبح مدير مشاريع ناجح ومحترف.</p>', 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', NULL, 'إدارة المشاريع', '[\"\\u0625\\u062f\\u0627\\u0631\\u0629 \\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639\",\"Agile\",\"Scrum\",\"PMP\",\"\\u0623\\u062f\\u0648\\u0627\\u062a \\u0625\\u062f\\u0627\\u0631\\u0629 \\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639\"]', 'published', '0', '1', '2025-08-19 12:25:02', 'إدارة المشاريع الحديثة - منهجيات وأدوات فعالة', 'إدارة المشاريع الحديثة - منهجيات وأدوات فعالة', 'تعرف على أحدث منهجيات إدارة المشاريع والأدوات الفعالة المستخدمة في الشركات العالمية', 'تعرف على أحدث منهجيات إدارة المشاريع والأدوات الفعالة المستخدمة في الشركات العالمية', 'إدارة المشاريع, Agile, Scrum, PMP, أدوات إدارة المشاريع', 'إدارة المشاريع, Agile, Scrum, PMP, أدوات إدارة المشاريع', '451', '0', '0', '14.7', '2025-08-25 12:25:02', '2025-08-25 12:25:02');

CREATE TABLE `permissions` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `name` varchar(255) not null, `guard_name` varchar(255) not null, `created_at` timestamp, `updated_at` timestamp);

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('1', 'view-users', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('2', 'create-users', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('3', 'edit-users', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('4', 'delete-users', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('5', 'manage-user-roles', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('6', 'view-user-profiles', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('7', 'export-users', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('8', 'import-users', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('9', 'manage-user-status', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('10', 'view-courses', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('11', 'create-courses', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('12', 'edit-courses', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('13', 'delete-courses', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('14', 'publish-courses', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('15', 'unpublish-courses', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('16', 'manage-course-content', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('17', 'manage-course-enrollments', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('18', 'view-course-analytics', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('19', 'export-course-data', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('20', 'manage-course-pricing', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('21', 'manage-course-discounts', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('22', 'approve-course-submissions', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('23', 'view-lessons', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('24', 'create-lessons', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('25', 'edit-lessons', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('26', 'delete-lessons', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('27', 'upload-lesson-files', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('28', 'manage-video-content', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('29', 'schedule-live-sessions', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('30', 'manage-assignments', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('31', 'grade-assignments', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('32', 'view-student-progress', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('33', 'manage-quizzes', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('34', 'create-quizzes', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('35', 'edit-quizzes', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('36', 'delete-quizzes', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('37', 'grade-quizzes', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('38', 'view-categories', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('39', 'create-categories', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('40', 'edit-categories', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('41', 'delete-categories', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('42', 'manage-category-hierarchy', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('43', 'view-payments', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('44', 'process-payments', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('45', 'refund-payments', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('46', 'manage-payment-gateways', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('47', 'view-financial-reports', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('48', 'export-payment-reports', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('49', 'manage-invoices', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('50', 'generate-invoices', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('51', 'manage-payment-settings', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('52', 'view-blog-posts', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('53', 'create-blog-posts', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('54', 'edit-blog-posts', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('55', 'delete-blog-posts', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('56', 'publish-blog-posts', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('57', 'manage-blog-categories', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('58', 'manage-blog-comments', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('59', 'approve-blog-comments', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('60', 'manage-seo-content', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('61', 'manage-system-settings', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('62', 'manage-site-configuration', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('63', 'manage-email-settings', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('64', 'manage-notification-settings', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('65', 'manage-backup-settings', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('66', 'view-system-logs', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('67', 'manage-api-settings', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('68', 'manage-security-settings', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('69', 'view-dashboard', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('70', 'view-analytics', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('71', 'generate-reports', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('72', 'export-reports', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('73', 'view-student-reports', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('74', 'view-instructor-reports', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('75', 'view-course-reports', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('76', 'view-enrollment-reports', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('77', 'view-certificates', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('78', 'create-certificates', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('79', 'edit-certificates', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('80', 'delete-certificates', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('81', 'issue-certificates', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('82', 'manage-certificate-templates', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('83', 'download-certificates', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('84', 'send-notifications', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('85', 'manage-notification-templates', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('86', 'view-notification-logs', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('87', 'manage-email-templates', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('88', 'send-bulk-emails', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('89', 'manage-sms-notifications', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('90', 'enroll-in-courses', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('91', 'cancel-enrollments', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('92', 'view-enrollment-history', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('93', 'manage-enrollment-status', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('94', 'access-course-content', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('95', 'submit-assignments', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('96', 'view-grades', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('97', 'participate-in-discussions', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('98', 'join-live-sessions', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('99', 'host-live-sessions', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('100', 'manage-live-session-settings', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('101', 'record-live-sessions', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('102', 'manage-attendance', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('103', 'view-live-session-reports', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('104', 'view-reviews', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('105', 'create-reviews', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('106', 'edit-reviews', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('107', 'delete-reviews', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('108', 'approve-reviews', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('109', 'manage-review-settings', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('110', 'view-coupons', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('111', 'create-coupons', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('112', 'edit-coupons', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('113', 'delete-coupons', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('114', 'manage-coupon-usage', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('115', 'view-coupon-reports', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('116', 'view-own-profile', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('117', 'edit-own-profile', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('118', 'upload-avatar', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('119', 'manage-privacy-settings', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('120', 'view-activity-history', 'web', '2025-08-24 16:54:50', '2025-08-24 16:54:50');

CREATE TABLE `roles` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `name` varchar(255) not null, `guard_name` varchar(255) not null, `created_at` timestamp, `updated_at` timestamp);

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('1', 'admin', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('2', 'teacher', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('3', 'student', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('4', 'moderator', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('5', 'content_creator', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES ('6', 'support', 'web', '2025-08-24 16:54:49', '2025-08-24 16:54:49');

CREATE TABLE `model_has_permissions` (`permission_id` int(11) not null, `model_type` varchar(255) not null, `model_id` int(11) not null, foreign key(`permission_id`) references `permissions`(`id`) on delete cascade, primary key (`permission_id`, `model_id`, `model_type`));


CREATE TABLE `model_has_roles` (`role_id` int(11) not null, `model_type` varchar(255) not null, `model_id` int(11) not null, foreign key(`role_id`) references `roles`(`id`) on delete cascade, primary key (`role_id`, `model_id`, `model_type`));

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('1', 'App\\Models\\User', '1');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('4', 'App\\Models\\User', '2');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('5', 'App\\Models\\User', '3');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('6', 'App\\Models\\User', '4');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '11');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '12');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '13');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '14');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '15');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '16');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '17');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '18');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '19');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '20');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '21');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '22');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '23');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '24');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '25');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '26');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '27');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '28');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '29');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '30');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '33');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('2', 'App\\Models\\User', '34');
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('3', 'App\\Models\\User', '37');

CREATE TABLE `role_has_permissions` (`permission_id` int(11) not null, `role_id` int(11) not null, foreign key(`permission_id`) references `permissions`(`id`) on delete cascade, foreign key(`role_id`) references `roles`(`id`) on delete cascade, primary key (`permission_id`, `role_id`));

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('1', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('2', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('3', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('4', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('5', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('6', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('7', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('8', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('9', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('10', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('11', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('12', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('13', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('14', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('15', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('16', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('17', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('18', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('19', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('20', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('21', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('22', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('23', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('24', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('25', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('26', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('27', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('28', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('29', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('30', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('31', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('32', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('33', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('34', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('35', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('36', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('37', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('38', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('39', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('40', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('41', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('42', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('43', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('44', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('45', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('46', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('47', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('48', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('49', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('50', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('51', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('52', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('53', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('54', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('55', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('56', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('57', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('58', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('59', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('60', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('61', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('62', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('63', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('64', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('65', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('66', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('67', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('68', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('69', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('70', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('71', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('72', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('73', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('74', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('75', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('76', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('77', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('78', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('79', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('80', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('81', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('82', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('83', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('84', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('85', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('86', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('87', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('88', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('89', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('90', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('91', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('92', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('93', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('94', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('95', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('96', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('97', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('98', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('99', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('100', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('101', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('102', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('103', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('104', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('105', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('106', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('107', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('108', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('109', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('110', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('111', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('112', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('113', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('114', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('115', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('116', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('117', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('118', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('119', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('120', '1');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('10', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('11', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('12', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('14', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('15', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('16', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('18', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('20', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('23', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('24', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('25', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('26', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('27', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('28', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('29', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('30', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('31', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('32', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('33', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('34', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('35', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('36', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('37', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('6', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('73', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('104', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('105', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('106', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('99', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('100', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('101', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('102', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('103', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('77', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('81', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('84', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('116', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('117', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('118', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('119', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('120', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('69', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('70', '2');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('90', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('91', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('92', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('94', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('95', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('96', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('97', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('98', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('104', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('105', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('106', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('77', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('83', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('116', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('117', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('118', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('119', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('120', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('69', '3');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('1', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('3', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('9', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('10', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('12', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('22', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('23', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('25', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('38', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('40', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('43', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('44', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('45', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('52', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('54', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('59', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('104', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('108', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('69', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('70', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('71', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('84', '4');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('10', '5');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('11', '5');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('12', '5');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('23', '5');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('24', '5');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('25', '5');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('38', '5');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('39', '5');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('40', '5');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('52', '5');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('53', '5');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('54', '5');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('56', '5');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('60', '5');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('69', '5');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('1', '6');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('6', '6');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('10', '6');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('23', '6');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('43', '6');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('44', '6');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('45', '6');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('92', '6');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('93', '6');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('84', '6');
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ('69', '6');

CREATE TABLE `settings` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `key` varchar(255) not null, `value` longtext, `type` varchar(255) not null default 'string', `group` varchar(255) not null default 'general', `label` varchar(255), `description` longtext, `is_public` boolean not null default '0', `created_at` timestamp, `updated_at` timestamp);

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('1', 'site_name', 'أكاديمية السهم الأخضر للتدريب', 'string', 'site', 'اسم الموقع', 'اسم الموقع كما يظهر في المتصفح', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('2', 'site_description', 'أكاديمية السهم الأخضر للتدريب بمكة المكرمة - دورات تدريبية متخصصة في البرمجة والإدارة واللغات والتقنية مع أفضل المدربين', 'string', 'site', 'وصف الموقع', 'وصف الموقع للمحركات البحث', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('3', 'site_email', 'greenarrowacademic@gmail.com', 'string', 'site', 'البريد الإلكتروني', 'البريد الإلكتروني الرئيسي للموقع', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('4', 'site_phone', '0508260274', 'string', 'site', 'رقم الهاتف', 'رقم الهاتف الرئيسي', '1', '2025-08-25 12:56:25', '2025-08-25 13:48:14');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('5', 'site_whatsapp', '+966 50 826 0274', 'string', 'site', 'رقم الواتساب', 'رقم الواتساب للتواصل', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('6', 'site_address', 'مكة المكرمة - حي الخضراء - الشارع العام - مقابل قاعة البساتين للأفراح', 'string', 'site', 'العنوان', 'عنوان الموقع', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('7', 'site_working_hours', 'السبت - الخميس: 2:00 م - 10:00 م', 'string', 'site', 'ساعات العمل', 'ساعات العمل الرسمية', '1', '2025-08-25 12:56:25', '2025-08-25 13:16:02');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('8', 'site_logo', 'settings/dvFzCydftm1bjupXqupLPsxxvd1vmXJKjTQPQgW8.png', 'file', 'appearance', 'شعار الموقع', 'شعار الموقع الرئيسي', '1', '2025-08-25 12:56:25', '2025-08-25 13:33:10');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('9', 'site_logo_light', 'settings/g4pBTxsAvhck6u8eVbBxdMUeKPEp0ZGAkQxvaEd8.png', 'file', 'appearance', 'الشعار الفاتح', 'الشعار للخلفيات الداكنة', '1', '2025-08-25 12:56:25', '2025-08-25 13:33:10');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('10', 'site_favicon', 'settings/On4NugP1ykvT92OAp7R42QHnSAG2lwlM77Dja2cq.png', 'file', 'appearance', 'أيقونة الموقع', 'أيقونة الموقع في المتصفح', '1', '2025-08-25 12:56:25', '2025-08-25 13:33:10');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('11', 'site_primary_color', '#10b981', 'string', 'appearance', 'اللون الأساسي', 'اللون الأساسي للموقع', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('12', 'site_secondary_color', '#1f2937', 'string', 'appearance', 'اللون الثانوي', 'اللون الثانوي للموقع', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('13', 'site_accent_color', '#f59e0b', 'string', 'appearance', 'لون التمييز', 'لون التمييز للموقع', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('14', 'max_course_duration', '100', 'integer', 'courses', 'أقصى مدة للدورة', 'أقصى مدة للدورة بالساعات', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('15', 'max_lessons_per_course', '50', 'integer', 'courses', 'أقصى عدد للدروس', 'أقصى عدد للدروس في الدورة', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('16', 'course_approval_required', '1', 'boolean', 'courses', 'تتطلب الموافقة على الدورات', 'هل تتطلب الدورات موافقة قبل النشر', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('17', 'allow_course_preview', '1', 'boolean', 'courses', 'السماح بمعاينة الدورات', 'السماح للمستخدمين بمعاينة الدورات', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('18', 'free_courses_allowed', '1', 'boolean', 'courses', 'السماح بالدورات المجانية', 'السماح بإنشاء دورات مجانية', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('19', 'course_certificate_enabled', '1', 'boolean', 'courses', 'تفعيل شهادات الدورات', 'تفعيل إصدار شهادات إتمام الدورات', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('20', 'currency', 'SAR', 'string', 'payment', 'العملة', 'العملة الافتراضية للموقع', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('21', 'tax_rate', '15', 'integer', 'payment', 'نسبة الضريبة', 'نسبة الضريبة المطبقة', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('22', 'stripe_enabled', '1', 'boolean', 'payment', 'تفعيل Stripe', 'تفعيل بوابة الدفع Stripe', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('23', 'stripe_public_key', NULL, 'string', 'payment', 'مفتاح Stripe العام', 'المفتاح العام لـ Stripe', '0', '2025-08-25 12:56:25', '2025-08-25 13:16:02');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('24', 'stripe_secret_key', NULL, 'string', 'payment', 'مفتاح Stripe السري', 'المفتاح السري لـ Stripe', '0', '2025-08-25 12:56:25', '2025-08-25 13:16:02');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('25', 'paypal_enabled', '1', 'boolean', 'payment', 'تفعيل PayPal', 'تفعيل بوابة الدفع PayPal', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('26', 'paypal_client_id', NULL, 'string', 'payment', 'معرف PayPal', 'معرف العميل لـ PayPal', '0', '2025-08-25 12:56:25', '2025-08-25 13:16:02');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('27', 'paypal_secret', NULL, 'string', 'payment', 'مفتاح PayPal السري', 'المفتاح السري لـ PayPal', '0', '2025-08-25 12:56:25', '2025-08-25 13:16:02');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('28', 'bank_transfer_enabled', '1', 'boolean', 'payment', 'تفعيل التحويل البنكي', 'تفعيل خيار التحويل البنكي', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('29', 'bank_account_info', NULL, 'string', 'payment', 'معلومات الحساب البنكي', 'معلومات الحساب البنكي للتحويل', '0', '2025-08-25 12:56:25', '2025-08-25 13:16:02');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('30', 'mail_from_address', 'greenarrowacademic@gmail.com', 'string', 'email', 'عنوان المرسل', 'عنوان البريد الإلكتروني للمرسل', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('31', 'mail_from_name', 'أكاديمية السهم الأخضر للتدريب', 'string', 'email', 'اسم المرسل', 'اسم المرسل في البريد الإلكتروني', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('32', 'welcome_email_enabled', '1', 'boolean', 'email', 'تفعيل بريد الترحيب', 'إرسال بريد ترحيب للمستخدمين الجدد', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('33', 'course_completion_email', '1', 'boolean', 'email', 'بريد إكمال الدورة', 'إرسال بريد عند إكمال الدورة', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('34', 'payment_confirmation_email', '1', 'boolean', 'email', 'بريد تأكيد الدفع', 'إرسال بريد تأكيد الدفع', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('35', 'newsletter_enabled', '1', 'boolean', 'email', 'تفعيل النشرة الإخبارية', 'تفعيل إرسال النشرة الإخبارية', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('36', 'facebook_url', 'https://www.facebook.com/people/%D8%A3%D9%83%D8%A7%D8%AF%D9%8A%D9%85%D9%8A%D8%A9-%D8%A7%D9%84%D8%B3%D9%87%D9%85-%D8%A7%D9%84%D8%A3%D8%AE%D8%B6%D8%B1-%D9%84%D9%84%D8%AA%D8%AF%D8%B1%D9%8A%D8%A8/61571521234103/', 'string', 'social', 'رابط فيسبوك', 'رابط صفحة فيسبوك الرسمية', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('37', 'twitter_url', 'https://x.com/greenarrowac', 'string', 'social', 'رابط تويتر', 'رابط حساب تويتر الرسمي', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('38', 'instagram_url', 'https://www.instagram.com/greenarrowacademy/', 'string', 'social', 'رابط انستغرام', 'رابط حساب انستغرام الرسمي', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('39', 'youtube_url', 'https://www.youtube.com/@%D8%A3%D9%83%D8%A7%D8%AF%D9%8A%D9%85%D9%8A%D8%A9%D8%A7%D9%84%D8%B3%D9%87%D9%85%D8%A7%D9%84%D8%A3%D8%AE%D8%B6%D8%B1', 'string', 'social', 'رابط يوتيوب', 'رابط قناة يوتيوب الرسمية', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('40', 'linkedin_url', 'https://www.linkedin.com/company/%D8%B4%D8%B1%D9%83%D8%A9-%D8%A3%D9%83%D8%A7%D8%AF%D9%8A%D9%85%D9%8A%D8%A9-%D8%A7%D9%84%D8%B3%D9%87%D9%85-%D8%A7%D9%84%D8%A7%D8%AE%D8%B6%D8%B1-%D9%84%D9%84%D8%AA%D8%AF/', 'string', 'social', 'رابط لينكد إن', 'رابط صفحة لينكد إن الرسمية', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('41', 'tiktok_url', 'https://www.tiktok.com/@green.arrow645', 'string', 'social', 'رابط تيك توك', 'رابط حساب تيك توك الرسمي', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('42', 'telegram_url', 'https://t.me/greenarrowac', 'string', 'social', 'رابط تليجرام', 'رابط قناة تليجرام الرسمية', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('43', 'snapchat_url', 'https://www.snapchat.com/@elsahmacademic', 'string', 'social', 'رابط سناب شات', 'رابط حساب سناب شات الرسمي', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('44', 'google_maps_url', 'https://www.google.com/maps?q=%D9%85%D8%B1%D9%83%D8%B2+%D8%A3%D9%83%D8%A7%D8%AF%D9%8A%D9%85%D9%8A%D8%A9+%D8%A7%D9%84%D8%B3%D9%87%D9%85+%D8%A7%D9%84%D8%A3%D8%AE%D8%B6%D8%B1+%D9%84%D9%84%D8%AA%D8%AF%D8%B1%D9%8A%D8%A8%D8%8C+%D8%A7%D9%84%D8%B4%D8%A7%D8%B1%D8%B9+%D8%A7%D9%84%D8%B9%D8%A7%D9%85%D8%8C+%D8%A7%D9%84%D8%AE%D8%B6%D8%B1%D8%A7%D8%A1%D8%8C+%D9%85%D9%83%D8%A9+%D8%A7%D9%84%D9%85%D9%83%D8%B1%D9%85%D8%A9+-+%D8%AD%D9%8A+%D8%A7%D9%84%D8%B4%D8%B1%D8%A7%D8%A6%D8%B9%D8%8C+%D9%85%D9%83%D8%A9+24267%D8%8C+%D8%A7%D9%84%D9%85%D9%85%D9%84%D9%83%D8%A9+%D8%A7%D9%84%D8%B9%D8%B1%D8%A8%D9%8A%D8%A9+%D8%A7%D9%84%D8%B3%D8%B9%D9%88%D8%AF%D9%8A%D8%A9+%D8%A7%D9%84%D8%B3%D8%B9%D9%88%D8%AF%D9%8A%D8%A9&ftid=0x15c2018c03a08df1:0xdbdc350522e6d8d8&entry=gps&lucs=,94246480,94242508,94224825,94227247,94227248,47071704,47069508,94218641,94228354,94233079,94203019,47084304,94208458,94208447&g_ep=CAISEjI0LjUwLjAuNzA0NDI3ODkxMBgAINeCAyp-LDk0MjQ2NDgwLDk0MjQyNTA4LDk0MjI0ODI1LDk0MjI3MjQ3LDk0MjI3MjQ4LDQ3MDcxNzA0LDQ3MDY5NTA4LDk0MjE4NjQxLDk0MjI4MzU0LDk0MjMzMDc5LDk0MjAzMDE5LDQ3MDg0MzA0LDk0MjA4NDU4LDk0MjA4NDQ3QgJFRw%3D%3D&g_st=com.google.maps.preview.copy', 'string', 'social', 'رابط خرائط جوجل', 'رابط موقع الأكاديمية على خرائط جوجل', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('45', 'site_title', 'أكاديمية السهم الأخضر للتدريب - مكة المكرمة', 'string', 'seo', 'عنوان الموقع', 'عنوان الموقع للمحركات البحث', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('46', 'site_keywords', 'أكاديمية السهم الأخضر, تدريب, دورات, برمجة, إدارة, لغات, تقنية, مكة المكرمة, السعودية', 'string', 'seo', 'كلمات مفتاحية', 'الكلمات المفتاحية للموقع', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('47', 'site_author', 'أكاديمية السهم الأخضر للتدريب', 'string', 'seo', 'مؤلف الموقع', 'مؤلف الموقع', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('48', 'og_title', 'أكاديمية السهم الأخضر للتدريب - مكة المكرمة', 'string', 'seo', 'عنوان Open Graph', 'عنوان المشاركة في وسائل التواصل', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('49', 'og_description', 'أكاديمية السهم الأخضر للتدريب بمكة المكرمة - دورات تدريبية متخصصة في البرمجة والإدارة واللغات والتقنية مع أفضل المدربين', 'string', 'seo', 'وصف Open Graph', 'وصف المشاركة في وسائل التواصل', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('50', 'og_image', NULL, 'file', 'seo', 'صورة Open Graph', 'صورة المشاركة في وسائل التواصل', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('51', 'twitter_card', 'summary_large_image', 'string', 'seo', 'نوع بطاقة تويتر', 'نوع بطاقة المشاركة في تويتر', '1', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('52', 'google_analytics', NULL, 'string', 'seo', 'رمز Google Analytics', 'رمز تتبع Google Analytics', '0', '2025-08-25 12:56:25', '2025-08-25 13:16:02');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('53', 'google_search_console', NULL, 'string', 'seo', 'رمز Google Search Console', 'رمز التحقق من Google Search Console', '0', '2025-08-25 12:56:25', '2025-08-25 13:16:02');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('54', 'bing_webmaster', NULL, 'string', 'seo', 'رمز Bing Webmaster', 'رمز التحقق من Bing Webmaster', '0', '2025-08-25 12:56:25', '2025-08-25 13:16:02');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('55', 'maintenance_mode', '0', 'boolean', 'system', 'وضع الصيانة', 'تفعيل وضع الصيانة للموقع', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('56', 'maintenance_message', 'نعتذر، الموقع قيد الصيانة حالياً. يرجى المحاولة لاحقاً.', 'string', 'system', 'رسالة الصيانة', 'الرسالة المعروضة في وضع الصيانة', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('57', 'user_registration_enabled', '1', 'boolean', 'system', 'تفعيل التسجيل', 'السماح للمستخدمين الجدد بالتسجيل', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('58', 'email_verification_required', '1', 'boolean', 'system', 'تأكيد البريد الإلكتروني', 'تطلب تأكيد البريد الإلكتروني', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('59', 'max_file_upload_size', '10', 'integer', 'system', 'أقصى حجم للملفات', 'أقصى حجم للملفات المرفوعة بالميجابايت', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('60', 'allowed_file_types', 'jpg,jpeg,png,gif,pdf,doc,docx,mp4,mov,avi', 'string', 'system', 'أنواع الملفات المسموحة', 'أنواع الملفات المسموح برفعها', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('61', 'session_timeout', '120', 'integer', 'system', 'مهلة الجلسة', 'مهلة الجلسة بالدقائق', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('62', 'password_min_length', '8', 'integer', 'system', 'أقل طول لكلمة المرور', 'أقل طول مطلوب لكلمة المرور', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('63', 'password_require_special', '1', 'boolean', 'system', 'تطلب رموز خاصة', 'تطلب كلمة المرور رموز خاصة', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('64', 'email_notifications_enabled', '1', 'boolean', 'notifications', 'تفعيل إشعارات البريد', 'تفعيل إرسال الإشعارات عبر البريد', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('65', 'sms_notifications_enabled', '0', 'boolean', 'notifications', 'تفعيل إشعارات SMS', 'تفعيل إرسال الإشعارات عبر SMS', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('66', 'push_notifications_enabled', '1', 'boolean', 'notifications', 'تفعيل الإشعارات الفورية', 'تفعيل الإشعارات الفورية في المتصفح', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('67', 'new_course_notification', '1', 'boolean', 'notifications', 'إشعارات الدورات الجديدة', 'إرسال إشعارات عند إضافة دورات جديدة', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('68', 'course_update_notification', '1', 'boolean', 'notifications', 'إشعارات تحديث الدورات', 'إرسال إشعارات عند تحديث الدورات', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES ('69', 'payment_notification', '1', 'boolean', 'notifications', 'إشعارات المدفوعات', 'إرسال إشعارات عند إتمام المدفوعات', '0', '2025-08-25 12:56:25', '2025-08-25 12:56:25');

CREATE TABLE `quiz_questions` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `quiz_id` int(11) not null, `question_ar` varchar(255) not null, `question_en` varchar(255), `type` varchar(255) ) not null default 'multiple_choice', `options` longtext, `correct_answer` varchar(255), `explanation_ar` longtext, `explanation_en` longtext, `points` int(11) not null default '1', `sort_order` int(11) not null default '0', `is_active` boolean not null default '1', `created_at` timestamp, `updated_at` timestamp, foreign key(`quiz_id`) references `quizzes`(`id`) on delete cascade);

INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_ar`, `question_en`, `type`, `options`, `correct_answer`, `explanation_ar`, `explanation_en`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('1', '2', 'ما هو الفرق الرئيسي بين القائد والمدير؟', NULL, 'multiple_choice', '[\"\\u0627\\u0644\\u0642\\u0627\\u0626\\u062f \\u064a\\u0631\\u0643\\u0632 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0623\\u0647\\u062f\\u0627\\u0641\\u060c \\u0627\\u0644\\u0645\\u062f\\u064a\\u0631 \\u064a\\u0631\\u0643\\u0632 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0645\\u0647\\u0627\\u0645\",\"\\u0644\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0641\\u0631\\u0642 \\u0628\\u064a\\u0646\\u0647\\u0645\\u0627\",\"\\u0627\\u0644\\u0642\\u0627\\u0626\\u062f \\u064a\\u062a\\u0628\\u0639 \\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645\\u0627\\u062a\\u060c \\u0627\\u0644\\u0645\\u062f\\u064a\\u0631 \\u064a\\u0639\\u0637\\u064a \\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645\\u0627\\u062a\",\"\\u0627\\u0644\\u0645\\u062f\\u064a\\u0631 \\u0623\\u0643\\u062b\\u0631 \\u0623\\u0647\\u0645\\u064a\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0642\\u0627\\u0626\\u062f\"]', 'القائد يركز على الأهداف، المدير يركز على المهام', NULL, NULL, '10', '1', '1', '2025-08-25 17:54:23', '2025-08-25 17:54:23');
INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_ar`, `question_en`, `type`, `options`, `correct_answer`, `explanation_ar`, `explanation_en`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('2', '2', 'أي من التالي يعتبر من خصائص القيادة الفعالة؟', NULL, 'multiple_choice', '[\"\\u0627\\u0644\\u062a\\u062d\\u0643\\u0645 \\u0627\\u0644\\u0645\\u0637\\u0644\\u0642 \\u0641\\u064a \\u062c\\u0645\\u064a\\u0639 \\u0627\\u0644\\u0642\\u0631\\u0627\\u0631\\u0627\\u062a\",\"\\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0641\\u0639\\u0627\\u0644 \\u0645\\u0639 \\u0627\\u0644\\u0641\\u0631\\u064a\\u0642\",\"\\u062a\\u062c\\u0627\\u0647\\u0644 \\u0622\\u0631\\u0627\\u0621 \\u0627\\u0644\\u0622\\u062e\\u0631\\u064a\\u0646\",\"\\u0627\\u0644\\u0639\\u0645\\u0644 \\u0627\\u0644\\u0641\\u0631\\u062f\\u064a \\u0641\\u0642\\u0637\"]', 'التواصل الفعال مع الفريق', NULL, NULL, '10', '1', '1', '2025-08-25 17:54:23', '2025-08-25 17:54:23');
INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_ar`, `question_en`, `type`, `options`, `correct_answer`, `explanation_ar`, `explanation_en`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('3', '2', 'ما هي أهمية القيادة في المنظمات الحديثة؟', NULL, 'multiple_choice', '[\"\\u0644\\u0627 \\u0623\\u0647\\u0645\\u064a\\u0629 \\u0644\\u0647\\u0627\",\"\\u062a\\u0633\\u0627\\u0639\\u062f \\u0641\\u064a \\u062a\\u062d\\u0642\\u064a\\u0642 \\u0627\\u0644\\u0623\\u0647\\u062f\\u0627\\u0641 \\u0648\\u062a\\u0637\\u0648\\u064a\\u0631 \\u0627\\u0644\\u0641\\u0631\\u064a\\u0642\",\"\\u062a\\u0632\\u064a\\u062f \\u0645\\u0646 \\u0627\\u0644\\u0628\\u064a\\u0631\\u0648\\u0642\\u0631\\u0627\\u0637\\u064a\\u0629 \\u0641\\u0642\\u0637\",\"\\u062a\\u0642\\u0644\\u0644 \\u0645\\u0646 \\u0627\\u0644\\u0625\\u0646\\u062a\\u0627\\u062c\\u064a\\u0629\"]', 'تساعد في تحقيق الأهداف وتطوير الفريق', NULL, NULL, '10', '1', '1', '2025-08-25 17:54:23', '2025-08-25 17:54:23');
INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_ar`, `question_en`, `type`, `options`, `correct_answer`, `explanation_ar`, `explanation_en`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('4', '3', 'أي نمط قيادة يتيح للموظفين المشاركة في اتخاذ القرارات؟', NULL, 'multiple_choice', '[\"\\u0627\\u0644\\u0642\\u064a\\u0627\\u062f\\u0629 \\u0627\\u0644\\u0627\\u0633\\u062a\\u0628\\u062f\\u0627\\u062f\\u064a\\u0629\",\"\\u0627\\u0644\\u0642\\u064a\\u0627\\u062f\\u0629 \\u0627\\u0644\\u062f\\u064a\\u0645\\u0642\\u0631\\u0627\\u0637\\u064a\\u0629\",\"\\u0627\\u0644\\u0642\\u064a\\u0627\\u062f\\u0629 \\u0627\\u0644\\u062d\\u0631\\u0629\",\"\\u0627\\u0644\\u0642\\u064a\\u0627\\u062f\\u0629 \\u0627\\u0644\\u062a\\u062d\\u0648\\u064a\\u0644\\u064a\\u0629\"]', 'القيادة الديمقراطية', NULL, NULL, '10', '1', '1', '2025-08-25 17:54:23', '2025-08-25 17:54:23');
INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_ar`, `question_en`, `type`, `options`, `correct_answer`, `explanation_ar`, `explanation_en`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('5', '3', 'متى يكون نمط القيادة الاستبدادية مناسباً؟', NULL, 'multiple_choice', '[\"\\u0641\\u064a \\u062c\\u0645\\u064a\\u0639 \\u0627\\u0644\\u0645\\u0648\\u0627\\u0642\\u0641\",\"\\u0641\\u064a \\u062d\\u0627\\u0644\\u0627\\u062a \\u0627\\u0644\\u0637\\u0648\\u0627\\u0631\\u0626 \\u0648\\u0627\\u0644\\u0623\\u0632\\u0645\\u0627\\u062a\",\"\\u0641\\u064a \\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639 \\u0627\\u0644\\u0625\\u0628\\u062f\\u0627\\u0639\\u064a\\u0629\",\"\\u0641\\u064a \\u0627\\u0644\\u0641\\u0631\\u0642 \\u0627\\u0644\\u0645\\u062a\\u0645\\u0631\\u0633\\u0629\"]', 'في حالات الطوارئ والأزمات', NULL, NULL, '10', '2', '1', '2025-08-25 17:54:23', '2025-08-25 17:54:23');
INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_ar`, `question_en`, `type`, `options`, `correct_answer`, `explanation_ar`, `explanation_en`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('6', '3', 'ما هي مميزات القيادة التحويلية؟', NULL, 'multiple_choice', '[\"\\u0627\\u0644\\u062a\\u0631\\u0643\\u064a\\u0632 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0645\\u0647\\u0627\\u0645 \\u0627\\u0644\\u0631\\u0648\\u062a\\u064a\\u0646\\u064a\\u0629 \\u0641\\u0642\\u0637\",\"\\u062a\\u062d\\u0641\\u064a\\u0632 \\u0627\\u0644\\u0641\\u0631\\u064a\\u0642 \\u0648\\u062a\\u0637\\u0648\\u064a\\u0631 \\u0631\\u0624\\u064a\\u0629 \\u0645\\u0634\\u062a\\u0631\\u0643\\u0629\",\"\\u062a\\u062c\\u0627\\u0647\\u0644 \\u0645\\u0634\\u0627\\u0639\\u0631 \\u0627\\u0644\\u0645\\u0648\\u0638\\u0641\\u064a\\u0646\",\"\\u0627\\u0644\\u062a\\u0631\\u0643\\u064a\\u0632 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0623\\u0647\\u062f\\u0627\\u0641 \\u0642\\u0635\\u064a\\u0631\\u0629 \\u0627\\u0644\\u0645\\u062f\\u0649 \\u0641\\u0642\\u0637\"]', 'تحفيز الفريق وتطوير رؤية مشتركة', NULL, NULL, '10', '3', '1', '2025-08-25 17:54:23', '2025-08-25 17:54:23');
INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_ar`, `question_en`, `type`, `options`, `correct_answer`, `explanation_ar`, `explanation_en`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('7', '3', 'أي من التالي يعتبر من عيوب القيادة الحرة؟', NULL, 'multiple_choice', '[\"\\u0632\\u064a\\u0627\\u062f\\u0629 \\u0627\\u0644\\u0625\\u0628\\u062f\\u0627\\u0639\",\"\\u0639\\u062f\\u0645 \\u0648\\u0636\\u0648\\u062d \\u0627\\u0644\\u0623\\u062f\\u0648\\u0627\\u0631 \\u0648\\u0627\\u0644\\u0645\\u0633\\u0624\\u0648\\u0644\\u064a\\u0627\\u062a\",\"\\u062a\\u062d\\u0633\\u064a\\u0646 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644\",\"\\u0632\\u064a\\u0627\\u062f\\u0629 \\u0627\\u0644\\u0625\\u0646\\u062a\\u0627\\u062c\\u064a\\u0629\"]', 'عدم وضوح الأدوار والمسؤوليات', NULL, NULL, '10', '4', '1', '2025-08-25 17:54:23', '2025-08-25 17:54:23');
INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_ar`, `question_en`, `type`, `options`, `correct_answer`, `explanation_ar`, `explanation_en`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('8', '4', 'ما هي المراحل الخمس لتطور الفريق؟', NULL, 'multiple_choice', '[\"\\u0627\\u0644\\u062a\\u0634\\u0643\\u064a\\u0644\\u060c \\u0627\\u0644\\u0639\\u0635\\u0641 \\u0627\\u0644\\u0630\\u0647\\u0646\\u064a\\u060c \\u0627\\u0644\\u0645\\u0639\\u0627\\u064a\\u064a\\u0631\\u060c \\u0627\\u0644\\u0623\\u062f\\u0627\\u0621\\u060c \\u0627\\u0644\\u0625\\u0646\\u0647\\u0627\\u0621\",\"\\u0627\\u0644\\u062a\\u062e\\u0637\\u064a\\u0637\\u060c \\u0627\\u0644\\u062a\\u0646\\u0641\\u064a\\u0630\\u060c \\u0627\\u0644\\u0645\\u0631\\u0627\\u0642\\u0628\\u0629\\u060c \\u0627\\u0644\\u062a\\u0642\\u064a\\u064a\\u0645\\u060c \\u0627\\u0644\\u0625\\u063a\\u0644\\u0627\\u0642\",\"\\u0627\\u0644\\u0628\\u062f\\u0627\\u064a\\u0629\\u060c \\u0627\\u0644\\u0648\\u0633\\u0637\\u060c \\u0627\\u0644\\u0646\\u0647\\u0627\\u064a\\u0629\",\"\\u0644\\u0627 \\u062a\\u0648\\u062c\\u062f \\u0645\\u0631\\u0627\\u062d\\u0644 \\u0645\\u062d\\u062f\\u062f\\u0629\"]', 'التشكيل، العصف الذهني، المعايير، الأداء، الإنهاء', NULL, NULL, '12.5', '1', '1', '2025-08-25 17:54:23', '2025-08-25 17:54:23');
INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_ar`, `question_en`, `type`, `options`, `correct_answer`, `explanation_ar`, `explanation_en`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('9', '4', 'أي من التالي يعتبر من مهارات التواصل القيادي؟', NULL, 'multiple_choice', '[\"\\u0627\\u0644\\u0627\\u0633\\u062a\\u0645\\u0627\\u0639 \\u0627\\u0644\\u0646\\u0634\\u0637 \\u0641\\u0642\\u0637\",\"\\u062a\\u0642\\u062f\\u064a\\u0645 \\u0627\\u0644\\u062a\\u063a\\u0630\\u064a\\u0629 \\u0627\\u0644\\u0631\\u0627\\u062c\\u0639\\u0629 \\u0641\\u0642\\u0637\",\"\\u0627\\u0644\\u0627\\u0633\\u062a\\u0645\\u0627\\u0639 \\u0627\\u0644\\u0646\\u0634\\u0637\\u060c \\u062a\\u0642\\u062f\\u064a\\u0645 \\u0627\\u0644\\u062a\\u063a\\u0630\\u064a\\u0629 \\u0627\\u0644\\u0631\\u0627\\u062c\\u0639\\u0629\\u060c \\u0648\\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0641\\u0639\\u0627\\u0644\",\"\\u0627\\u0644\\u062a\\u062d\\u062f\\u062b \\u0641\\u0642\\u0637\"]', 'الاستماع النشط، تقديم التغذية الراجعة، والتواصل الفعال', NULL, NULL, '12.5', '2', '1', '2025-08-25 17:54:23', '2025-08-25 17:54:23');
INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_ar`, `question_en`, `type`, `options`, `correct_answer`, `explanation_ar`, `explanation_en`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('10', '4', 'ما هي نظرية التحفيز التي تركز على الاحتياجات الأساسية؟', NULL, 'multiple_choice', '[\"\\u0646\\u0638\\u0631\\u064a\\u0629 \\u0645\\u0627\\u0633\\u0644\\u0648 \\u0644\\u0644\\u0627\\u062d\\u062a\\u064a\\u0627\\u062c\\u0627\\u062a\",\"\\u0646\\u0638\\u0631\\u064a\\u0629 \\u0627\\u0644\\u062a\\u0648\\u0642\\u0639\",\"\\u0646\\u0638\\u0631\\u064a\\u0629 \\u0627\\u0644\\u0639\\u062f\\u0627\\u0644\\u0629\",\"\\u0646\\u0638\\u0631\\u064a\\u0629 \\u0627\\u0644\\u062a\\u0639\\u0632\\u064a\\u0632\"]', 'نظرية ماسلو للاحتياجات', NULL, NULL, '12.5', '3', '1', '2025-08-25 17:54:23', '2025-08-25 17:54:23');
INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_ar`, `question_en`, `type`, `options`, `correct_answer`, `explanation_ar`, `explanation_en`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('11', '4', 'ما هي الخطوات الخمس لحل المشكلات؟', NULL, 'multiple_choice', '[\"\\u062a\\u062d\\u062f\\u064a\\u062f \\u0627\\u0644\\u0645\\u0634\\u0643\\u0644\\u0629\\u060c \\u062a\\u062d\\u0644\\u064a\\u0644\\u0647\\u0627\\u060c \\u062a\\u0637\\u0648\\u064a\\u0631 \\u0627\\u0644\\u062d\\u0644\\u0648\\u0644\\u060c \\u062a\\u0646\\u0641\\u064a\\u0630 \\u0627\\u0644\\u062d\\u0644\\u060c \\u062a\\u0642\\u064a\\u064a\\u0645 \\u0627\\u0644\\u0646\\u062a\\u0627\\u0626\\u062c\",\"\\u062a\\u062c\\u0627\\u0647\\u0644 \\u0627\\u0644\\u0645\\u0634\\u0643\\u0644\\u0629\\u060c \\u0627\\u0644\\u0627\\u0646\\u062a\\u0638\\u0627\\u0631\\u060c \\u0627\\u0644\\u062d\\u0644 \\u0627\\u0644\\u062a\\u0644\\u0642\\u0627\\u0626\\u064a\",\"\\u0627\\u0644\\u062a\\u0633\\u0631\\u0639 \\u0641\\u064a \\u0627\\u0644\\u062d\\u0644\\u060c \\u0627\\u0644\\u062a\\u0646\\u0641\\u064a\\u0630\\u060c \\u0627\\u0644\\u0646\\u0633\\u064a\\u0627\\u0646\",\"\\u0644\\u0627 \\u062a\\u0648\\u062c\\u062f \\u062e\\u0637\\u0648\\u0627\\u062a \\u0645\\u062d\\u062f\\u062f\\u0629\"]', 'تحديد المشكلة، تحليلها، تطوير الحلول، تنفيذ الحل، تقييم النتائج', NULL, NULL, '12.5', '4', '1', '2025-08-25 17:54:23', '2025-08-25 17:54:23');
INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_ar`, `question_en`, `type`, `options`, `correct_answer`, `explanation_ar`, `explanation_en`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('12', '4', 'ما هو الذكاء العاطفي في القيادة؟', NULL, 'multiple_choice', '[\"\\u0627\\u0644\\u0642\\u062f\\u0631\\u0629 \\u0639\\u0644\\u0649 \\u0641\\u0647\\u0645 \\u0648\\u0625\\u062f\\u0627\\u0631\\u0629 \\u0627\\u0644\\u0645\\u0634\\u0627\\u0639\\u0631 \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\\u0629 \\u0648\\u0645\\u0634\\u0627\\u0639\\u0631 \\u0627\\u0644\\u0622\\u062e\\u0631\\u064a\\u0646\",\"\\u0627\\u0644\\u0630\\u0643\\u0627\\u0621 \\u0627\\u0644\\u0623\\u0643\\u0627\\u062f\\u064a\\u0645\\u064a \\u0641\\u0642\\u0637\",\"\\u0627\\u0644\\u0645\\u0647\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u062a\\u0642\\u0646\\u064a\\u0629\",\"\\u0627\\u0644\\u062e\\u0628\\u0631\\u0629 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629\"]', 'القدرة على فهم وإدارة المشاعر الشخصية ومشاعر الآخرين', NULL, NULL, '12.5', '5', '1', '2025-08-25 17:54:23', '2025-08-25 17:54:23');
INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_ar`, `question_en`, `type`, `options`, `correct_answer`, `explanation_ar`, `explanation_en`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('13', '4', 'ما هي استراتيجية إدارة التغيير الفعالة؟', NULL, 'multiple_choice', '[\"\\u062a\\u062c\\u0627\\u0647\\u0644 \\u0645\\u0642\\u0627\\u0648\\u0645\\u0629 \\u0627\\u0644\\u062a\\u063a\\u064a\\u064a\\u0631\",\"\\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0648\\u0627\\u0636\\u062d\\u060c \\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u0643\\u0629\\u060c \\u0627\\u0644\\u062a\\u062f\\u0631\\u064a\\u0628\\u060c \\u0627\\u0644\\u062f\\u0639\\u0645 \\u0627\\u0644\\u0645\\u0633\\u062a\\u0645\\u0631\",\"\\u0627\\u0644\\u0625\\u062c\\u0628\\u0627\\u0631 \\u0641\\u0642\\u0637\",\"\\u0627\\u0644\\u0627\\u0646\\u062a\\u0638\\u0627\\u0631 \\u062d\\u062a\\u0649 \\u064a\\u062d\\u062f\\u062b \\u0627\\u0644\\u062a\\u063a\\u064a\\u064a\\u0631 \\u062a\\u0644\\u0642\\u0627\\u0626\\u064a\\u0627\\u064b\"]', 'التواصل الواضح، المشاركة، التدريب، الدعم المستمر', NULL, NULL, '12.5', '6', '1', '2025-08-25 17:54:23', '2025-08-25 17:54:23');
INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_ar`, `question_en`, `type`, `options`, `correct_answer`, `explanation_ar`, `explanation_en`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('14', '4', 'ما هي عناصر التخطيط الاستراتيجي؟', NULL, 'multiple_choice', '[\"\\u0627\\u0644\\u0631\\u0624\\u064a\\u0629\\u060c \\u0627\\u0644\\u0631\\u0633\\u0627\\u0644\\u0629\\u060c \\u0627\\u0644\\u0623\\u0647\\u062f\\u0627\\u0641\\u060c \\u0627\\u0644\\u0627\\u0633\\u062a\\u0631\\u0627\\u062a\\u064a\\u062c\\u064a\\u0627\\u062a\\u060c \\u0627\\u0644\\u062a\\u0646\\u0641\\u064a\\u0630\",\"\\u0627\\u0644\\u062a\\u062e\\u0637\\u064a\\u0637 \\u0627\\u0644\\u064a\\u0648\\u0645\\u064a \\u0641\\u0642\\u0637\",\"\\u0627\\u0644\\u0623\\u0647\\u062f\\u0627\\u0641 \\u0642\\u0635\\u064a\\u0631\\u0629 \\u0627\\u0644\\u0645\\u062f\\u0649 \\u0641\\u0642\\u0637\",\"\\u0644\\u0627 \\u062a\\u0648\\u062c\\u062f \\u0639\\u0646\\u0627\\u0635\\u0631 \\u0645\\u062d\\u062f\\u062f\\u0629\"]', 'الرؤية، الرسالة، الأهداف، الاستراتيجيات، التنفيذ', NULL, NULL, '12.5', '7', '1', '2025-08-25 17:54:23', '2025-08-25 17:54:23');
INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_ar`, `question_en`, `type`, `options`, `correct_answer`, `explanation_ar`, `explanation_en`, `points`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES ('15', '4', 'ما هي فوائد إدارة الوقت الفعالة؟', NULL, 'multiple_choice', '[\"\\u0632\\u064a\\u0627\\u062f\\u0629 \\u0627\\u0644\\u0625\\u0646\\u062a\\u0627\\u062c\\u064a\\u0629\\u060c \\u062a\\u0642\\u0644\\u064a\\u0644 \\u0627\\u0644\\u062a\\u0648\\u062a\\u0631\\u060c \\u062a\\u062d\\u0633\\u064a\\u0646 \\u062c\\u0648\\u062f\\u0629 \\u0627\\u0644\\u0639\\u0645\\u0644\",\"\\u0632\\u064a\\u0627\\u062f\\u0629 \\u0633\\u0627\\u0639\\u0627\\u062a \\u0627\\u0644\\u0639\\u0645\\u0644 \\u0641\\u0642\\u0637\",\"\\u062a\\u0642\\u0644\\u064a\\u0644 \\u0627\\u0644\\u0631\\u0627\\u062d\\u0629\",\"\\u0644\\u0627 \\u062a\\u0648\\u062c\\u062f \\u0641\\u0648\\u0627\\u0626\\u062f\"]', 'زيادة الإنتاجية، تقليل التوتر، تحسين جودة العمل', NULL, NULL, '12.5', '8', '1', '2025-08-25 17:54:24', '2025-08-25 17:54:24');

CREATE TABLE `quiz_attempts` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `quiz_id` int(11) not null, `user_id` int(11) not null, `attempt_number` int(11) not null default '1', `started_at` timestamp not null, `completed_at` timestamp, `score` int(11) not null default '0', `total_points` int(11) not null default '0', `percentage` numeric not null default '0', `is_passed` boolean not null default '0', `answers` longtext, `notes` longtext, `created_at` timestamp, `updated_at` timestamp, foreign key(`quiz_id`) references `quizzes`(`id`) on delete cascade, foreign key(`user_id`) references `users`(`id`) on delete cascade);

INSERT INTO `quiz_attempts` (`id`, `quiz_id`, `user_id`, `attempt_number`, `started_at`, `completed_at`, `score`, `total_points`, `percentage`, `is_passed`, `answers`, `notes`, `created_at`, `updated_at`) VALUES ('1', '5', '33', '1', '2025-08-23 16:07:39', '2025-08-23 16:32:39', '85', '100', '85', '1', NULL, NULL, '2025-08-26 16:07:39', '2025-08-26 16:07:39');

CREATE TABLE `contact_messages` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `name` varchar(255) not null, `email` varchar(255) not null, `phone` varchar(255), `subject` varchar(255) not null, `message` longtext not null, `status` varchar(255) ) not null default 'new', `admin_notes` longtext, `read_at` timestamp, `replied_at` timestamp, `created_at` timestamp, `updated_at` timestamp);

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `status`, `admin_notes`, `read_at`, `replied_at`, `created_at`, `updated_at`) VALUES ('1', 'khaled ahmed', 'khaledahmedhaggagy@gmail.com', '01010254819', 'شكوى', 'هاى', 'read', NULL, '2025-08-24 18:19:18', NULL, '2025-08-24 18:19:05', '2025-08-24 18:19:18');

CREATE TABLE `user_settings` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `user_id` int(11) not null, `key` varchar(255) not null, `value` longtext not null, `created_at` timestamp, `updated_at` timestamp, foreign key(`user_id`) references `users`(`id`) on delete cascade);

INSERT INTO `user_settings` (`id`, `user_id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('1', '11', 'notification_preferences', '\"{\\\"email\\\":\\\"1\\\",\\\"new_course\\\":\\\"1\\\",\\\"lesson_reminder\\\":\\\"1\\\",\\\"quiz_reminder\\\":\\\"1\\\"}\"', '2025-08-25 11:57:16', '2025-08-25 11:57:16');

CREATE TABLE `lesson_completions` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `enrollment_id` int(11) not null, `lesson_id` int(11) not null, `user_id` int(11) not null, `completed_at` timestamp not null, `time_spent_minutes` int(11), `progress_percentage` numeric not null default '0', `quiz_results` longtext, `created_at` timestamp, `updated_at` timestamp, foreign key(`enrollment_id`) references `enrollments`(`id`) on delete cascade, foreign key(`lesson_id`) references `lessons`(`id`) on delete cascade, foreign key(`user_id`) references `users`(`id`) on delete cascade);

INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('1', '1', '1', '12', '2025-08-21 07:57:03', '44', '100', NULL, '2025-08-26 07:57:03', '2025-08-26 07:57:03');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('2', '1', '2', '12', '2025-08-23 07:57:03', '17', '100', NULL, '2025-08-26 07:57:03', '2025-08-26 07:57:03');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('3', '1', '3', '12', '2025-08-22 07:57:03', '21', '100', NULL, '2025-08-26 07:57:03', '2025-08-26 07:57:03');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('4', '1', '4', '12', '2025-08-22 07:57:03', '33', '100', NULL, '2025-08-26 07:57:03', '2025-08-26 07:57:03');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('5', '1', '5', '12', '2025-08-23 07:57:03', '42', '100', NULL, '2025-08-26 07:57:03', '2025-08-26 07:57:03');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('6', '2', '16', '33', '2025-08-18 16:07:25', '30', '0', NULL, '2025-08-26 16:07:25', '2025-08-26 16:07:25');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('7', '2', '17', '33', '2025-08-21 16:07:25', '45', '0', NULL, '2025-08-26 16:07:25', '2025-08-26 16:07:25');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('8', '1', '15', '12', '2025-08-26 17:38:57', '0', '100', NULL, '2025-08-26 17:38:57', '2025-08-26 17:38:57');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('9', '1', '14', '12', '2025-08-26 17:39:07', '0', '100', NULL, '2025-08-26 17:39:07', '2025-08-26 17:39:07');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('10', '1', '6', '12', '2025-08-26 17:39:17', '0', '100', NULL, '2025-08-26 17:39:17', '2025-08-26 17:39:17');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('11', '1', '7', '12', '2025-08-26 17:39:26', '0', '100', NULL, '2025-08-26 17:39:26', '2025-08-26 17:39:26');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('12', '1', '8', '12', '2025-08-26 17:39:33', '0', '100', NULL, '2025-08-26 17:39:33', '2025-08-26 17:39:33');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('13', '1', '11', '12', '2025-08-26 17:39:40', '0', '100', NULL, '2025-08-26 17:39:40', '2025-08-26 17:39:40');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('14', '1', '13', '12', '2025-08-26 17:39:54', '0', '100', NULL, '2025-08-26 17:39:54', '2025-08-26 17:39:54');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('15', '1', '10', '12', '2025-08-26 17:40:09', '0', '100', NULL, '2025-08-26 17:40:09', '2025-08-26 17:40:09');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('16', '1', '9', '12', '2025-08-26 17:40:16', '0', '100', NULL, '2025-08-26 17:40:16', '2025-08-26 17:40:16');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('17', '6', '19', '37', '2025-08-26 17:49:05', NULL, '0', NULL, '2025-08-26 17:49:05', '2025-08-26 17:49:05');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('18', '6', '20', '37', '2025-08-26 17:49:05', NULL, '0', NULL, '2025-08-26 17:49:05', '2025-08-26 17:49:05');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('19', '6', '21', '37', '2025-08-26 17:49:05', NULL, '0', NULL, '2025-08-26 17:49:05', '2025-08-26 17:49:05');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('20', '6', '22', '37', '2025-08-26 17:49:05', NULL, '0', NULL, '2025-08-26 17:49:05', '2025-08-26 17:49:05');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('21', '6', '23', '37', '2025-08-26 17:49:05', NULL, '0', NULL, '2025-08-26 17:49:05', '2025-08-26 17:49:05');
INSERT INTO `lesson_completions` (`id`, `enrollment_id`, `lesson_id`, `user_id`, `completed_at`, `time_spent_minutes`, `progress_percentage`, `quiz_results`, `created_at`, `updated_at`) VALUES ('22', '1', '12', '12', '2025-08-26 17:52:20', '0', '100', NULL, '2025-08-26 17:52:20', '2025-08-26 17:52:20');

CREATE TABLE `course_resources` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `course_id` int(11) not null, `lesson_id` int(11), `title_ar` varchar(255) not null, `title_en` varchar(255), `description_ar` longtext, `description_en` longtext, `type` varchar(255) ) not null default 'document', `file_path` varchar(255), `file_name` varchar(255), `file_size` varchar(255), `external_url` varchar(255), `is_free` boolean not null default '1', `is_published` boolean not null default '1', `sort_order` int(11) not null default '0', `download_count` int(11) not null default '0', `created_at` timestamp, `updated_at` timestamp, foreign key(`course_id`) references `courses`(`id`) on delete cascade, foreign key(`lesson_id`) references `lessons`(`id`) on delete cascade);

INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('1', '1', NULL, 'ملف PDF شامل للدورة', 'Complete Course PDF', 'ملف PDF يحتوي على جميع محتويات الدورة بشكل منظم', 'A comprehensive PDF containing all course content in an organized manner', 'pdf', 'course-resources/sample-course.pdf', 'course-complete.pdf', '2048576', NULL, '1', '1', '1', '0', '2025-08-26 18:20:53', '2025-08-26 18:20:53');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('2', '1', NULL, 'ملاحظات مهمة', 'Important Notes', 'ملاحظات وتلميحات مهمة للدورة', 'Important notes and tips for the course', 'document', 'course-resources/notes.docx', 'course-notes.docx', '512000', NULL, '1', '1', '2', '0', '2025-08-26 18:20:53', '2025-08-26 18:20:53');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('3', '1', NULL, 'روابط مفيدة', 'Useful Links', 'مجموعة من الروابط المفيدة للتعلم الإضافي', 'A collection of useful links for additional learning', 'link', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', '1', '1', '3', '0', '2025-08-26 18:20:53', '2025-08-26 18:20:53');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('4', '1', '19', 'ملف PDF للدرس درس اختبار 1', 'PDF for lesson Test Lesson 1', 'ملف PDF يحتوي على محتوى الدرس درس اختبار 1', 'PDF file containing the content of lesson Test Lesson 1', 'pdf', 'course-resources/lesson-19.pdf', 'lesson-19.pdf', '1024000', NULL, '1', '1', '1', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('5', '1', '19', 'ملاحظات الدرس درس اختبار 1', 'Notes for lesson Test Lesson 1', 'ملاحظات مهمة من الدرس درس اختبار 1', 'Important notes from lesson Test Lesson 1', 'document', 'course-resources/lesson-notes-19.docx', 'lesson-notes-19.docx', '256000', NULL, '1', '1', '2', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('6', '1', '20', 'ملف PDF للدرس درس اختبار 2', 'PDF for lesson Test Lesson 2', 'ملف PDF يحتوي على محتوى الدرس درس اختبار 2', 'PDF file containing the content of lesson Test Lesson 2', 'pdf', 'course-resources/lesson-20.pdf', 'lesson-20.pdf', '1024000', NULL, '1', '1', '2', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('7', '1', '20', 'ملاحظات الدرس درس اختبار 2', 'Notes for lesson Test Lesson 2', 'ملاحظات مهمة من الدرس درس اختبار 2', 'Important notes from lesson Test Lesson 2', 'document', 'course-resources/lesson-notes-20.docx', 'lesson-notes-20.docx', '256000', NULL, '1', '1', '3', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('8', '1', '21', 'ملف PDF للدرس درس اختبار 3', 'PDF for lesson Test Lesson 3', 'ملف PDF يحتوي على محتوى الدرس درس اختبار 3', 'PDF file containing the content of lesson Test Lesson 3', 'pdf', 'course-resources/lesson-21.pdf', 'lesson-21.pdf', '1024000', NULL, '1', '1', '3', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('9', '1', '21', 'ملاحظات الدرس درس اختبار 3', 'Notes for lesson Test Lesson 3', 'ملاحظات مهمة من الدرس درس اختبار 3', 'Important notes from lesson Test Lesson 3', 'document', 'course-resources/lesson-notes-21.docx', 'lesson-notes-21.docx', '256000', NULL, '1', '1', '4', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('10', '1', NULL, 'ملف صوتي للدورة', 'Course Audio File', 'ملف صوتي يحتوي على شرح الدورة', 'Audio file containing course explanation', 'audio', 'course-resources/course-audio.mp3', 'course-audio.mp3', '52428800', NULL, '0', '1', '4', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('11', '1', NULL, 'صور توضيحية', 'Illustrative Images', 'مجموعة من الصور التوضيحية للدورة', 'A collection of illustrative images for the course', 'image', 'course-resources/images.zip', 'course-images.zip', '10485760', NULL, '1', '1', '5', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('12', '2', NULL, 'ملف PDF شامل للدورة', 'Complete Course PDF', 'ملف PDF يحتوي على جميع محتويات الدورة بشكل منظم', 'A comprehensive PDF containing all course content in an organized manner', 'pdf', 'course-resources/sample-course.pdf', 'course-complete.pdf', '2048576', NULL, '1', '1', '1', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('13', '2', NULL, 'ملاحظات مهمة', 'Important Notes', 'ملاحظات وتلميحات مهمة للدورة', 'Important notes and tips for the course', 'document', 'course-resources/notes.docx', 'course-notes.docx', '512000', NULL, '1', '1', '2', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('14', '2', NULL, 'روابط مفيدة', 'Useful Links', 'مجموعة من الروابط المفيدة للتعلم الإضافي', 'A collection of useful links for additional learning', 'link', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', '1', '1', '3', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('15', '2', '1', 'ملف PDF للدرس مقدمة في القيادة والإدارة', 'PDF for lesson ', 'ملف PDF يحتوي على محتوى الدرس مقدمة في القيادة والإدارة', 'PDF file containing the content of lesson ', 'pdf', 'course-resources/lesson-1.pdf', 'lesson-1.pdf', '1024000', NULL, '1', '1', '1', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('16', '2', '1', 'ملاحظات الدرس مقدمة في القيادة والإدارة', 'Notes for lesson ', 'ملاحظات مهمة من الدرس مقدمة في القيادة والإدارة', 'Important notes from lesson ', 'document', 'course-resources/lesson-notes-1.docx', 'lesson-notes-1.docx', '256000', NULL, '1', '1', '2', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('17', '2', '2', 'ملف PDF للدرس أنماط القيادة المختلفة', 'PDF for lesson ', 'ملف PDF يحتوي على محتوى الدرس أنماط القيادة المختلفة', 'PDF file containing the content of lesson ', 'pdf', 'course-resources/lesson-2.pdf', 'lesson-2.pdf', '1024000', NULL, '1', '1', '2', '1', '2025-08-26 18:20:54', '2025-08-26 18:25:17');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('18', '2', '2', 'ملاحظات الدرس أنماط القيادة المختلفة', 'Notes for lesson ', 'ملاحظات مهمة من الدرس أنماط القيادة المختلفة', 'Important notes from lesson ', 'document', 'course-resources/lesson-notes-2.docx', 'lesson-notes-2.docx', '256000', NULL, '1', '1', '3', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('19', '2', '3', 'ملف PDF للدرس بناء وإدارة الفرق الفعالة', 'PDF for lesson ', 'ملف PDF يحتوي على محتوى الدرس بناء وإدارة الفرق الفعالة', 'PDF file containing the content of lesson ', 'pdf', 'course-resources/lesson-3.pdf', 'lesson-3.pdf', '1024000', NULL, '1', '1', '3', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('20', '2', '3', 'ملاحظات الدرس بناء وإدارة الفرق الفعالة', 'Notes for lesson ', 'ملاحظات مهمة من الدرس بناء وإدارة الفرق الفعالة', 'Important notes from lesson ', 'document', 'course-resources/lesson-notes-3.docx', 'lesson-notes-3.docx', '256000', NULL, '1', '1', '4', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('21', '2', NULL, 'ملف صوتي للدورة', 'Course Audio File', 'ملف صوتي يحتوي على شرح الدورة', 'Audio file containing course explanation', 'audio', 'course-resources/course-audio.mp3', 'course-audio.mp3', '52428800', NULL, '0', '1', '4', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('22', '2', NULL, 'صور توضيحية', 'Illustrative Images', 'مجموعة من الصور التوضيحية للدورة', 'A collection of illustrative images for the course', 'image', 'course-resources/images.zip', 'course-images.zip', '10485760', NULL, '1', '1', '5', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('23', '3', NULL, 'ملف PDF شامل للدورة', 'Complete Course PDF', 'ملف PDF يحتوي على جميع محتويات الدورة بشكل منظم', 'A comprehensive PDF containing all course content in an organized manner', 'pdf', 'course-resources/sample-course.pdf', 'course-complete.pdf', '2048576', NULL, '1', '1', '1', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('24', '3', NULL, 'ملاحظات مهمة', 'Important Notes', 'ملاحظات وتلميحات مهمة للدورة', 'Important notes and tips for the course', 'document', 'course-resources/notes.docx', 'course-notes.docx', '512000', NULL, '1', '1', '2', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('25', '3', NULL, 'روابط مفيدة', 'Useful Links', 'مجموعة من الروابط المفيدة للتعلم الإضافي', 'A collection of useful links for additional learning', 'link', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', '1', '1', '3', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('26', '3', NULL, 'ملف صوتي للدورة', 'Course Audio File', 'ملف صوتي يحتوي على شرح الدورة', 'Audio file containing course explanation', 'audio', 'course-resources/course-audio.mp3', 'course-audio.mp3', '52428800', NULL, '0', '1', '4', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('27', '3', NULL, 'صور توضيحية', 'Illustrative Images', 'مجموعة من الصور التوضيحية للدورة', 'A collection of illustrative images for the course', 'image', 'course-resources/images.zip', 'course-images.zip', '10485760', NULL, '1', '1', '5', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('28', '4', NULL, 'ملف PDF شامل للدورة', 'Complete Course PDF', 'ملف PDF يحتوي على جميع محتويات الدورة بشكل منظم', 'A comprehensive PDF containing all course content in an organized manner', 'pdf', 'course-resources/sample-course.pdf', 'course-complete.pdf', '2048576', NULL, '1', '1', '1', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('29', '4', NULL, 'ملاحظات مهمة', 'Important Notes', 'ملاحظات وتلميحات مهمة للدورة', 'Important notes and tips for the course', 'document', 'course-resources/notes.docx', 'course-notes.docx', '512000', NULL, '1', '1', '2', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('30', '4', NULL, 'روابط مفيدة', 'Useful Links', 'مجموعة من الروابط المفيدة للتعلم الإضافي', 'A collection of useful links for additional learning', 'link', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', '1', '1', '3', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('31', '4', NULL, 'ملف صوتي للدورة', 'Course Audio File', 'ملف صوتي يحتوي على شرح الدورة', 'Audio file containing course explanation', 'audio', 'course-resources/course-audio.mp3', 'course-audio.mp3', '52428800', NULL, '0', '1', '4', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('32', '4', NULL, 'صور توضيحية', 'Illustrative Images', 'مجموعة من الصور التوضيحية للدورة', 'A collection of illustrative images for the course', 'image', 'course-resources/images.zip', 'course-images.zip', '10485760', NULL, '1', '1', '5', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('33', '5', NULL, 'ملف PDF شامل للدورة', 'Complete Course PDF', 'ملف PDF يحتوي على جميع محتويات الدورة بشكل منظم', 'A comprehensive PDF containing all course content in an organized manner', 'pdf', 'course-resources/sample-course.pdf', 'course-complete.pdf', '2048576', NULL, '1', '1', '1', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('34', '5', NULL, 'ملاحظات مهمة', 'Important Notes', 'ملاحظات وتلميحات مهمة للدورة', 'Important notes and tips for the course', 'document', 'course-resources/notes.docx', 'course-notes.docx', '512000', NULL, '1', '1', '2', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('35', '5', NULL, 'روابط مفيدة', 'Useful Links', 'مجموعة من الروابط المفيدة للتعلم الإضافي', 'A collection of useful links for additional learning', 'link', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', '1', '1', '3', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('36', '5', NULL, 'ملف صوتي للدورة', 'Course Audio File', 'ملف صوتي يحتوي على شرح الدورة', 'Audio file containing course explanation', 'audio', 'course-resources/course-audio.mp3', 'course-audio.mp3', '52428800', NULL, '0', '1', '4', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('37', '5', NULL, 'صور توضيحية', 'Illustrative Images', 'مجموعة من الصور التوضيحية للدورة', 'A collection of illustrative images for the course', 'image', 'course-resources/images.zip', 'course-images.zip', '10485760', NULL, '1', '1', '5', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('38', '6', NULL, 'ملف PDF شامل للدورة', 'Complete Course PDF', 'ملف PDF يحتوي على جميع محتويات الدورة بشكل منظم', 'A comprehensive PDF containing all course content in an organized manner', 'pdf', 'course-resources/sample-course.pdf', 'course-complete.pdf', '2048576', NULL, '1', '1', '1', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('39', '6', NULL, 'ملاحظات مهمة', 'Important Notes', 'ملاحظات وتلميحات مهمة للدورة', 'Important notes and tips for the course', 'document', 'course-resources/notes.docx', 'course-notes.docx', '512000', NULL, '1', '1', '2', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('40', '6', NULL, 'روابط مفيدة', 'Useful Links', 'مجموعة من الروابط المفيدة للتعلم الإضافي', 'A collection of useful links for additional learning', 'link', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', '1', '1', '3', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('41', '6', NULL, 'ملف صوتي للدورة', 'Course Audio File', 'ملف صوتي يحتوي على شرح الدورة', 'Audio file containing course explanation', 'audio', 'course-resources/course-audio.mp3', 'course-audio.mp3', '52428800', NULL, '0', '1', '4', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('42', '6', NULL, 'صور توضيحية', 'Illustrative Images', 'مجموعة من الصور التوضيحية للدورة', 'A collection of illustrative images for the course', 'image', 'course-resources/images.zip', 'course-images.zip', '10485760', NULL, '1', '1', '5', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('43', '7', NULL, 'ملف PDF شامل للدورة', 'Complete Course PDF', 'ملف PDF يحتوي على جميع محتويات الدورة بشكل منظم', 'A comprehensive PDF containing all course content in an organized manner', 'pdf', 'course-resources/sample-course.pdf', 'course-complete.pdf', '2048576', NULL, '1', '1', '1', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('44', '7', NULL, 'ملاحظات مهمة', 'Important Notes', 'ملاحظات وتلميحات مهمة للدورة', 'Important notes and tips for the course', 'document', 'course-resources/notes.docx', 'course-notes.docx', '512000', NULL, '1', '1', '2', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('45', '7', NULL, 'روابط مفيدة', 'Useful Links', 'مجموعة من الروابط المفيدة للتعلم الإضافي', 'A collection of useful links for additional learning', 'link', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', '1', '1', '3', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('46', '7', NULL, 'ملف صوتي للدورة', 'Course Audio File', 'ملف صوتي يحتوي على شرح الدورة', 'Audio file containing course explanation', 'audio', 'course-resources/course-audio.mp3', 'course-audio.mp3', '52428800', NULL, '0', '1', '4', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('47', '7', NULL, 'صور توضيحية', 'Illustrative Images', 'مجموعة من الصور التوضيحية للدورة', 'A collection of illustrative images for the course', 'image', 'course-resources/images.zip', 'course-images.zip', '10485760', NULL, '1', '1', '5', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('48', '8', NULL, 'ملف PDF شامل للدورة', 'Complete Course PDF', 'ملف PDF يحتوي على جميع محتويات الدورة بشكل منظم', 'A comprehensive PDF containing all course content in an organized manner', 'pdf', 'course-resources/sample-course.pdf', 'course-complete.pdf', '2048576', NULL, '1', '1', '1', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('49', '8', NULL, 'ملاحظات مهمة', 'Important Notes', 'ملاحظات وتلميحات مهمة للدورة', 'Important notes and tips for the course', 'document', 'course-resources/notes.docx', 'course-notes.docx', '512000', NULL, '1', '1', '2', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('50', '8', NULL, 'روابط مفيدة', 'Useful Links', 'مجموعة من الروابط المفيدة للتعلم الإضافي', 'A collection of useful links for additional learning', 'link', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', '1', '1', '3', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('51', '8', NULL, 'ملف صوتي للدورة', 'Course Audio File', 'ملف صوتي يحتوي على شرح الدورة', 'Audio file containing course explanation', 'audio', 'course-resources/course-audio.mp3', 'course-audio.mp3', '52428800', NULL, '0', '1', '4', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('52', '8', NULL, 'صور توضيحية', 'Illustrative Images', 'مجموعة من الصور التوضيحية للدورة', 'A collection of illustrative images for the course', 'image', 'course-resources/images.zip', 'course-images.zip', '10485760', NULL, '1', '1', '5', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('53', '9', NULL, 'ملف PDF شامل للدورة', 'Complete Course PDF', 'ملف PDF يحتوي على جميع محتويات الدورة بشكل منظم', 'A comprehensive PDF containing all course content in an organized manner', 'pdf', 'course-resources/sample-course.pdf', 'course-complete.pdf', '2048576', NULL, '1', '1', '1', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('54', '9', NULL, 'ملاحظات مهمة', 'Important Notes', 'ملاحظات وتلميحات مهمة للدورة', 'Important notes and tips for the course', 'document', 'course-resources/notes.docx', 'course-notes.docx', '512000', NULL, '1', '1', '2', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('55', '9', NULL, 'روابط مفيدة', 'Useful Links', 'مجموعة من الروابط المفيدة للتعلم الإضافي', 'A collection of useful links for additional learning', 'link', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', '1', '1', '3', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('56', '9', '16', 'ملف PDF للدرس مقدمة في البرمجة', 'PDF for lesson Introduction to Programming', 'ملف PDF يحتوي على محتوى الدرس مقدمة في البرمجة', 'PDF file containing the content of lesson Introduction to Programming', 'pdf', 'course-resources/lesson-16.pdf', 'lesson-16.pdf', '1024000', NULL, '1', '1', '1', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('57', '9', '16', 'ملاحظات الدرس مقدمة في البرمجة', 'Notes for lesson Introduction to Programming', 'ملاحظات مهمة من الدرس مقدمة في البرمجة', 'Important notes from lesson Introduction to Programming', 'document', 'course-resources/lesson-notes-16.docx', 'lesson-notes-16.docx', '256000', NULL, '1', '1', '2', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('58', '9', '17', 'ملف PDF للدرس المتغيرات والبيانات', 'PDF for lesson Variables and Data Types', 'ملف PDF يحتوي على محتوى الدرس المتغيرات والبيانات', 'PDF file containing the content of lesson Variables and Data Types', 'pdf', 'course-resources/lesson-17.pdf', 'lesson-17.pdf', '1024000', NULL, '1', '1', '2', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('59', '9', '17', 'ملاحظات الدرس المتغيرات والبيانات', 'Notes for lesson Variables and Data Types', 'ملاحظات مهمة من الدرس المتغيرات والبيانات', 'Important notes from lesson Variables and Data Types', 'document', 'course-resources/lesson-notes-17.docx', 'lesson-notes-17.docx', '256000', NULL, '1', '1', '3', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('60', '9', '18', 'ملف PDF للدرس محاضرة مباشرة - حل المشاكل', 'PDF for lesson Live Session - Problem Solving', 'ملف PDF يحتوي على محتوى الدرس محاضرة مباشرة - حل المشاكل', 'PDF file containing the content of lesson Live Session - Problem Solving', 'pdf', 'course-resources/lesson-18.pdf', 'lesson-18.pdf', '1024000', NULL, '1', '1', '3', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('61', '9', '18', 'ملاحظات الدرس محاضرة مباشرة - حل المشاكل', 'Notes for lesson Live Session - Problem Solving', 'ملاحظات مهمة من الدرس محاضرة مباشرة - حل المشاكل', 'Important notes from lesson Live Session - Problem Solving', 'document', 'course-resources/lesson-notes-18.docx', 'lesson-notes-18.docx', '256000', NULL, '1', '1', '4', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('62', '9', NULL, 'ملف صوتي للدورة', 'Course Audio File', 'ملف صوتي يحتوي على شرح الدورة', 'Audio file containing course explanation', 'audio', 'course-resources/course-audio.mp3', 'course-audio.mp3', '52428800', NULL, '0', '1', '4', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('63', '9', NULL, 'صور توضيحية', 'Illustrative Images', 'مجموعة من الصور التوضيحية للدورة', 'A collection of illustrative images for the course', 'image', 'course-resources/images.zip', 'course-images.zip', '10485760', NULL, '1', '1', '5', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('64', '10', NULL, 'ملف PDF شامل للدورة', 'Complete Course PDF', 'ملف PDF يحتوي على جميع محتويات الدورة بشكل منظم', 'A comprehensive PDF containing all course content in an organized manner', 'pdf', 'course-resources/sample-course.pdf', 'course-complete.pdf', '2048576', NULL, '1', '1', '1', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('65', '10', NULL, 'ملاحظات مهمة', 'Important Notes', 'ملاحظات وتلميحات مهمة للدورة', 'Important notes and tips for the course', 'document', 'course-resources/notes.docx', 'course-notes.docx', '512000', NULL, '1', '1', '2', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('66', '10', NULL, 'روابط مفيدة', 'Useful Links', 'مجموعة من الروابط المفيدة للتعلم الإضافي', 'A collection of useful links for additional learning', 'link', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', '1', '1', '3', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('67', '10', NULL, 'ملف صوتي للدورة', 'Course Audio File', 'ملف صوتي يحتوي على شرح الدورة', 'Audio file containing course explanation', 'audio', 'course-resources/course-audio.mp3', 'course-audio.mp3', '52428800', NULL, '0', '1', '4', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('68', '10', NULL, 'صور توضيحية', 'Illustrative Images', 'مجموعة من الصور التوضيحية للدورة', 'A collection of illustrative images for the course', 'image', 'course-resources/images.zip', 'course-images.zip', '10485760', NULL, '1', '1', '5', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('69', '11', NULL, 'ملف PDF شامل للدورة', 'Complete Course PDF', 'ملف PDF يحتوي على جميع محتويات الدورة بشكل منظم', 'A comprehensive PDF containing all course content in an organized manner', 'pdf', 'course-resources/sample-course.pdf', 'course-complete.pdf', '2048576', NULL, '1', '1', '1', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('70', '11', NULL, 'ملاحظات مهمة', 'Important Notes', 'ملاحظات وتلميحات مهمة للدورة', 'Important notes and tips for the course', 'document', 'course-resources/notes.docx', 'course-notes.docx', '512000', NULL, '1', '1', '2', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('71', '11', NULL, 'روابط مفيدة', 'Useful Links', 'مجموعة من الروابط المفيدة للتعلم الإضافي', 'A collection of useful links for additional learning', 'link', NULL, NULL, NULL, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', '1', '1', '3', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('72', '11', NULL, 'ملف صوتي للدورة', 'Course Audio File', 'ملف صوتي يحتوي على شرح الدورة', 'Audio file containing course explanation', 'audio', 'course-resources/course-audio.mp3', 'course-audio.mp3', '52428800', NULL, '0', '1', '4', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');
INSERT INTO `course_resources` (`id`, `course_id`, `lesson_id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `type`, `file_path`, `file_name`, `file_size`, `external_url`, `is_free`, `is_published`, `sort_order`, `download_count`, `created_at`, `updated_at`) VALUES ('73', '11', NULL, 'صور توضيحية', 'Illustrative Images', 'مجموعة من الصور التوضيحية للدورة', 'A collection of illustrative images for the course', 'image', 'course-resources/images.zip', 'course-images.zip', '10485760', NULL, '1', '1', '5', '0', '2025-08-26 18:20:54', '2025-08-26 18:20:54');

CREATE TABLE `messages` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY not null, `sender_id` int(11) not null, `receiver_id` int(11) not null, `course_id` int(11), `subject` varchar(255), `content` longtext not null, `type` varchar(255) ) not null default 'general', `priority` varchar(255) ) not null default 'medium', `status` varchar(255) ) not null default 'unread', `parent_id` int(11), `read_at` timestamp, `created_at` timestamp, `updated_at` timestamp, foreign key(`sender_id`) references `users`(`id`) on delete cascade, foreign key(`receiver_id`) references `users`(`id`) on delete cascade, foreign key(`course_id`) references `courses`(`id`) on delete cascade, foreign key(`parent_id`) references `messages`(`id`) on delete cascade);

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('1', '12', '34', '2', 'سؤال عن الدورة: إدارة الفرق والقيادة الفعالة', 'مرحباً، لدي سؤال حول الدرس الثالث في الدورة. هل يمكنك توضيح النقطة المتعلقة بـ...', 'course_question', 'medium', 'unread', NULL, NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('2', '12', '34', '2', 'مشكلة تقنية في الدورة', 'أواجه مشكلة في تحميل ملفات الدورة. هل يمكنك مساعدتي؟', 'technical_support', 'high', 'read', NULL, '2025-08-26 16:20:58', '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('3', '12', '34', '2', 'تقييم الدورة', 'الدورة ممتازة جداً! أحببت طريقة الشرح والتنظيم. شكراً لك', 'feedback', 'low', 'replied', NULL, NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('4', '34', '12', '2', 'رد: تقييم الدورة', 'شكراً لك على التقييم الإيجابي! يسعدني أن الدورة نالت إعجابك. إذا كان لديك أي أسئلة أخرى، لا تتردد في التواصل معي.', 'feedback', 'low', 'unread', '3', NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('5', '12', '34', '4', 'سؤال عن الدورة: مقدمة في الذكاء الاصطناعي', 'مرحباً، لدي سؤال حول الدرس الثالث في الدورة. هل يمكنك توضيح النقطة المتعلقة بـ...', 'course_question', 'medium', 'unread', NULL, NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('6', '12', '34', '4', 'مشكلة تقنية في الدورة', 'أواجه مشكلة في تحميل ملفات الدورة. هل يمكنك مساعدتي؟', 'technical_support', 'high', 'read', NULL, '2025-08-26 16:20:58', '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('7', '12', '34', '4', 'تقييم الدورة', 'الدورة ممتازة جداً! أحببت طريقة الشرح والتنظيم. شكراً لك', 'feedback', 'low', 'replied', NULL, NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('8', '34', '12', '4', 'رد: تقييم الدورة', 'شكراً لك على التقييم الإيجابي! يسعدني أن الدورة نالت إعجابك. إذا كان لديك أي أسئلة أخرى، لا تتردد في التواصل معي.', 'feedback', 'low', 'unread', '7', NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('9', '33', '34', '9', 'سؤال عن الدورة: مقدمة في البرمجة', 'مرحباً، لدي سؤال حول الدرس الثالث في الدورة. هل يمكنك توضيح النقطة المتعلقة بـ...', 'course_question', 'medium', 'unread', NULL, NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('10', '33', '34', '9', 'مشكلة تقنية في الدورة', 'أواجه مشكلة في تحميل ملفات الدورة. هل يمكنك مساعدتي؟', 'technical_support', 'high', 'read', NULL, '2025-08-26 16:20:58', '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('11', '33', '34', '9', 'تقييم الدورة', 'الدورة ممتازة جداً! أحببت طريقة الشرح والتنظيم. شكراً لك', 'feedback', 'low', 'replied', NULL, NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('12', '34', '33', '9', 'رد: تقييم الدورة', 'شكراً لك على التقييم الإيجابي! يسعدني أن الدورة نالت إعجابك. إذا كان لديك أي أسئلة أخرى، لا تتردد في التواصل معي.', 'feedback', 'low', 'unread', '11', NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('13', '33', '34', '10', 'سؤال عن الدورة: تصميم المواقع الإلكترونية', 'مرحباً، لدي سؤال حول الدرس الثالث في الدورة. هل يمكنك توضيح النقطة المتعلقة بـ...', 'course_question', 'medium', 'unread', NULL, NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('14', '33', '34', '10', 'مشكلة تقنية في الدورة', 'أواجه مشكلة في تحميل ملفات الدورة. هل يمكنك مساعدتي؟', 'technical_support', 'high', 'read', NULL, '2025-08-26 16:20:58', '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('15', '33', '34', '10', 'تقييم الدورة', 'الدورة ممتازة جداً! أحببت طريقة الشرح والتنظيم. شكراً لك', 'feedback', 'low', 'replied', NULL, NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('16', '34', '33', '10', 'رد: تقييم الدورة', 'شكراً لك على التقييم الإيجابي! يسعدني أن الدورة نالت إعجابك. إذا كان لديك أي أسئلة أخرى، لا تتردد في التواصل معي.', 'feedback', 'low', 'unread', '15', NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('17', '37', '34', '1', 'سؤال عن الدورة: تطوير المواقع باستخدام Laravel', 'مرحباً، لدي سؤال حول الدرس الثالث في الدورة. هل يمكنك توضيح النقطة المتعلقة بـ...', 'course_question', 'medium', 'unread', NULL, NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('18', '37', '34', '1', 'مشكلة تقنية في الدورة', 'أواجه مشكلة في تحميل ملفات الدورة. هل يمكنك مساعدتي؟', 'technical_support', 'high', 'read', NULL, '2025-08-26 16:20:58', '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('19', '37', '34', '1', 'تقييم الدورة', 'الدورة ممتازة جداً! أحببت طريقة الشرح والتنظيم. شكراً لك', 'feedback', 'low', 'replied', NULL, NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('20', '34', '37', '1', 'رد: تقييم الدورة', 'شكراً لك على التقييم الإيجابي! يسعدني أن الدورة نالت إعجابك. إذا كان لديك أي أسئلة أخرى، لا تتردد في التواصل معي.', 'feedback', 'low', 'unread', '19', NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('21', '11', '1', NULL, 'استفسار عام', 'أريد معرفة المزيد عن الدورات الجديدة المتاحة في الأكاديمية', 'general', 'medium', 'unread', NULL, NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('22', '12', '1', NULL, 'استفسار عام', 'أريد معرفة المزيد عن الدورات الجديدة المتاحة في الأكاديمية', 'general', 'medium', 'unread', NULL, NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('23', '13', '1', NULL, 'استفسار عام', 'أريد معرفة المزيد عن الدورات الجديدة المتاحة في الأكاديمية', 'general', 'medium', 'unread', NULL, NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('24', '34', '1', NULL, 'طلب إضافة دورة جديدة', 'أريد إضافة دورة جديدة في مجال تخصصي. هل يمكنني الحصول على الموافقة؟', 'general', 'high', 'read', NULL, '2025-08-25 18:20:58', '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('27', '11', '1', NULL, 'مشكلة عاجلة في الحساب', 'لا أستطيع الوصول لحسابي منذ الصباح. هذه مشكلة عاجلة لأن لدي اختبار اليوم', 'technical_support', 'urgent', 'unread', NULL, NULL, '2025-08-26 18:20:58', '2025-08-26 18:20:58');
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `course_id`, `subject`, `content`, `type`, `priority`, `status`, `parent_id`, `read_at`, `created_at`, `updated_at`) VALUES ('28', '12', '34', '2', 'رسالة من دورة: إدارة الفرق والقيادة الفعالة', 'مرحبا', 'general', 'urgent', 'read', NULL, '2025-08-26 18:44:11', '2025-08-26 18:21:53', '2025-08-26 18:44:11');

