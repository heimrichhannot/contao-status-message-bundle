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
    const MESSAGE_TYPE_ERROR   = 'error';
    const MESSAGE_TYPE_TEXT    = 'text';

    const FLASH_BAG_TYPE_GENERAL         = 'general';
    const FLASH_BAG_TYPE_MODULE          = 'module';
    const FLASH_BAG_TYPE_CONTENT_ELEMENT = 'content_element';

    const FLASH_BAG_TYPES = [
        self::FLASH_BAG_TYPE_GENERAL,
        self::FLASH_BAG_TYPE_MODULE,
        self::FLASH_BAG_TYPE_CONTENT_ELEMENT,
    ];

    const SESSION_KEY = 'huh_status_message';

    protected SessionInterface $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function addMessage(string $text, string $messageType, string $flashBagKey): void
    {
        $this->session->getFlashBag()->add(
            $flashBagKey,
            [
                'type' => $messageType,
                'text' => $text
            ]
        );
    }

    public function hasMessages(string $flashBagKey): bool
    {
        return $this->session->getFlashBag()->has($flashBagKey);
    }

    public function getMessages(string $flashBagKey): array
    {
        return $this->session->getFlashBag()->get(
            $flashBagKey,
            []
        );
    }

    public function addSuccessMessage(string $text, string $flashBagKey): void
    {
        $this->addMessage($text, static::MESSAGE_TYPE_SUCCESS, $flashBagKey);
    }

    public function addWarningMessage(string $text, string $flashBagKey): void
    {
        $this->addMessage($text, static::MESSAGE_TYPE_WARNING, $flashBagKey);
    }

    public function addErrorMessage(string $text, string $flashBagKey): void
    {
        $this->addMessage($text, static::MESSAGE_TYPE_ERROR, $flashBagKey);
    }

    public function addTextMessage(string $text, string $flashBagKey): void
    {
        $this->addMessage($text, static::MESSAGE_TYPE_TEXT, $flashBagKey);
    }

    public function getFlashBagKey(string $flashBagType = self::FLASH_BAG_TYPE_GENERAL, $context = null): string
    {
        return static::SESSION_KEY . ".$flashBagType." . ($context ? ".$context" : "");
    }
}
