<?php

$lang = &$GLOBALS['TL_LANG']['tl_module'];

/**
 * Fields
 */
$lang['statusMessageFlashBagKeyMode'][0] = 'FlashBagKey-Modus';
$lang['statusMessageFlashBagKeyMode'][1] = 'Wählen Sie hier aus, ob Sie den FlashBagKey manuell oder mit Unterstützung eingeben möchten.';

$lang['statusMessageFlashBagType'][0] = 'FlashBagKey-Typ';
$lang['statusMessageFlashBagType'][1] = 'Wählen Sie hier einen Typ aus.';

$lang['statusMessageContext'][0] = 'FlashBagKey-Kontext';
$lang['statusMessageContext'][1] = 'Wählen Sie hier einen Kontext aus.';

$lang['statusMessageQueueTemplate'][0] = 'Modulinhalts-Template';
$lang['statusMessageQueueTemplate'][1] = 'Wählen Sie hier das gewünschte Template aus.';

/*
 * Reference
 */
$lang['reference']['huhStatusMessageBundle'] = [
    \HeimrichHannot\StatusMessageBundle\DataContainer\ModuleContainer::FLASH_BAG_KEY_TYPE_STANDARD => 'Standard',
    \HeimrichHannot\StatusMessageBundle\DataContainer\ModuleContainer::FLASH_BAG_KEY_TYPE_MANUAL   => 'Manuell',

    \HeimrichHannot\StatusMessageBundle\Manager\StatusMessageManager::FLASH_BAG_TYPE_GENERAL         => 'Allgemeine Meldungen',
    \HeimrichHannot\StatusMessageBundle\Manager\StatusMessageManager::FLASH_BAG_TYPE_MODULE          => 'Meldungen für ein spezielles Modul',
    \HeimrichHannot\StatusMessageBundle\Manager\StatusMessageManager::FLASH_BAG_TYPE_CONTENT_ELEMENT => 'Meldungen für ein spezielles Inhaltselement',
];
