create table message_list
(
    id           int(30) auto_increment
        primary key,
    fullname     text                                 not null,
    contact      text                                 not null,
    email        text                                 not null,
    message      text                                 not null,
    status       tinyint(1) default 0                 not null,
    date_created datetime   default CURRENT_TIMESTAMP not null
)
    engine = InnoDB
    charset = utf8mb4;

INSERT INTO railways.message_list (fullname, contact, email, message, status, date_created) VALUES ('Mark Cooper', '09456123789', 'mcooper@sample.com', 'Sample Inquiry only', 1, '2022-01-06 09:13:14');