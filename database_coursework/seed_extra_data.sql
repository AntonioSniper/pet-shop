-- Дополнительные тестовые данные для существующей БД pet-shop.
-- Скрипт ничего не удаляет и не пересоздает.

INSERT OR IGNORE INTO categories (name, slug, description, created_at, updated_at) VALUES
('Корма для кошек', 'cat-food', 'Сухие и влажные корма для кошек разных возрастов.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Корма для собак', 'dog-food', 'Повседневные и лечебные корма для собак.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Наполнители для кошек', 'cat-litter', 'Комкующиеся, древесные и силикагелевые наполнители.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Игрушки для животных', 'pet-toys', 'Игрушки для кошек, собак и других питомцев.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Ошейники и поводки', 'collars-leashes', 'Аксессуары для прогулок и безопасности.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Аквариумистика', 'aquariums', 'Товары для рыб и ухода за аквариумом.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Товары для птиц', 'bird-care', 'Корма, клетки и аксессуары для птиц.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Товары для грызунов', 'rodent-care', 'Корма, сено, домики и аксессуары для грызунов.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Груминг и уход', 'grooming-care', 'Шампуни, расчески и инструменты для ухода.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Ветаптека', 'veterinary-care', 'Витамины, средства гигиены и базовый уход.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Сухой корм для кошек с индейкой', 'suhoy-korm-dlya-koshek-s-indeykoy', 'Полнорационный сухой корм для взрослых кошек.', 1290.00, 35, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'cat-food';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Влажный корм для кошек с лососем', 'vlazhnyy-korm-dlya-koshek-s-lososem', 'Паучи с кусочками лосося в соусе.', 95.00, 120, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'cat-food';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Корм для котят с курицей', 'korm-dlya-kotyat-s-kuritsey', 'Питательный корм для котят до 12 месяцев.', 760.00, 42, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'cat-food';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Сухой корм для собак с ягненком', 'suhoy-korm-dlya-sobak-s-yagnenkom', 'Корм для взрослых собак средних пород.', 1890.00, 27, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'dog-food';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Влажный корм для щенков с говядиной', 'vlazhnyy-korm-dlya-schenkov-s-govyadinoy', 'Мягкий рацион для щенков с нежной говядиной.', 135.00, 90, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'dog-food';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Лакомство для собак с уткой', 'lakomstvo-dlya-sobak-s-utkoy', 'Мясные палочки для поощрения при дрессировке.', 240.00, 55, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'dog-food';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Комкующийся наполнитель с лавандой', 'komkuyuschiysya-napolnitel-s-lavandoy', 'Наполнитель с легким ароматом лаванды.', 510.00, 48, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'cat-litter';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Древесный наполнитель для кошек', 'drevesnyy-napolnitel-dlya-koshek', 'Экологичный древесный наполнитель для лотка.', 390.00, 64, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'cat-litter';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Мячик с колокольчиком', 'myachik-s-kolokolchikom', 'Легкая игрушка для кошек с мягким звуком.', 160.00, 80, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'pet-toys';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Канат для собак хлопковый', 'kanat-dlya-sobak-hlopkovyy', 'Прочная игрушка для активных игр и перетягивания.', 320.00, 37, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'pet-toys';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Интерактивная мышка для кошек', 'interaktivnaya-myshka-dlya-koshek', 'Игрушка с имитацией движения для домашних кошек.', 690.00, 24, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'pet-toys';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Ошейник нейлоновый красный', 'osheynik-neylonovyy-krasnyy', 'Регулируемый ошейник для собак малых и средних пород.', 280.00, 70, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'collars-leashes';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Поводок-рулетка 5 метров', 'povodok-ruletka-5-metrov', 'Удобная рулетка для ежедневных прогулок.', 1150.00, 30, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'collars-leashes';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Аквариум прямоугольный 40 литров', 'akvarium-pryamougolnyy-40-litrov', 'Стеклянный аквариум для начинающих аквариумистов.', 4200.00, 8, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'aquariums';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Корм для аквариумных рыб хлопья', 'korm-dlya-akvariumnyh-ryb-hlopya', 'Универсальный корм в хлопьях для декоративных рыб.', 210.00, 75, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'aquariums';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Минеральный камень для птиц', 'mineralnyy-kamen-dlya-ptic', 'Источник минералов для волнистых попугаев и канареек.', 140.00, 67, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'bird-care';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Корм для попугаев зерновой', 'korm-dlya-popugaev-zernovoy', 'Зерновая смесь для ежедневного кормления попугаев.', 260.00, 52, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'bird-care';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Сено луговое для грызунов', 'seno-lugovoe-dlya-gryzunov', 'Ароматное луговое сено для кроликов и морских свинок.', 180.00, 88, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'rodent-care';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Домик деревянный для хомяка', 'domik-derevyannyy-dlya-homyaka', 'Небольшой домик из дерева для мелких грызунов.', 540.00, 21, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'rodent-care';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Шампунь гипоаллергенный для собак', 'shampun-gipoallergennyy-dlya-sobak', 'Мягкий шампунь для чувствительной кожи.', 430.00, 33, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'grooming-care';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Когтерез малый', 'kogterez-malyy', 'Инструмент для аккуратного ухода за когтями питомца.', 310.00, 46, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'grooming-care';

INSERT OR IGNORE INTO products (category_id, name, slug, description, price, stock, image, is_active, created_at, updated_at)
SELECT id, 'Витаминная паста для кошек', 'vitaminnaya-pasta-dlya-koshek', 'Паста с витаминами для поддержки здоровья кошек.', 520.00, 29, NULL, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM categories WHERE slug = 'veterinary-care';
