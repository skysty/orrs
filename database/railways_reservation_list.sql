create table reservation_list
(
    id           int(30) auto_increment
        primary key,
    seat_num     varchar(50)                          not null,
    schedule_id  int(30)                              not null,
    schedule     datetime                             not null,
    firstname    text                                 not null,
    middlename   text                                 not null,
    lastname     text                                 not null,
    seat_type    tinyint(1) default 1                 not null comment '1=First Class, 2 = Economy',
    fare_amount  float      default 0                 not null,
    date_created datetime   default CURRENT_TIMESTAMP not null,
    date_updated datetime                             null on update CURRENT_TIMESTAMP,
    user_id      int(30)                              not null,
    constraint reservation_list_ibfk_1
        foreign key (schedule_id) references schedule_list (id)
            on delete cascade,
    constraint reservation_list_ibfk_2
        foreign key (user_id) references users (id)
            on delete cascade
)
    engine = InnoDB
    charset = utf8mb4;

create index schedule_id
    on reservation_list (schedule_id);

create index user_id
    on reservation_list (user_id);

INSERT INTO railways.reservation_list (seat_num, schedule_id, schedule, firstname, middlename, lastname, seat_type, fare_amount, date_created, date_updated, user_id) VALUES ('E-001', 1, '2022-01-07 07:00:00', 'John', 'D', 'Smith', 2, 25, '2022-01-06 08:35:53', '2022-05-10 20:35:05', 5);
INSERT INTO railways.reservation_list (seat_num, schedule_id, schedule, firstname, middlename, lastname, seat_type, fare_amount, date_created, date_updated, user_id) VALUES ('FC-001', 5, '2022-05-18 11:57:00', 'Yerbolat', '', 'Tursynbek', 1, 10000, '2022-05-10 14:27:46', '2022-05-10 20:35:44', 5);
INSERT INTO railways.reservation_list (seat_num, schedule_id, schedule, firstname, middlename, lastname, seat_type, fare_amount, date_created, date_updated, user_id) VALUES ('FC-002', 5, '2022-05-18 11:57:00', 'Yerbolat', '', 'Tursynbek', 1, 10000, '2022-05-10 18:11:11', '2022-05-10 20:35:48', 5);
INSERT INTO railways.reservation_list (seat_num, schedule_id, schedule, firstname, middlename, lastname, seat_type, fare_amount, date_created, date_updated, user_id) VALUES ('FC-003', 5, '2022-05-18 11:57:00', 'Yerbolat', '', 'Tursynbek', 1, 10000, '2022-05-10 18:16:17', '2022-05-10 20:35:51', 5);
INSERT INTO railways.reservation_list (seat_num, schedule_id, schedule, firstname, middlename, lastname, seat_type, fare_amount, date_created, date_updated, user_id) VALUES ('E-001', 5, '2022-05-18 11:57:00', 'Yerbolat', '', 'Tursynbek', 2, 8000, '2022-05-10 18:35:16', '2022-05-10 20:36:01', 5);
INSERT INTO railways.reservation_list (seat_num, schedule_id, schedule, firstname, middlename, lastname, seat_type, fare_amount, date_created, date_updated, user_id) VALUES ('FC-004', 5, '2022-05-18 11:57:00', 'Yerbolat', '', 'Tursynbek', 1, 10000, '2022-05-10 20:59:07', null, 5);