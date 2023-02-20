<?php

declare(strict_types=1);

namespace mirzaev\site\rules\models;

use mirzaev\minimal\model;

use mirzaev\arangodb\connection;

use exception;

/**
 * Ядро моделей
 *
 * @package mirzaev\site\rules\models
 * @author Arsen Mirzaev Tatyano-Muradovich <arsen@mirzaev.sexy>
 */
class core extends model
{
    /**
     * Записать свойство
     *
     * @param string $name Название
     * @param mixed $value Значение
     */
    public function __set(string $name, mixed $value = null): void
    {
        match ($name) {
            'db' => (function () use ($value) {
                if ($this->__isset('db')) {
                    // Свойство уже было инициализировано

                    // Выброс исключения (неудача)
                    throw new exception('Запрещено реинициализировать соединение с базой данных ($this->db)', 500);
                } else {
                    // Свойство ещё не было инициализировано

                    if ($value instanceof connection) {
                        // Передано подходящее значение

                        // Запись свойства (успех)
                        self::$db = $value;
                    } else {
                        // Передано неподходящее значение

                        // Выброс исключения (неудача)
                        throw new exception('Соединение с базой данных ($this->db) должен быть инстанцией mirzaev\arangodb\connection', 500);
                    }
                }
            })(),
            default => parent::__set($name, $value)
        };
    }

    /**
     * Прочитать свойство
     *
     * @param string $name Название
     *
     * @return mixed Содержимое
     */
    public function __get(string $name): mixed
    {
        return match ($name) {
            'db' => (function () {
                if (!$this->__isset('db')) {
                    // Свойство не инициализировано

                    // Инициализация значения по умолчанию исходя из настроек
                    $this->__set('db', new connection(require static::SETTINGS));
                }

                return self::$db;
            })(),
            default => parent::__get($name)
        };
    }

    /**
     * Проверить свойство на инициализированность
     *
     * @param string $name Название
     */
    public function __isset(string $name): bool
    {
        return match ($name) {
            default => parent::__isset($name)
        };
    }

    /**
     * Удалить свойство
     *
     * @param string $name Название
     */
    public function __unset(string $name): void
    {
        match ($name) {
            default => parent::__isset($name)
        };
    }


    /**
     * Статический вызов
     *
     * @param string $name Название
     * @param array $arguments Параметры
     */
    public static function __callStatic(string $name, array $arguments): mixed
    {
        match ($name) {
            default => throw new exception("Не найдено свойство или функция: $name", 500)
        };
    }
}
