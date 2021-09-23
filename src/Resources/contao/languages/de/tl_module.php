<?php

/*
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

$lang = &$GLOBALS['TL_LANG']['tl_module'];

/*
 * Fields
 */
$lang['statusMessageScopeKeyMode'][0] = 'Scope-Key-Modus';
$lang['statusMessageScopeKeyMode'][1] = 'Wählen Sie hier aus, ob Sie den Scope-Key manuell oder mit Unterstützung eingeben möchten.';

$lang['statusMessageScopeType'][0] = 'Scope-Typ';
$lang['statusMessageScopeType'][1] = 'Wählen Sie hier einen Typ aus.';

$lang['statusMessageContext'][0] = 'Scope-Kontext';
$lang['statusMessageContext'][1] = 'Wählen Sie hier einen Kontext aus.';

$lang['statusMessageQueueTemplate'][0] = 'Modulinhalts-Template';
$lang['statusMessageQueueTemplate'][1] = 'Wählen Sie hier das gewünschte Template aus.';

/*
 * Reference
 */
$lang['reference']['huhStatusMessageBundle'] = [
    \HeimrichHannot\StatusMessageBundle\DataContainer\ModuleContainer::FLASH_BAG_KEY_TYPE_STANDARD => 'Standard',
    \HeimrichHannot\StatusMessageBundle\DataContainer\ModuleContainer::SCOPE_KEY_TYPE_MANUAL => 'Manuell',

    \HeimrichHannot\StatusMessageBundle\Manager\StatusMessageManager::SCOPE_TYPE_GENERAL => 'Allgemeine Meldungen',
    \HeimrichHannot\StatusMessageBundle\Manager\StatusMessageManager::SCOPE_TYPE_MODULE => 'Meldungen für ein spezielles Modul',
    \HeimrichHannot\StatusMessageBundle\Manager\StatusMessageManager::SCOPE_TYPE_CONTENT_ELEMENT => 'Meldungen für ein spezielles Inhaltselement',
];
