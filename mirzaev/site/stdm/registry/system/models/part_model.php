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
 * Модель запчастей 
 *
 * @package mirzaev\site\stdm\registry\models
 * @author Arsen Mirzaev Tatyano-Muradovich <arsen@mirzaev.sexy>
 */
final class part_model extends core
{
  /**
   * Коллекция
   */
  public const COLLECTION = 'part';

  /**
   * Коллекция представления
   */
  public const COLLECTION_VIEW = 'search_part';

  /**
   * Поиск 
   *
   * @param string $text Текст поиска
   * @param array &$errors Журнал ошибок
   *
   * @return ?_document Инстанция запчасти, если найдена
   */
  public static function search(string $text, array &$errors = []): ?_document {
    try {
      if (collection::init(static::$db->session, self::COLLECTION)) {
        // Инициализированы коллекции

        if ($part = collection::search(static::$db->session, sprintf(
          <<<AQL
            FOR document in %s
            SEARCH ANALYZER(
              LEVENSHTEIN_MATCH(
                document.body,
                '%s',
                3,
                true
              ),
              'text_en'
            )
            LIMIT 1
            SORT BM25(document) DESC
            return document
          AQL,
          static::COLLECTION_VIEW,
          $text
        ))) {
          // Найдена запчасть 

          return $part;
        } else throw new exception('Не удалось найти запчасть');
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

    return null;
  }

}
