-- Триггеры для автоматического пересчета суммы заказа.
-- В текущей структуре проекта итоговая сумма хранится в поле orders.total_amount.
-- Формула: SUM(order_items.quantity * order_items.price).

CREATE TRIGGER IF NOT EXISTS trg_order_items_after_insert_recalc_order_total
AFTER INSERT ON order_items
BEGIN
    UPDATE orders
    SET total_amount = COALESCE((
        SELECT SUM(quantity * price)
        FROM order_items
        WHERE order_id = NEW.order_id
    ), 0)
    WHERE id = NEW.order_id;
END;

CREATE TRIGGER IF NOT EXISTS trg_order_items_after_update_recalc_order_total
AFTER UPDATE ON order_items
BEGIN
    UPDATE orders
    SET total_amount = COALESCE((
        SELECT SUM(quantity * price)
        FROM order_items
        WHERE order_id = OLD.order_id
    ), 0)
    WHERE id = OLD.order_id;

    UPDATE orders
    SET total_amount = COALESCE((
        SELECT SUM(quantity * price)
        FROM order_items
        WHERE order_id = NEW.order_id
    ), 0)
    WHERE id = NEW.order_id;
END;

CREATE TRIGGER IF NOT EXISTS trg_order_items_after_delete_recalc_order_total
AFTER DELETE ON order_items
BEGIN
    UPDATE orders
    SET total_amount = COALESCE((
        SELECT SUM(quantity * price)
        FROM order_items
        WHERE order_id = OLD.order_id
    ), 0)
    WHERE id = OLD.order_id;
END;
