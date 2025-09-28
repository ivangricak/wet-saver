-- =========================
-- PostgreSQL дамп бази saver (оновлений з MySQL змін)
-- =========================

DROP SCHEMA public CASCADE;
CREATE SCHEMA public;

-- Таблиця cache
CREATE TABLE cache (
    key VARCHAR(255) PRIMARY KEY,
    value TEXT NOT NULL,
    expiration INTEGER NOT NULL
);

-- Таблиця cache_locks
CREATE TABLE cache_locks (
    key VARCHAR(255) PRIMARY KEY,
    owner VARCHAR(255) NOT NULL,
    expiration INTEGER NOT NULL
);

-- Таблиця categories
CREATE TABLE categories (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP
);

-- Таблиця users
CREATE TABLE users (
    id BIGSERIAL PRIMARY KEY,
    nick VARCHAR(255) NOT NULL,
    login VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    login_verified_at TIMESTAMP,
    remember_token VARCHAR(100),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Таблиця tags
CREATE TABLE tags (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP
);

-- Таблиця default_groups
CREATE TABLE default_groups (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    user_id BIGINT REFERENCES users(id) ON DELETE SET NULL,
    category_id BIGINT REFERENCES categories(id) ON DELETE SET NULL,
    deleted_at TIMESTAMP,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Таблиця groups
CREATE TABLE groups (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category_id BIGINT REFERENCES categories(id) ON DELETE CASCADE,
    state BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP
);

-- Таблиця items
CREATE TABLE items (
    id BIGSERIAL PRIMARY KEY,
    group_id BIGINT REFERENCES groups(id) ON DELETE SET NULL,
    default_group_id BIGINT REFERENCES default_groups(id) ON DELETE SET NULL,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255),
    link VARCHAR(255),
    state BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP
);

-- Таблиця item_tag
CREATE TABLE item_tag (
    item_id BIGINT REFERENCES items(id) ON DELETE CASCADE,
    tag_id BIGINT REFERENCES tags(id) ON DELETE CASCADE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY (item_id, tag_id)
);

-- Таблиця group_user
CREATE TABLE group_user (
    group_id BIGINT REFERENCES groups(id) ON DELETE CASCADE,
    user_id BIGINT REFERENCES users(id) ON DELETE CASCADE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY (group_id, user_id)
);

-- Таблиця failed_jobs
CREATE TABLE failed_jobs (
    id BIGSERIAL PRIMARY KEY,
    uuid VARCHAR(255) UNIQUE NOT NULL,
    connection TEXT NOT NULL,
    queue TEXT NOT NULL,
    payload TEXT NOT NULL,
    exception TEXT NOT NULL,
    failed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Таблиця jobs
CREATE TABLE jobs (
    id BIGSERIAL PRIMARY KEY,
    queue VARCHAR(255) NOT NULL,
    payload TEXT NOT NULL,
    attempts SMALLINT NOT NULL,
    reserved_at INTEGER,
    available_at INTEGER NOT NULL,
    created_at INTEGER NOT NULL
);
CREATE INDEX jobs_queue_index ON jobs(queue);

-- Таблиця job_batches
CREATE TABLE job_batches (
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    total_jobs INTEGER NOT NULL,
    pending_jobs INTEGER NOT NULL,
    failed_jobs INTEGER NOT NULL,
    failed_job_ids TEXT NOT NULL,
    options TEXT,
    cancelled_at INTEGER,
    created_at INTEGER NOT NULL,
    finished_at INTEGER
);

-- Таблиця migrations
CREATE TABLE migrations (
    id SERIAL PRIMARY KEY,
    migration VARCHAR(255) NOT NULL,
    batch INTEGER NOT NULL
);

-- Таблиця password_reset_tokens
CREATE TABLE password_reset_tokens (
    login VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP
);

-- Таблиця sessions
CREATE TABLE sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT REFERENCES users(id),
    ip_address VARCHAR(45),
    user_agent TEXT,
    payload TEXT NOT NULL,
    last_activity INTEGER
);

-- =========================
-- Вставка даних
-- =========================

-- Categories
INSERT INTO categories (id, name, created_at, updated_at, deleted_at) VALUES
(1, 'first', NULL, NULL, NULL),
(2, 'second', NULL, NULL, NULL);

-- Users
INSERT INTO users (id, nick, login, password, login_verified_at, remember_token, created_at, updated_at) VALUES
(1, 'max', 'max', '$2y$12$3BwZvkF6OARg.0waAA2zd.L0vwiRn8CDpfiqrwbhkKuDjKiqYRdEi', NULL, NULL, '2025-08-26 17:56:41', '2025-08-26 17:56:41'),
(3, 'ivan', 'ivan', '$2y$12$ED4UA67scsoIavrHI2w/auI3jyLuu2SwwyhsnCkMv0d2N6PLVnA16', NULL, NULL, '2025-09-02 16:38:51', '2025-09-02 16:38:51'),
(4, 'o', 'o', '$2y$12$POpm7vJeFNV3oFVgJoazUO1Do7MxiOojbQ988Y7fGwvv9mcaWJN3u', NULL, NULL, '2025-09-27 10:52:32', '2025-09-27 10:52:32'),
(5, 'test', 'test', '$2y$12$wm/5x12qdmr/1eutqfKuEe1aEGXmN/dVKRSrQ7ogyGFGP852iN4AS', NULL, NULL, '2025-09-27 15:35:14', '2025-09-27 15:35:14');

-- Tags
INSERT INTO tags (id, name, created_at, updated_at, deleted_at) VALUES
(1, 'tag1', NULL, NULL, NULL);
(2, 'tag2', NULL, NULL, NULL);

-- Default Groups
INSERT INTO default_groups (id, name, user_id, category_id, deleted_at, created_at, updated_at) VALUES
(1, 'default group', NULL, 1, NULL, '2025-08-30 16:28:41', '2025-08-30 16:28:41'),
(2, 'default group', 3, 1, NULL, '2025-09-02 16:38:51', '2025-09-02 16:38:51'),
(3, 'default group', 4, 1, NULL, '2025-09-27 10:52:32', '2025-09-27 10:52:32'),
(4, 'default group', 5, 1, NULL, '2025-09-27 15:35:14', '2025-09-27 15:35:14');

-- Groups
INSERT INTO groups (id, name, category_id, state, created_at, updated_at, deleted_at) VALUES
(1, 'links', 1, TRUE, '2025-08-30 13:06:02', '2025-08-30 13:06:02', NULL),
(3, 'new people', 1, TRUE, '2025-08-30 16:14:42', '2025-08-30 16:14:42', NULL),
(6, 'ivan', 1, TRUE, '2025-09-01 13:48:59', '2025-09-01 13:48:59', NULL),
(16, 'o', 1, TRUE, '2025-09-15 16:46:50', '2025-09-15 16:46:50', NULL),
(17, 'Ivan-polygon-safe', 2, TRUE, '2025-09-15 16:46:57', '2025-09-15 16:46:57', NULL),
(23, 'dsasd', 1, TRUE, '2025-09-27 15:49:45', '2025-09-27 15:49:45', NULL),
(26, 'oihil', 1, TRUE, '2025-09-27 15:57:00', '2025-09-27 15:57:00', NULL),
(27, 'ачвс', 1, TRUE, '2025-09-28 09:45:28', '2025-09-28 09:45:28', NULL);

-- Items
INSERT INTO items (id, group_id, default_group_id, name, description, link, state, created_at, updated_at, deleted_at) VALUES
(343, 23, NULL, 'ile', 'new change', 'dfauhlijh', TRUE, '2025-09-27 15:56:53', '2025-09-27 17:30:26', NULL),
(344, 26, NULL, 'ilhl', 'lihliuh', 'hiulu', TRUE, '2025-09-27 15:57:11', '2025-09-27 15:57:11', NULL),
(355, NULL, 2, 'щшжо', 'шдщ', 'жщшр', FALSE, '2025-09-28 09:44:01', '2025-09-28 09:44:53', NULL);

-- Item_Tag
INSERT INTO item_tag (item_id, tag_id, created_at, updated_at) VALUES
(343, 1, NULL, NULL),
(344, 1, NULL, NULL),
(355, 1, NULL, NULL);

-- Group_User
INSERT INTO group_user (group_id, user_id, created_at, updated_at) VALUES
(1, 1, NULL, NULL),
(3, 1, NULL, NULL),
(16, 3, NULL, NULL),
(17, 3, NULL, NULL),
(23, 5, NULL, NULL),
(26, 5, NULL, NULL),
(27, 3, NULL, NULL);

-- Sessions
INSERT INTO sessions (id, user_id, ip_address, user_agent, payload, last_activity) VALUES
('KTejyA6KrezriWL6jIuIUR7xjWFxU0mNsjV9swKy', 3, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)...', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibnRSSWxCSlRwQUcxcTBtcVhuTlZJNDM5N2xoZWMzT08wbVJuUVhvTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1759052543),
('qmwlcUxDmQFGtw1zRRK8mqIF0ezm3MN69CJYHZkC', 3, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X)...', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieXg0NDNQQUh3ejVqaXlRcDdISXY4ZGVOOFZGdEc3a1M1cHdneGVsUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1759060270);

-- =========================
-- Синхронізація sequence
-- =========================

SELECT setval(pg_get_serial_sequence('categories', 'id'), COALESCE(MAX(id), 1)) FROM categories;
SELECT setval(pg_get_serial_sequence('users', 'id'), COALESCE(MAX(id), 1)) FROM users;
SELECT setval(pg_get_serial_sequence('tags', 'id'), COALESCE(MAX(id), 1)) FROM tags;
SELECT setval(pg_get_serial_sequence('default_groups', 'id'), COALESCE(MAX(id), 1)) FROM default_groups;
SELECT setval(pg_get_serial_sequence('groups', 'id'), COALESCE(MAX(id), 1)) FROM groups;
SELECT setval(pg_get_serial_sequence('items', 'id'), COALESCE(MAX(id), 1)) FROM items;
SELECT setval(pg_get_serial_sequence('failed_jobs', 'id'), COALESCE(MAX(id), 1)) FROM failed_jobs;
SELECT setval(pg_get_serial_sequence('jobs', 'id'), COALESCE(MAX(id), 1)) FROM jobs;
SELECT setval(pg_get_serial_sequence('migrations', 'id'), COALESCE(MAX(id), 1)) FROM migrations;
