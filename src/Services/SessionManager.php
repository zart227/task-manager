<?php
namespace Arthur\TaskManager\Services;

/**
 * Сервис для управления сессиями пользователей.
 * Отвечает за работу с сессиями (например, вход и выход пользователей).
 */
class SessionManager
{
    public function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function setSessionData(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function getSessionData(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function destroySession(): void
    {
        if (session_status() !== PHP_SESSION_NONE) {
            // Очищаем данные сессии
            $_SESSION = [];

            // Удаляем cookie сессии (если нужно)
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            // Закрываем сессию
            session_destroy();
        }
    }
}
