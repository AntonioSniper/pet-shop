from __future__ import annotations

import json
import sys
from dataclasses import dataclass
from pathlib import Path
from typing import Any

try:
    from sqlalchemy import create_engine, text
    from sqlalchemy.engine import Engine
    from sqlalchemy.exc import SQLAlchemyError
except ImportError:
    print("Ошибка: не установлен SQLAlchemy. Выполните команду: pip install sqlalchemy")
    sys.exit(1)


SCRIPT_DIR = Path(__file__).resolve().parent
CONFIG_PATH = SCRIPT_DIR / "db_config.json"

SORT_COLUMNS = {
    "1": ("order_id", "o.id"),
    "2": ("user_name", "u.name COLLATE NOCASE"),
    "3": ("created_at", "o.created_at"),
    "4": ("status", "o.status COLLATE NOCASE"),
    "5": ("total_amount", "o.total_amount"),
}


@dataclass
class AppState:
    user_id: int | None = None
    user_label: str = "все пользователи"
    sort_key: str = "3"
    sort_desc: bool = True
    search_text: str = ""


def load_database_path() -> Path:
    if not CONFIG_PATH.exists():
        raise FileNotFoundError(f"Не найден файл конфигурации: {CONFIG_PATH}")

    try:
        config = json.loads(CONFIG_PATH.read_text(encoding="utf-8"))
    except json.JSONDecodeError as exc:
        raise ValueError(f"Ошибка чтения db_config.json: {exc}") from exc

    if config.get("driver") != "sqlite":
        raise ValueError("В db_config.json должен быть указан driver = sqlite")

    configured_path = config.get("database_path")
    if not configured_path:
        raise ValueError("В db_config.json не указан database_path")

    database_path = Path(configured_path)
    if not database_path.is_absolute():
        database_path = (CONFIG_PATH.parent / database_path).resolve()

    if not database_path.exists():
        raise FileNotFoundError(f"Файл БД не найден: {database_path}")

    return database_path


def create_sqlite_engine(database_path: Path) -> Engine:
    database_url = f"sqlite:///{database_path.as_posix()}"
    engine = create_engine(database_url)
    with engine.connect() as connection:
        connection.execute(text("SELECT 1"))
    return engine


def fetch_orders(engine: Engine, state: AppState) -> list[dict[str, Any]]:
    sort_name, sort_expression = SORT_COLUMNS[state.sort_key]
    direction = "DESC" if state.sort_desc else "ASC"

    query = text(
        f"""
        SELECT
            o.id AS order_id,
            u.name AS user_name,
            o.created_at AS created_at,
            o.status AS status,
            o.total_amount AS total_amount
        FROM orders AS o
        JOIN users AS u ON u.id = o.user_id
        WHERE (:user_id IS NULL OR o.user_id = :user_id)
        ORDER BY {sort_expression} {direction}, o.id ASC
        """
    )

    with engine.connect() as connection:
        result = connection.execute(query, {"user_id": state.user_id})
        return [dict(row._mapping) for row in result]


def fetch_users_with_orders(engine: Engine) -> list[dict[str, Any]]:
    query = text(
        """
        SELECT DISTINCT
            u.id AS id,
            u.name AS name,
            u.email AS email
        FROM users AS u
        JOIN orders AS o ON o.user_id = u.id
        ORDER BY u.name COLLATE NOCASE, u.id
        """
    )

    with engine.connect() as connection:
        result = connection.execute(query)
        return [dict(row._mapping) for row in result]


def fetch_statistics(engine: Engine, state: AppState) -> dict[str, Any]:
    query = text(
        """
        SELECT
            COUNT(*) AS orders_count,
            COALESCE(SUM(total_amount), 0) AS total_amount
        FROM orders
        WHERE (:user_id IS NULL OR user_id = :user_id)
        """
    )

    with engine.connect() as connection:
        row = connection.execute(query, {"user_id": state.user_id}).one()
        return dict(row._mapping)


def format_money(value: Any) -> str:
    try:
        return f"{float(value):.2f}"
    except (TypeError, ValueError):
        return "0.00"


def is_match(row: dict[str, Any], search_text: str) -> bool:
    if not search_text:
        return False

    needle = search_text.lower()
    haystack = " ".join(str(value) for value in row.values()).lower()
    return needle in haystack


def print_orders(rows: list[dict[str, Any]], search_text: str) -> None:
    if not rows:
        print("Результат пуст: заказы не найдены.")
        return

    header = f"{'':8} {'ID':>5}  {'Пользователь':25}  {'Дата':19}  {'Статус':12}  {'Сумма':>12}"
    print(header)
    print("-" * len(header))

    for row in rows:
        marker = "[MATCH]" if is_match(row, search_text) else ""
        print(
            f"{marker:8} "
            f"{row['order_id']:>5}  "
            f"{str(row['user_name'])[:25]:25}  "
            f"{str(row['created_at'])[:19]:19}  "
            f"{str(row['status'])[:12]:12}  "
            f"{format_money(row['total_amount']):>12}"
        )


def show_orders(engine: Engine, state: AppState) -> None:
    try:
        sort_name, _ = SORT_COLUMNS[state.sort_key]
        rows = fetch_orders(engine, state)
        direction = "по убыванию" if state.sort_desc else "по возрастанию"
        print()
        print(f"Фильтр: {state.user_label}")
        print(f"Сортировка: {sort_name}, {direction}")
        if state.search_text:
            print(f"Поиск: {state.search_text}")
        print_orders(rows, state.search_text)
    except SQLAlchemyError as exc:
        print(f"Ошибка SQL при получении заказов: {exc}")


def select_user_filter(engine: Engine, state: AppState) -> None:
    try:
        users = fetch_users_with_orders(engine)
    except SQLAlchemyError as exc:
        print(f"Ошибка SQL при получении пользователей: {exc}")
        return

    if not users:
        print("Результат пуст: нет пользователей с заказами.")
        return

    print()
    print("0. Показать все заказы")
    for index, user in enumerate(users, start=1):
        print(f"{index}. {user['name']} <{user['email']}>")

    choice = input("Выберите пользователя: ").strip()
    if choice == "0":
        state.user_id = None
        state.user_label = "все пользователи"
        return

    try:
        selected_index = int(choice) - 1
        if selected_index < 0 or selected_index >= len(users):
            raise IndexError
        selected_user = users[selected_index]
    except (ValueError, IndexError):
        print("Неправильный ввод: выбранного пользователя нет в списке.")
        return

    state.user_id = int(selected_user["id"])
    state.user_label = f"{selected_user['name']} <{selected_user['email']}>"


def configure_search(state: AppState) -> None:
    value = input("Введите строку поиска или оставьте пустым для очистки: ").strip()
    state.search_text = value
    if value:
        print(f"Поиск установлен: {value}")
    else:
        print("Поиск очищен.")


def configure_sorting(state: AppState) -> None:
    print()
    print("Поля сортировки:")
    for key, (name, _) in SORT_COLUMNS.items():
        print(f"{key}. {name}")

    sort_key = input("Выберите поле сортировки: ").strip()
    if sort_key not in SORT_COLUMNS:
        print("Неправильный ввод: такого поля сортировки нет.")
        return

    direction = input("Направление: 1 - по возрастанию, 2 - по убыванию: ").strip()
    if direction not in {"1", "2"}:
        print("Неправильный ввод: направление должно быть 1 или 2.")
        return

    state.sort_key = sort_key
    state.sort_desc = direction == "2"


def show_statistics(engine: Engine, state: AppState) -> None:
    try:
        stats = fetch_statistics(engine, state)
    except SQLAlchemyError as exc:
        print(f"Ошибка SQL при расчете статистики: {exc}")
        return

    print()
    print(f"Фильтр: {state.user_label}")
    print(f"Всего заказов: {stats['orders_count']}")
    print(f"Общая сумма заказов: {format_money(stats['total_amount'])}")


def print_menu() -> None:
    print()
    print("Анализ заказов pet-shop")
    print("1. Показать заказы")
    print("2. Фильтр по пользователю")
    print("3. Поиск по заказам")
    print("4. Настроить сортировку")
    print("5. Статистика")
    print("0. Выход")


def main() -> int:
    try:
        database_path = load_database_path()
        engine = create_sqlite_engine(database_path)
    except (FileNotFoundError, ValueError) as exc:
        print(f"Ошибка: {exc}")
        return 1
    except SQLAlchemyError as exc:
        print(f"Ошибка SQL при подключении к БД: {exc}")
        return 1

    print(f"Подключение к БД: {database_path}")
    state = AppState()

    while True:
        print_menu()
        choice = input("Выберите действие: ").strip()

        if choice == "1":
            show_orders(engine, state)
        elif choice == "2":
            select_user_filter(engine, state)
        elif choice == "3":
            configure_search(state)
        elif choice == "4":
            configure_sorting(state)
        elif choice == "5":
            show_statistics(engine, state)
        elif choice == "0":
            print("Работа завершена.")
            return 0
        else:
            print("Неправильный ввод: выберите пункт меню от 0 до 5.")


if __name__ == "__main__":
    raise SystemExit(main())
