<?php

declare(strict_types=1);

namespace mirzaev\site\stdm\registry\controllers;

// Файлы проекта
use mirzaev\site\stdm\registry\controllers\core,
    mirzaev\site\stdm\registry\models\account_model as account,
    mirzaev\site\stdm\registry\models\part_model as part;

/**
 * Контроллер основной страницы
 *
 * @package mirzaev\site\stdm\registry\controllers
 * @author Arsen Mirzaev Tatyano-Muradovich <arsen@mirzaev.sexy>
 */
final class index_controller extends core
{
  /**
   * Главная страница
   *
   * @param array $parameters Параметры запроса
   */
  public function index(array $parameters = []): ?string
  {
    // Инициализация журнала ошибок
    $this->variables['errors']['search'] = [];

    if (!empty($parameters['key']) && !empty($parameters['search'])) {
      // Получены данные поиска

      if (account::authorization($parameters['key'], $this->variables['errors']['account'])) {
        // Авторизован запрос

        // Поиск данных запчасти и запись в переменную
        $this->variables['result'] = part::search($parameters['search'], $this->variables['errors']['search'])->body ?? null;
      }
    }
    
    // Инициализация переменных
    $this->variables['key'] = $parameters['key'] ?? '';
    $this->variables['search'] = $parameters['search'] ?? '';

/* var_dump($this->variables); die; */

    // Генерация представления
    return $this->view->render(DIRECTORY_SEPARATOR . 'index.html', $this->variables);
  }
}
