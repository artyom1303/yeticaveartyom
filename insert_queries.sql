//Напишите запросы для добавления информации в БД:

//Существующий список категорий
INSERT INTO category VALUES (null, 'Доски и лыжи', 'boards');
INSERT INTO category VALUES (null, 'Крепления', 'attachment');
INSERT INTO category VALUES (null, 'Ботинки', 'boots');
INSERT INTO category VALUES (null, 'Одежда', 'clothing');
INSERT INTO category VALUES (null, 'Инструменты', 'tools');
INSERT INTO category VALUES (null, 'Разное', 'other');


//Придумайте пару пользователей
INSERT INTO user_ VALUES (null, '2022-05-16 15:32:30', 'a@mail.ru', 'jack', '1', 'jack.jpg', '81111111111');
INSERT INTO user_ VALUES (null, '2022-05-16 15:32:30', 'b@mail.ru', 'john', '2', 'john.jpg', '81111111112');



//Список объявлений

INSERT INTO lot VALUES (
null,

'2022-05-16 15:32:30',
'2014 Rossignol District Snowboard',
'description',
'img/lot-1.jpg',
'10990',
'2022-05-17 15:32:30',
'1000',

1,
null,
1
);

INSERT INTO lot VALUES (
null,

'2022-05-16 15:32:30',
'DC Ply Mens 2016/2017 Snowboard',
'description',
'img/lot-2.jpg',
'159999',
'2022-05-17 15:32:30',
'1000',

1,
null,
1
);

INSERT INTO lot VALUES (
null,

'2022-05-16 15:32:30',
'Крепления Union Contact Pro 2015 года размер L/XL',
'description',
'img/lot-3.jpg',
'8000',
'2022-05-17 15:32:30',
'1000',

1,
null,
2
);

INSERT INTO lot VALUES (
null,

'2022-05-16 15:32:30',
'Ботинки для сноуборда DC Mutiny Charocal',
'description',
'img/lot-4.jpg',
'10999',
'2022-05-17 15:32:30',
'1000',

1,
null,
3
);

INSERT INTO lot VALUES (
null,

'2022-05-16 15:32:30',
'Куртка для сноуборда DC Mutiny Charocal',
'description',
'img/lot-5.jpg',
'7500',
'2022-05-17 15:32:30',
'1000',

1,
null,
4
);

INSERT INTO lot VALUES (
null,

'2022-05-16 15:32:30',
'Маска Oakley Canopy',
'description',
'img/lot-6.jpg',
'5400',
'2022-05-17 15:32:30',
'1000',

1,
null,
6
);



//Добавьте пару ставок для любого объявления

//1
INSERT INTO bet VALUES (null, '2022-05-16 15:32:30', 1000, 1, 1);
INSERT INTO bet VALUES (null, '2022-05-16 15:32:31', 1000, 2, 1);
INSERT INTO bet VALUES (null, '2022-05-16 15:32:30', 1000, 1, 2);

//2
INSERT INTO bet VALUES (null, '2022-05-16 15:32:30', 1000, 1, 1);
INSERT INTO bet VALUES (null, '2022-05-16 15:32:31', 2000, 2, 1);
INSERT INTO bet VALUES (null, '2022-05-16 15:32:32', 9000, 2, 1);

INSERT INTO bet VALUES (null, '2022-05-16 15:32:30', 9000, 1, 2);

INSERT INTO bet VALUES (null, '2022-05-16 15:32:30', 1000, 1, 6);
INSERT INTO bet VALUES (null, '2022-05-16 15:32:31', 9000, 2, 6);