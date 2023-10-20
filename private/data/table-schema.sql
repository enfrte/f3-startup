
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS password_resets;
DROP TABLE IF EXISTS failed_jobs;
DROP TABLE IF EXISTS personal_access_tokens;
DROP TABLE IF EXISTS projects;
DROP TABLE IF EXISTS source_sentences;
DROP TABLE IF EXISTS translators;
DROP TABLE IF EXISTS translations;


CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    email TEXT UNIQUE,
    email_verified_at DATETIME,
    password TEXT,
    saved_translation_lang CHAR(2),
    remember_token TEXT,
    created_at DATETIME,
    updated_at DATETIME
);

INSERT INTO users (name, email, password, saved_translation_lang)
VALUES ('admin', 'example@example.com', '0000', 'en');

CREATE TABLE password_resets (
    email TEXT PRIMARY KEY,
    token TEXT,
    created_at DATETIME
);

CREATE TABLE failed_jobs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    uuid TEXT UNIQUE,
    connection TEXT,
    queue TEXT,
    payload TEXT,
    exception TEXT,
    failed_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE personal_access_tokens (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    tokenable_id INTEGER,
    tokenable_type TEXT,
    name TEXT,
    token TEXT UNIQUE,
    abilities TEXT,
    last_used_at DATETIME,
    expires_at DATETIME,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE projects (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT,
    description TEXT,
    lang CHAR(2),
    created_at DATETIME,
    updated_at DATETIME,
    user_id INTEGER,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE source_sentences (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    grouping_index INTEGER,
    page_num INTEGER,
    sentence_text TEXT,
    created_at DATETIME,
    updated_at DATETIME,
    user_id INTEGER,
    project_id INTEGER,
    UNIQUE (project_id, grouping_index, page_num),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (project_id) REFERENCES projects(id)
);

CREATE TABLE translators (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    project_id INTEGER,
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (project_id) REFERENCES projects(id)
);

CREATE TABLE translations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    lang CHAR(2),
    translation TEXT,
    created_at DATETIME,
    updated_at DATETIME,
    source_sentence_id INTEGER,
    translator_id INTEGER,
    FOREIGN KEY (source_sentence_id) REFERENCES source_sentences(id),
    FOREIGN KEY (translator_id) REFERENCES translators(id)
);

