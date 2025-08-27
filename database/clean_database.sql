-- Green Arrow Academy Database
-- Clean SQL file for MySQL import
-- Contains only essential table structures and migrations

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Drop existing tables if they exist
DROP TABLE IF EXISTS `migrations`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `password_reset_tokens`;
DROP TABLE IF EXISTS `sessions`;
DROP TABLE IF EXISTS `cache`;
DROP TABLE IF EXISTS `cache_locks`;
DROP TABLE IF EXISTS `jobs`;
DROP TABLE IF EXISTS `job_batches`;
DROP TABLE IF EXISTS `failed_jobs`;
DROP TABLE IF EXISTS `roles_and_permissions_tables`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `courses`;
DROP TABLE IF EXISTS `lessons`;
DROP TABLE IF EXISTS `enrollments`;
DROP TABLE IF EXISTS `payments`;
DROP TABLE IF EXISTS `quizzes`;
DROP TABLE IF EXISTS `certificates`;
DROP TABLE IF EXISTS `notifications`;
DROP TABLE IF EXISTS `blog_posts`;
DROP TABLE IF EXISTS `permissions`;
DROP TABLE IF EXISTS `roles`;
DROP TABLE IF EXISTS `model_has_permissions`;
DROP TABLE IF EXISTS `model_has_roles`;
DROP TABLE IF EXISTS `role_has_permissions`;
DROP TABLE IF EXISTS `settings`;
DROP TABLE IF EXISTS `quiz_questions`;
DROP TABLE IF EXISTS `quiz_attempts`;
DROP TABLE IF EXISTS `contact_messages`;
DROP TABLE IF EXISTS `user_settings`;
DROP TABLE IF EXISTS `lesson_completions`;
DROP TABLE IF EXISTS `course_resources`;
DROP TABLE IF EXISTS `messages`;

-- Table structure for `migrations`
CREATE TABLE `migrations` (
  `id` int(11) NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert migrations data
INSERT INTO `migrations` VALUES (20, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (21, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (22, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (23, '2025_08_24_093022_create_roles_and_permissions_tables', 1);
INSERT INTO `migrations` VALUES (24, '2025_08_24_093028_create_categories_table', 1);
INSERT INTO `migrations` VALUES (25, '2025_08_24_093029_create_courses_table', 1);
INSERT INTO `migrations` VALUES (26, '2025_08_24_093031_create_lessons_table', 1);
INSERT INTO `migrations` VALUES (27, '2025_08_24_093032_create_enrollments_table', 1);
INSERT INTO `migrations` VALUES (28, '2025_08_24_093033_create_payments_table', 1);
INSERT INTO `migrations` VALUES (29, '2025_08_24_093039_create_quizzes_table', 1);
INSERT INTO `migrations` VALUES (39, '2025_08_24_093041_create_certificates_table', 2);
INSERT INTO `migrations` VALUES (40, '2025_08_24_093043_create_notifications_table', 2);
INSERT INTO `migrations` VALUES (41, '2025_08_24_093044_create_blog_posts_table', 2);
INSERT INTO `migrations` VALUES (42, '2025_08_24_093045_add_fields_to_users_table', 2);
INSERT INTO `migrations` VALUES (43, '2025_08_24_093313_create_permission_tables', 2);
INSERT INTO `migrations` VALUES (44, '2025_08_24_123811_create_settings_table', 2);
INSERT INTO `migrations` VALUES (45, '2025_08_24_131239_create_quiz_questions_table', 2);
INSERT INTO `migrations` VALUES (46, '2025_08_24_131252_create_quiz_attempts_table', 2);
INSERT INTO `migrations` VALUES (47, '2025_08_24_133713_add_fields_to_notifications_table', 2);
INSERT INTO `migrations` VALUES (48, '2025_08_24_164044_create_contact_messages_table', 3);
INSERT INTO `migrations` VALUES (49, '2025_08_25_101325_add_total_hours_watched_to_enrollments_table', 4);
INSERT INTO `migrations` VALUES (50, '2025_08_25_114923_create_user_settings_table', 5);
INSERT INTO `migrations` VALUES (51, '2025_08_25_162659_add_payment_data_to_payments_table', 6);
INSERT INTO `migrations` VALUES (52, '2025_08_25_162759_add_activated_at_to_enrollments_table', 7);
INSERT INTO `migrations` VALUES (53, '2025_08_26_075230_create_lesson_completions_table', 8);
INSERT INTO `migrations` VALUES (54, '2025_08_26_162414_assign_all_courses_to_khalid_ahmed', 9);
INSERT INTO `migrations` VALUES (55, '2025_08_26_163347_remove_other_instructors_keep_khalid_ahmed', 10);
INSERT INTO `migrations` VALUES (56, '2025_08_26_181410_create_course_resources_table', 11);
INSERT INTO `migrations` VALUES (57, '2025_08_26_181410_create_messages_table', 11);

-- Table structure for `users`
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `bio` varchar(100) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `password_reset_tokens`
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `sessions`
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(111) NOT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `cache`
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `cache_locks`
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `jobs`
CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` text NOT NULL,
  `attempts` int(11) NOT NULL,
  `reserved_at` int(11) NOT NULL,
  `available_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `job_batches`
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` text NOT NULL,
  `options` text NOT NULL,
  `cancelled_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `failed_jobs`
CREATE TABLE `failed_jobs` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` text NOT NULL,
  `exception` text NOT NULL,
  `failed_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `roles_and_permissions_tables`
CREATE TABLE `roles_and_permissions_tables` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `categories`
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description_ar` varchar(62) NOT NULL,
  `description_en` varchar(61) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `courses`
CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description_ar` varchar(173) NOT NULL,
  `description_en` varchar(52) DEFAULT NULL,
  `objectives_ar` varchar(244) DEFAULT NULL,
  `objectives_en` text DEFAULT NULL,
  `requirements_ar` varchar(161) DEFAULT NULL,
  `requirements_en` text DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `is_free` tinyint(1) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `duration_hours` int(11) DEFAULT NULL,
  `max_students` int(11) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `intro_video` varchar(255) DEFAULT NULL,
  `level` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `certificate_enabled` tinyint(1) NOT NULL,
  `meta_title_ar` varchar(255) DEFAULT NULL,
  `meta_title_en` varchar(255) DEFAULT NULL,
  `meta_description_ar` text DEFAULT NULL,
  `meta_description_en` text DEFAULT NULL,
  `meta_keywords_ar` text DEFAULT NULL,
  `meta_keywords_en` text DEFAULT NULL,
  `enrolled_count` int(11) NOT NULL,
  `rating` decimal(3,2) NOT NULL,
  `reviews_count` int(11) NOT NULL,
  `views_count` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `lessons`
CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description_ar` varchar(108) NOT NULL,
  `description_en` varchar(29) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `video_duration` varchar(255) DEFAULT NULL,
  `pdf_file` varchar(255) DEFAULT NULL,
  `text_content` longtext DEFAULT NULL,
  `attachments` longtext DEFAULT NULL,
  `live_session_date` datetime DEFAULT NULL,
  `google_meet_link` varchar(255) DEFAULT NULL,
  `meeting_id` varchar(255) DEFAULT NULL,
  `meeting_password` varchar(255) DEFAULT NULL,
  `is_free` tinyint(1) NOT NULL,
  `is_published` tinyint(1) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `duration_minutes` int(11) NOT NULL,
  `views_count` int(11) NOT NULL,
  `completed_count` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `enrollments`
CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `enrolled_at` datetime NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `progress_percentage` int(11) NOT NULL,
  `lessons_completed` int(11) NOT NULL,
  `total_lessons` int(11) NOT NULL,
  `quiz_attempts` int(11) NOT NULL,
  `quiz_average` decimal(5,2) DEFAULT NULL,
  `live_sessions_attended` int(11) NOT NULL,
  `total_live_sessions` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `certificate_issued` tinyint(1) NOT NULL,
  `certificate_issued_at` datetime DEFAULT NULL,
  `certificate_number` varchar(255) DEFAULT NULL,
  `last_accessed_at` datetime DEFAULT NULL,
  `last_lesson_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `total_hours_watched` decimal(5,2) NOT NULL,
  `activated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `payments`
CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_gateway` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `paid_at` datetime DEFAULT NULL,
  `expires_at` datetime NOT NULL,
  `gateway_transaction_id` varchar(255) DEFAULT NULL,
  `gateway_reference` varchar(255) DEFAULT NULL,
  `gateway_response` text DEFAULT NULL,
  `billing_data` varchar(138) NOT NULL,
  `invoice_pdf` varchar(255) DEFAULT NULL,
  `refunded_amount` decimal(10,2) NOT NULL,
  `refunded_at` datetime DEFAULT NULL,
  `refund_reason` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `failure_reason` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `payment_data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `quizzes`
CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `title_ar` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `description_ar` varchar(67) NOT NULL,
  `description_en` varchar(41) DEFAULT NULL,
  `duration_minutes` int(11) NOT NULL,
  `passing_score` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `allow_retake` tinyint(1) NOT NULL,
  `max_attempts` int(11) NOT NULL,
  `show_results` tinyint(1) NOT NULL,
  `randomize_questions` tinyint(1) NOT NULL,
  `due_date` datetime DEFAULT NULL,
  `total_questions` int(11) NOT NULL,
  `total_points` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `certificates`
CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `certificate_number` varchar(255) NOT NULL,
  `issued_at` datetime NOT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `verification_code` varchar(255) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `notifications`
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(57) NOT NULL,
  `type` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `read_at` datetime DEFAULT NULL,
  `data` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `blog_posts`
CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt_ar` varchar(97) NOT NULL,
  `excerpt_en` varchar(97) NOT NULL,
  `content_ar` longtext NOT NULL,
  `content_en` longtext NOT NULL,
  `featured_image` varchar(255) NOT NULL,
  `gallery` text DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `tags` longtext NOT NULL,
  `status` varchar(255) NOT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `comments_enabled` tinyint(1) NOT NULL,
  `published_at` datetime NOT NULL,
  `meta_title_ar` varchar(255) NOT NULL,
  `meta_title_en` varchar(255) NOT NULL,
  `meta_description_ar` varchar(97) NOT NULL,
  `meta_description_en` varchar(97) NOT NULL,
  `meta_keywords_ar` varchar(69) NOT NULL,
  `meta_keywords_en` varchar(69) NOT NULL,
  `views_count` int(11) NOT NULL,
  `likes_count` int(11) NOT NULL,
  `shares_count` int(11) NOT NULL,
  `reading_time` decimal(3,1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `permissions`
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `roles`
CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `model_has_permissions`
CREATE TABLE `model_has_permissions` (
  `permission_id` int(11) NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `model_has_roles`
CREATE TABLE `model_has_roles` (
  `role_id` int(11) NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `role_has_permissions`
CREATE TABLE `role_has_permissions` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `settings`
CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` varchar(37) NOT NULL,
  `is_public` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `quiz_questions`
CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_ar` varchar(255) NOT NULL,
  `question_en` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `options` longtext NOT NULL,
  `correct_answer` varchar(255) NOT NULL,
  `explanation_ar` text DEFAULT NULL,
  `explanation_en` text DEFAULT NULL,
  `points` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `quiz_attempts`
CREATE TABLE `quiz_attempts` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attempt_number` int(11) NOT NULL,
  `started_at` datetime NOT NULL,
  `completed_at` datetime NOT NULL,
  `score` int(11) NOT NULL,
  `total_points` int(11) NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `is_passed` tinyint(1) NOT NULL,
  `answers` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `contact_messages`
CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(3) NOT NULL,
  `status` varchar(255) NOT NULL,
  `admin_notes` text DEFAULT NULL,
  `read_at` datetime NOT NULL,
  `replied_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `user_settings`
CREATE TABLE `user_settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(90) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `lesson_completions`
CREATE TABLE `lesson_completions` (
  `id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `completed_at` datetime NOT NULL,
  `time_spent_minutes` int(11) DEFAULT NULL,
  `progress_percentage` decimal(5,2) NOT NULL,
  `quiz_results` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `course_resources`
CREATE TABLE `course_resources` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `title_ar` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `description_ar` varchar(56) NOT NULL,
  `description_en` varchar(72) NOT NULL,
  `type` varchar(255) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_size` varchar(255) DEFAULT NULL,
  `external_url` varchar(255) DEFAULT NULL,
  `is_free` tinyint(1) NOT NULL,
  `is_published` tinyint(1) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `download_count` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `messages`
CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `content` varchar(113) NOT NULL,
  `type` varchar(255) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `read_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Indexes for dumped tables
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

ALTER TABLE `roles_and_permissions_tables`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `quiz_attempts`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `lesson_completions`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `course_resources`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

-- AUTO_INCREMENT for dumped tables
ALTER TABLE `migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `failed_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `roles_and_permissions_tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `quiz_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `lesson_completions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `course_resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

COMMIT; 