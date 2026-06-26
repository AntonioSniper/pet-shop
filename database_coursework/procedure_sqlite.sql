-- SQLite не поддерживает CREATE PROCEDURE.
-- Это аналог процедуры GetOrderSummaryByPeriod в виде параметризованного SELECT-запроса.
-- Параметры:
--   :start_date
--   :end_date

SELECT
    u.name AS user_name,
    COUNT(o.id) AS orders_count,
    COALESCE(SUM(item_totals.total_quantity), 0) AS total_ordered_products,
    COALESCE(SUM(o.total_amount), 0) AS total_orders_amount
FROM users AS u
JOIN orders AS o
    ON o.user_id = u.id
LEFT JOIN (
    SELECT
        order_id,
        SUM(quantity) AS total_quantity
    FROM order_items
    GROUP BY order_id
) AS item_totals
    ON item_totals.order_id = o.id
WHERE date(o.created_at) BETWEEN date(:start_date) AND date(:end_date)
GROUP BY u.id, u.name
ORDER BY total_orders_amount DESC, orders_count DESC, u.name ASC;
