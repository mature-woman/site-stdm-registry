<?php

declare(strict_types=1);

namespace mirzaev\site\stdm\registry\controllers;

// Файлы проекта
use mirzaev\site\stdm\registry\controllers\core,
    mirzaev\site\stdm\registry\models\keys_model as key,
    mirzaev\site\stdm\registry\models\account_model as account;

/**
 * Контроллер поиска 
 *
 * @package mirzaev\site\stdm\registry\controllers
 * @author Arsen Mirzaev Tatyano-Muradovich <arsen@mirzaev.sexy>
 */
final class search_controller extends core
{    
  /**
   * Поиск 
   *
   * @param array $parameters Параметры запроса
   */
  public function search(array $parameters = []): ?string {
    var_dump(account::authorization($parameters['key'], $this->variables['errors']['account']));
    return null;
  }  
}
