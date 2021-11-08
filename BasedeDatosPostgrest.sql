-- Crear una base de datos en postgres llamada laravel_master con un usuario llamado photosadmin y una contraseña llamada 123
-- Luego ejecutar este codigo con datos de prueba en postgres:

CREATE TABLE IF NOT EXISTS users(
id              SERIAL not null,
role            varchar(20),
name            varchar(100),
surname         varchar(200),
nick            varchar(100),
email           varchar(255),
password        varchar(255),
image           varchar(255),
created_at      TIMESTAMP,
updated_at      TIMESTAMP,
remember_token  varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id)
);

INSERT INTO users VALUES(DEFAULT, 'user', 'Diego', 'Molina', 'diegomolina', 'diego@diego.com', 'pass', null, NOW(), NOW(), NULL);
INSERT INTO users VALUES(DEFAULT, 'user', 'Julieth', 'Vargas', 'Juliethvar', 'juli@juli.com', 'pass', null, NOW(), NOW(), NULL);
INSERT INTO users VALUES(DEFAULT, 'user', 'Pepito', 'Perez', 'pepitos', 'pepito@pepito', 'pass', null, NOW(), NOW(), NULL);

CREATE TABLE IF NOT EXISTS images(
id              SERIAL not null,
user_id         integer,
image_path      varchar(255),
description     text,
created_at      TIMESTAMP,
updated_at      TIMESTAMP,
CONSTRAINT pk_images PRIMARY KEY(id),
CONSTRAINT fk_images_users FOREIGN KEY(user_id) REFERENCES users(id)
);

INSERT INTO images VALUES(DEFAULT, 1, 'test.jpg', 'descripción de prueba 1', NOW(), NOW());
INSERT INTO images VALUES(DEFAULT, 1, 'playa.jpg', 'descripción de prueba 2', NOW(), NOW());
INSERT INTO images VALUES(DEFAULT, 1, 'arena.jpg', 'descripción de prueba 3', NOW(), NOW());
INSERT INTO images VALUES(DEFAULT, 3, 'familia.jpg', 'descripción de prueba 4', NOW(), NOW());


CREATE TABLE IF NOT EXISTS comments(
id              SERIAL not null,
user_id         integer,
image_id        integer,
content         text,
created_at      TIMESTAMP,
updated_at      TIMESTAMP,
CONSTRAINT pk_comments PRIMARY KEY(id),
CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)
);

INSERT INTO comments VALUES(DEFAULT, 1, 4, 'Buena foto de familia!!', NOW(), NOW());
INSERT INTO comments VALUES(DEFAULT, 2, 1, 'Buena foto de PLAYA!!', NOW(), NOW());
INSERT INTO comments VALUES(DEFAULT, 2, 4, 'que bueno!!', NOW(), NOW());

CREATE TABLE IF NOT EXISTS likes(
id              SERIAL not null,
user_id         integer,
image_id        integer,
created_at      TIMESTAMP,
updated_at      TIMESTAMP,
CONSTRAINT pk_likes PRIMARY KEY(id),
CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)
);

INSERT INTO likes VALUES(DEFAULT, 1, 4, NOW(), NOW());
INSERT INTO likes VALUES(DEFAULT, 2, 4, NOW(), NOW());
INSERT INTO likes VALUES(DEFAULT, 3, 1, NOW(), NOW());
INSERT INTO likes VALUES(DEFAULT, 3, 2, NOW(), NOW());
INSERT INTO likes VALUES(DEFAULT, 2, 1, NOW(), NOW());