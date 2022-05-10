create table schedule_list
(
    id               int(30) auto_increment
        primary key,
    code             varchar(100)                         not null,
    train_id         int(30)                              not null,
    route_from       text                                 not null,
    route_to         text                                 not null,
    type             tinyint(1) default 1                 not null comment '1 = daily, 2= One-Time Schedule',
    date_schedule    date                                 null,
    time_schedule    time                                 not null,
    first_class_fare float      default 0                 not null,
    economy_fare     float      default 0                 not null,
    delete_flag      tinyint(1) default 0                 not null,
    date_created     datetime   default CURRENT_TIMESTAMP not null,
    date_updated     datetime                             null on update CURRENT_TIMESTAMP,
    constraint schedule_list_ibfk_1
        foreign key (train_id) references train_list (id)
            on delete cascade
)
    engine = InnoDB
    charset = utf8mb4;

create index train_id
    on schedule_list (train_id);

INSERT INTO railways.schedule_list (code, train_id, route_from, route_to, type, date_schedule, time_schedule, first_class_fare, economy_fare, delete_flag, date_created, date_updated) VALUES ('202201-0001', 1, 'Station 1', 'Station 2', 1, null, '07:00:00', 50, 25, 0, '2022-01-05 13:14:45', '2022-01-05 13:23:17');
INSERT INTO railways.schedule_list (code, train_id, route_from, route_to, type, date_schedule, time_schedule, first_class_fare, economy_fare, delete_flag, date_created, date_updated) VALUES ('202201-0003', 2, 'Station 2', 'Station 5', 2, '2022-01-07', '08:00:00', 250, 170, 1, '2022-01-05 13:17:49', '2022-05-10 00:36:46');
INSERT INTO railways.schedule_list (code, train_id, route_from, route_to, type, date_schedule, time_schedule, first_class_fare, economy_fare, delete_flag, date_created, date_updated) VALUES ('202201-0002', 1, 'Station 1', 'Station 3', 1, null, '08:30:00', 100, 75, 0, '2022-01-05 13:18:25', '2022-01-05 13:24:28');
INSERT INTO railways.schedule_list (code, train_id, route_from, route_to, type, date_schedule, time_schedule, first_class_fare, economy_fare, delete_flag, date_created, date_updated) VALUES ('202201-0004', 1, 'Station 1', 'Station 2', 1, null, '00:00:00', 123, 89, 1, '2022-01-05 13:59:44', '2022-01-05 13:59:56');
INSERT INTO railways.schedule_list (code, train_id, route_from, route_to, type, date_schedule, time_schedule, first_class_fare, economy_fare, delete_flag, date_created, date_updated) VALUES ('202205-0001', 2, 'ÐÐ»Ð¼Ð°Ñ‚Ñ‹ 1', 'Ð¢Ò¯Ñ€ÐºÑ–ÑÑ‚Ð°Ð½', 2, '2022-05-18', '11:57:00', 10000, 8000, 0, '2022-05-09 20:58:15', null);