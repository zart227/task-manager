<?php
namespace Services;

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
        session_destroy();
    }
}
