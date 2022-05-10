create table train_list
(
    id                   int(30) auto_increment
        primary key,
    code                 varchar(100)                         not null,
    name                 text                                 not null,
    first_class_capacity float      default 0                 not null,
    economy_capacity     float      default 0                 not null,
    delete_flag          tinyint(1) default 0                 not null,
    date_created         datetime   default CURRENT_TIMESTAMP not null,
    date_updated         datetime                             null on update CURRENT_TIMESTAMP
)
    engine = InnoDB
    charset = utf8mb4;

INSERT INTO railways.train_list (code, name, first_class_capacity, economy_capacity, delete_flag, date_created, date_updated) VALUES ('TIR-1001', 'Train 101', 100, 200, 0, '2022-01-05 11:05:42', '2022-01-05 16:27:47');
INSERT INTO railways.train_list (code, name, first_class_capacity, economy_capacity, delete_flag, date_created, date_updated) VALUES ('TIR-1002', 'Train 102', 100, 200, 0, '2022-01-05 11:11:41', null);
INSERT INTO railways.train_list (code, name, first_class_capacity, economy_capacity, delete_flag, date_created, date_updated) VALUES ('TIR-1003', 'Train 103', 150, 300, 0, '2022-01-05 11:11:56', null);
INSERT INTO railways.train_list (code, name, first_class_capacity, economy_capacity, delete_flag, date_created, date_updated) VALUES ('TIR-1004', 'Train 104', 150, 300, 0, '2022-01-05 11:12:15', null);
INSERT INTO railways.train_list (code, name, first_class_capacity, economy_capacity, delete_flag, date_created, date_updated) VALUES ('TIR-1005', 'Train 105', 800, 1500, 1, '2022-01-05 11:13:00', '2022-01-05 11:13:14');