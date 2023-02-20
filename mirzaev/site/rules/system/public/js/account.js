"use strict";

class account {
    static async initialization() {
        // Запрос
        return fetch('https://rules.mirzaev.sexy/account/initialization', {
            method: 'PUT'
        });
    }

    static authentication(button) {
        if (button instanceof HTMLElement) {
            // Получены обязательные входные параметры

            if (button.classList.contains('active')) {
                // Кнопка активна (подразумевается)

                if (window.vk !== undefined) {
                    // Найдена инстанция окна

                    // Закрытие окна
                    window.vk.close();

                    // Удаление окна
                    window.vk = undefined;
                }

                // Генерация панели
                this.panel(button.parentElement);

                // Вызов троллера
                troller.what.single();
            } else {
                // Кнопка неактивна (подразумевается)

                // Инициализация активного статуса
                button.classList.add('active');
                button.innerText = 'Закрыть';

                // Настройка окна
                const width = 500;
                const height = 500;
                const left = (window.screen.width / 2) - ((width / 2) + 10);
                const top = (window.screen.height / 2) - ((height / 2) + 50);

                // Инициализация аккаунта
                this.initialization()
                    .then(
                        (response) => {
                            if (response.status === 401 && typeof response.headers.get('session') === 'string') {
                                // Получен код ответа 401 (не аутентифицирован) и инициализирован аккаунт

                                // Открытие окна с аунтентификацией ВКонтакте
                                window.vk = window.open(
                                    'https://oauth.vk.com/authorize?client_id=51447080&redirect_uri=https://rules.mirzaev.sexy/account/vk/connect&display=popup&response_type=code&scope=4521990&state=' + response.headers.get('session'),
                                    'rules_vk',
                                    'left=' + left + ',top=' + top + ',width=' + width + ',height=' + height + ',resizable=no,status=no,toolbar=no,menubar=no,scrollbars=no,location=no,directories=no'
                                );

                                // Инициализация ссылки на ядро
                                const _this = this;

                                // Инициализация интервала проверки закрытия окна с аунтентификацией ВКонтакте
                                const interval = setInterval(function () {
                                    if (window.vk.closed || window.vk === undefined) {
                                        // Окно с аутентификацией закрыто

                                        // Удаление интервала
                                        clearInterval(interval);

                                        // Генерация панели
                                        _this.panel(button.parentElement);
                                    }
                                }, 100);
                            } else if (response.status === 200) {
                                // Получен код ответа 200 (аутентифицирован)

                                // Генерация панели
                                this.panel(button.parentElement);
                            }
                        }
                    );

            }

            return true;
        }
    }

    static deauthentication() {
        if (shell instanceof HTMLElement) {
            // Получены обязательные входные параметры

            fetch('https://rules.mirzaev.sexy/account/panel', {
                method: 'GET'
            }).then(
                (response) => {
                    if (response.status === 200) {
                        // Получен код ответа 200

                        response.text().then(
                            (text) => {
                                console.log(text);

                                // Запись панели в оболочку
                                shell.outerHTML = text;
                            }
                        );
                    }
                }
            );
        }
    }

    static async panel(shell) {
        if (shell instanceof HTMLElement) {
            // Получены обязательные входные параметры

            fetch('https://rules.mirzaev.sexy/account/panel', {
                method: 'GET'
            }).then(
                (response) => {
                    if (response.status === 200) {
                        // Получен код ответа 200

                        response.text().then(
                            (text) => {
                                console.log(text);

                                // Запись панели в оболочку
                                shell.outerHTML = text;
                            }
                        );
                    }
                }
            );
        }
    }
}
