<?php

declare(strict_types=1);

namespace mirzaev\site\stdm\registry\controllers;

// Файлы проекта
use mirzaev\site\stdm\registry\views\manager;
use mirzaev\site\stdm\registry\models\core as models;
use mirzaev\site\stdm\registry\models\account_model as account;
use mirzaev\site\stdm\registry\models\session_model as session;

// Библиотека для ArangoDB
use ArangoDBClient\Document as _document;

// Фреймворк PHP
use mirzaev\minimal\controller;

// Фреймворк ВКонтакте
use mirzaev\vk\core as vk;
use mirzaev\vk\robots\user as robot;

/**
 * Ядро контроллеров
 *
 * @package mirzaev\site\stdm\registry\controllers
 * @author Arsen Mirzaev Tatyano-Muradovich <arsen@mirzaev.sexy>
 */
class core extends controller
{
  /**
   * Переменные окружения
   */
  protected robot $vk;

  /**
   * Переменные окружения
   */
  protected array $variables = [];

  /**
   * Конструктор
   *
   * @return void
   */
  public function __construct() {
    parent::__construct();

    // Инициализация ядра моделей (соединение с базой данных...)
    new models();

    // Инициализация журнала ошибок
    $this->variables['errors'] = [
      'account' => []
    ];

    // Инициализация препроцессора представления
    $this->view = new manager;
 }
}
