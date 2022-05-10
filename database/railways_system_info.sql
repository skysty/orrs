create table system_info
(
    id         int(30) auto_increment
        primary key,
    meta_field text not null,
    meta_value text not null
)
    engine = InnoDB
    charset = utf8mb4;

INSERT INTO railways.system_info (meta_field, meta_value) VALUES ('name', 'ÒšÐ°Ð·Ð°Ò›ÑÑ‚Ð°Ð½ Ñ‚ÐµÐ¼Ñ–Ñ€ Ð¶Ð¾Ð»Ñ‹');
INSERT INTO railways.system_info (meta_field, meta_value) VALUES ('short_name', 'Railways');
INSERT INTO railways.system_info (meta_field, meta_value) VALUES ('logo', 'uploads/logo-1641351863.png');
INSERT INTO railways.system_info (meta_field, meta_value) VALUES ('user_avatar', 'uploads/user_avatar.jpg');
INSERT INTO railways.system_info (meta_field, meta_value) VALUES ('cover', 'uploads/cover-1641351863.png');
INSERT INTO railways.system_info (meta_field, meta_value) VALUES ('content', 'Array');
INSERT INTO railways.system_info (meta_field, meta_value) VALUES ('email', 'info@railway.kz');
INSERT INTO railways.system_info (meta_field, meta_value) VALUES ('contact', '8(727)6-32-12');
INSERT INTO railways.system_info (meta_field, meta_value) VALUES ('from_time', '11:00');
INSERT INTO railways.system_info (meta_field, meta_value) VALUES ('to_time', '21:30');
INSERT INTO railways.system_info (meta_field, meta_value) VALUES ('address', 'Turkestan, Tauke Khan avenue 8');