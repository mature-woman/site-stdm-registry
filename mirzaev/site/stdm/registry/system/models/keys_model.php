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
 * Модель ключей доступа
 *
 * @package mirzaev\site\stdm\registry\models
 * @author Arsen Mirzaev Tatyano-Muradovich <arsen@mirzaev.sexy>
 */
final class keys_model extends core
{
  /**
   * Коллекция
   */
  public const COLLECTION = 'keys';
}
