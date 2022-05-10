create table users
(
    id           int(50) auto_increment
        primary key,
    firstname    varchar(250)                         not null,
    middlename   text                                 null,
    lastname     varchar(250)                         not null,
    username     text                                 not null,
    password     text                                 not null,
    avatar       text                                 null,
    last_login   datetime                             null,
    type         tinyint(1) default 0                 not null,
    status       int(1)     default 1                 not null comment '0=not verified, 1 = verified',
    date_added   datetime   default CURRENT_TIMESTAMP not null,
    date_updated datetime                             null on update CURRENT_TIMESTAMP
)
    engine = InnoDB
    charset = utf8mb4;

INSERT INTO railways.users (firstname, middlename, lastname, username, password, avatar, last_login, type, status, date_added, date_updated) VALUES ('Adminstrator', null, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatar-1.png?v=1639468007', null, 1, 1, '2021-01-20 14:02:37', '2021-12-14 15:47:08');
INSERT INTO railways.users (firstname, middlename, lastname, username, password, avatar, last_login, type, status, date_added, date_updated) VALUES ('Smantha', null, 'Lou', 'slou', '1ed1255790523a907da869eab7306f5a', 'uploads/avatar-4.png?v=1641346647', null, 2, 1, '2022-01-05 09:36:56', '2022-01-05 09:37:27');
INSERT INTO railways.users (firstname, middlename, lastname, username, password, avatar, last_login, type, status, date_added, date_updated) VALUES ('Yerbolat', null, 'Tursynbek', 'Yerbolat', 'e10adc3949ba59abbe56e057f20f883e', null, null, 2, 1, '2022-05-09 21:25:27', null);
INSERT INTO railways.users (firstname, middlename, lastname, username, password, avatar, last_login, type, status, date_added, date_updated) VALUES ('Yereke', null, 'Tursynbek', 'Eton', 'e10adc3949ba59abbe56e057f20f883e', null, null, 2, 1, '2022-05-10 20:19:42', null);