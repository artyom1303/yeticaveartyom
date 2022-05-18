//Напишите запросы для добавления информации в БД:

//Существующий список категорий
INSERT INTO category VALUES (null, 'Доски и лыжи');
INSERT INTO category VALUES (null, 'Крепления');
INSERT INTO category VALUES (null, 'Ботинки');
INSERT INTO category VALUES (null, 'Одежда');
INSERT INTO category VALUES (null, 'Инструменты');
INSERT INTO category VALUES (null, 'Разное');



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

INSERT INTO bet VALUES (null, '2022-05-16 15:32:30', 1000, 1, 1);
INSERT INTO bet VALUES (null, '2022-05-16 15:32:31', 2000, 2, 1);
INSERT INTO bet VALUES (null, '2022-05-16 15:32:32', 9000, 2, 1);
INSERT INTO bet VALUES (null, '2022-05-16 15:32:30', 9000, 1, 2);
INSERT INTO bet VALUES (null, '2022-05-16 15:32:30', 1000, 1, 6);
INSERT INTO bet VALUES (null, '2022-05-16 15:32:31', 9000, 2, 6);















//Напишите запросы для этих действий:

//получить все категории
select * from category;

//получить самые новые, открытые лоты. Каждый лот должен включать
название, стартовую цену, ссылку на изображение, цену последней ставки,
количество ставок, название категории
--------------------------------{--------------------------------

SELECT a_lot_id, creation_date, lot_name, starting_price, image, category_name, bets_count, last_bet_summa FROM

(
SELECT * FROM
(
SELECT lot.id as a_lot_id, creation_date, lot.name as lot_name, starting_price, image, category.name as category_name FROM lot inner join category on lot.category_id = category.id
) AS a
join
(
SELECT lot.id as b_lot_id, count(bet.id) as bets_count FROM lot left join bet on lot.id = bet.lot_id group by lot.id
) AS b
on a_lot_id = b_lot_id
)
AS ab

left join

(
SELECT bet.lot_id as c_lot_id, summa as last_bet_summa FROM
(
SELECT lot.id as lot_id, max(bet_date) as last_bet_date FROM lot left join bet on lot.id = bet.lot_id group by lot.id
) AS t
left join bet
on (t.lot_id = bet.lot_id AND t.last_bet_date = bet.bet_date)
)
AS c

on a_lot_id = c_lot_id

WHERE DATE(creation_date) = CURDATE()

order by creation_date desc

--------------------------------}--------------------------------

//показать лот по его id. Получите также название категории, к которой принадлежит лот
SELECT lot.id, creation_date, lot.name, description, image, starting_price, closing_date, bet_step, author_id, winner_id, category.name as category_name FROM lot inner join category on lot.category_id = category.id
WHERE lot.id = 1

//обновить название лота по его идентификатору
UPDATE lot SET name = 'new lot name' WHERE id = 1;

//получить список самых свежих ставок для лота по его идентификатору
SELECT bet_date, summa from bet where lot_id = 1 order by bet_date desc