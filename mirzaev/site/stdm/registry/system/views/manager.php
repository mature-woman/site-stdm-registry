<?php

declare(strict_types=1);

namespace mirzaev\site\stdm\registry\views;

// Файлы проекта
use mirzaev\minimal\controller;

// Препроцессор для HTML
use Twig\Loader\FilesystemLoader,
    Twig\Environment as view,
    Twig\Extra\Markdown\MarkdownExtension,
    Twig\Extra\Markdown\DefaultMarkdown,
    Twig\Extra\Markdown\MarkdownRuntime,
    Twig\RuntimeLoader\RuntimeLoaderInterface;

/**
 * Менеджер представлений
 *
 * @package mirzaev\stdm\registry\virus\controllers
 * @author Arsen Mirzaev Tatyano-Muradovich <arsen@mirzaev.sexy>
 */
final class manager extends controller
{
  public function render(string $file, array $vars = []): ?string
  {
    // Инициализация ядра
    $view = new view(new FilesystemLoader(VIEWS));

    // Инициализация модулей
    $view->addExtension(new MarkdownExtension);
    $view->addRuntimeLoader(new class implements RuntimeLoaderInterface {
      public function load($class) {
        if (MarkdownRuntime::class === $class) {
          return new MarkdownRuntime(new DefaultMarkdown());
        }
      }
    });

    // Генерация представления
    return $view->render($file, $vars);
  }
}
