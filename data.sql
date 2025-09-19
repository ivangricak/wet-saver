-- =========================
-- PostgreSQL дамп бази saver
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
-- Тепер вставка даних у правильному порядку
-- =========================

INSERT INTO categories (id, name, created_at, updated_at, deleted_at) VALUES
(1, 'first', NULL, NULL, NULL),
(2, 'second', NULL, NULL, NULL);

INSERT INTO users (id, nick, login, password, login_verified_at, remember_token, created_at, updated_at) VALUES
(1, 'max', 'max', '$2y$12$3BwZvkF6OARg.0waAA2zd.L0vwiRn8CDpfiqrwbhkKuDjKiqYRdEi', NULL, NULL, '2025-08-26 17:56:41', '2025-08-26 17:56:41'),
(3, 'ivan', 'ivan', '$2y$12$ED4UA67scsoIavrHI2w/auI3jyLuu2SwwyhsnCkMv0d2N6PLVnA16', NULL, NULL, '2025-09-02 16:38:51', '2025-09-02 16:38:51');

INSERT INTO tags (id, name, created_at, updated_at, deleted_at) VALUES
(1, 'tag', NULL, NULL, NULL);

INSERT INTO default_groups (id, name, user_id, category_id, deleted_at, created_at, updated_at) VALUES
(1, 'default group', NULL, 1, NULL, '2025-08-30 16:28:41', '2025-08-30 16:28:41'),
(2, 'default group', 3, 1, NULL, '2025-09-02 16:38:51', '2025-09-02 16:38:51');

INSERT INTO groups (id, name, category_id, created_at, updated_at, deleted_at) VALUES
(1, 'links', 1, '2025-08-30 13:06:02', '2025-08-30 13:06:02', NULL),
(3, 'new people', 1, '2025-08-30 16:14:42', '2025-08-30 16:14:42', NULL),
(6, 'ivan', 1, '2025-09-01 13:48:59', '2025-09-01 13:48:59', NULL),
(16, 'o', 1, '2025-09-15 16:46:50', '2025-09-15 16:46:50', NULL),
(17, 'Ivan-polygon-safe', 2, '2025-09-15 16:46:57', '2025-09-15 16:46:57', NULL);

INSERT INTO items (id, group_id, default_group_id, name, description, link, state, created_at, updated_at, deleted_at) VALUES
(1, 6, NULL, 'ivan', 'dvs', 'gfd', TRUE, '2025-09-01 15:52:00', '2025-09-01 15:52:00', NULL),
(2, 6, NULL, 'Іван Грицак', 'asihiuhiho', 'link', TRUE, '2025-09-01 16:24:15', '2025-09-01 16:24:15', NULL),
(3, 6, NULL, 'f', 'gg is it !!', 'gg', TRUE, '2025-09-01 16:24:48', '2025-09-01 16:24:48', NULL),
(8, NULL, 2, 'ivan', 'vdfvx', 'link', TRUE, '2025-09-03 16:51:23', '2025-09-03 16:51:23', NULL),
(9, NULL, 2, 'Іван Грицак', 'dvzzd', 'link', TRUE, '2025-09-03 16:54:46', '2025-09-03 16:54:46', NULL),
(10, NULL, 2, 'ivan', 'ds', 'das', TRUE, '2025-09-10 16:56:57', '2025-09-10 16:56:57', NULL),
(12, NULL, 2, 'df', 'dz', 'dfv zd', TRUE, '2025-09-10 17:14:52', '2025-09-10 17:14:52', NULL),
(13, NULL, 2, 'Іван Грицак', 'sa', 'as', TRUE, '2025-09-10 17:15:35', '2025-09-10 17:15:35', NULL);

INSERT INTO item_tag (item_id, tag_id, created_at, updated_at) VALUES
(1, 1, NULL, NULL),
(2, 1, NULL, NULL),
(3, 1, NULL, NULL),
(8, 1, NULL, NULL),
(9, 1, NULL, NULL),
(10, 1, NULL, NULL),
(12, 1, NULL, NULL),
(13, 1, NULL, NULL);

INSERT INTO group_user (group_id, user_id, created_at, updated_at) VALUES
(1, 1, NULL, NULL),
(3, 1, NULL, NULL),
(16, 3, NULL, NULL),
(17, 3, NULL, NULL);

-- =========================
-- Синхронізація sequence після імпорту
-- =========================

-- Categories
SELECT setval(pg_get_serial_sequence('categories', 'id'), COALESCE(MAX(id), 1)) FROM categories;

-- Users
SELECT setval(pg_get_serial_sequence('users', 'id'), COALESCE(MAX(id), 1)) FROM users;

-- Tags
SELECT setval(pg_get_serial_sequence('tags', 'id'), COALESCE(MAX(id), 1)) FROM tags;

-- Default groups
SELECT setval(pg_get_serial_sequence('default_groups', 'id'), COALESCE(MAX(id), 1)) FROM default_groups;

-- Groups
SELECT setval(pg_get_serial_sequence('groups', 'id'), COALESCE(MAX(id), 1)) FROM groups;

-- Items
SELECT setval(pg_get_serial_sequence('items', 'id'), COALESCE(MAX(id), 1)) FROM items;

-- Failed jobs
SELECT setval(pg_get_serial_sequence('failed_jobs', 'id'), COALESCE(MAX(id), 1)) FROM failed_jobs;

-- Jobs
SELECT setval(pg_get_serial_sequence('jobs', 'id'), COALESCE(MAX(id), 1)) FROM jobs;

-- Migrations
SELECT setval(pg_get_serial_sequence('migrations', 'id'), COALESCE(MAX(id), 1)) FROM migrations;