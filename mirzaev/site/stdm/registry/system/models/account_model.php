<?php

declare(strict_types=1);

namespace mirzaev\site\stdm\registry\models;

// Фреймворк ArangoDB
use mirzaev\arangodb\collection,
    mirzaev\arangodb\document;

// Библиотека для ArangoDB
use ArangoDBClient\Document as _document;

// Встроенные библиотеки
use exception;

/**
 * Модель аккаунта 
 *
 * @package mirzaev\site\stdm\registry\models
 * @author Arsen Mirzaev Tatyano-Muradovich <arsen@mirzaev.sexy>
 */
final class account_model extends core
{
  /**
   * Коллекция
   */
  public const COLLECTION = 'account';

  /**
   * Авторизация
   *
   * @param string $key Ключ доступа
   * @param array &$errors Журнал ошибок
   *
   * @return bool Найден ли аккаунт и есть ли у него доступ
   */
  public static function authorization(string $key, array &$errors = []): bool {
    try {
      if (collection::init(static::$db->session, self::COLLECTION)) {
        // Инициализированы коллекции

        if ($account = collection::search(static::$db->session, sprintf(
          <<<AQL
            FOR document IN %s
              FILTER document.key == "%s" 
              LIMIT 1
              RETURN document
          AQL,
          static::COLLECTION,
          $key
        ))) {
          // Найдена инстанция ключа 

          return $account->access;
        } else throw new exception('Не удалось найти аккаунт');
      } else throw new exception('Не удалось инициализировать коллекцию');
    } catch (exception $e) {
      // Запись в журнал ошибок
      $errors[] = [
        'text' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'stack' => $e->getTrace()
      ];
    }

    return false;
  }
}
