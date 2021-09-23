<?php

/*
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\StatusMessageBundle\Manager;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class StatusMessageManager
{
    const MESSAGE_TYPE_SUCCESS = 'success';
    const MESSAGE_TYPE_WARNING = 'warning';
    const MESSAGE_TYPE_ERROR = 'error';
    const MESSAGE_TYPE_TEXT = 'text';

    const SCOPE_TYPE_GENERAL = 'general';
    const SCOPE_TYPE_MODULE = 'module';
    const SCOPE_TYPE_CONTENT_ELEMENT = 'content_element';

    const SCOPE_TYPES = [
        self::SCOPE_TYPE_GENERAL,
        self::SCOPE_TYPE_MODULE,
        self::SCOPE_TYPE_CONTENT_ELEMENT,
    ];

    const SESSION_KEY = 'huh_status_message';

    protected SessionInterface $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function addMessage(string $text, string $messageType, string $scopeKey): void
    {
        $this->session->getFlashBag()->add(
            $scopeKey,
            [
                'type' => $messageType,
                'text' => $text,
            ]
        );
    }

    public function hasMessages(string $scopeKey): bool
    {
        return $this->session->getFlashBag()->has($scopeKey);
    }

    public function getMessages(string $scopeKey): array
    {
        return $this->session->getFlashBag()->get(
            $scopeKey,
            []
        );
    }

    public function addSuccessMessage(string $text, string $scopeKey): void
    {
        $this->addMessage($text, static::MESSAGE_TYPE_SUCCESS, $scopeKey);
    }

    public function addWarningMessage(string $text, string $scopeKey): void
    {
        $this->addMessage($text, static::MESSAGE_TYPE_WARNING, $scopeKey);
    }

    public function addErrorMessage(string $text, string $scopeKey): void
    {
        $this->addMessage($text, static::MESSAGE_TYPE_ERROR, $scopeKey);
    }

    public function addTextMessage(string $text, string $scopeKey): void
    {
        $this->addMessage($text, static::MESSAGE_TYPE_TEXT, $scopeKey);
    }

    public function getScopeKey(string $scopeType = self::SCOPE_TYPE_GENERAL, $context = null): string
    {
        return static::SESSION_KEY.".$scopeType".($context ? ".$context" : '');
    }
}
