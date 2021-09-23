<?php

/*
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

use HeimrichHannot\StatusMessageBundle\Controller\FrontendModule\StatusMessageQueueModuleController;
use HeimrichHannot\StatusMessageBundle\DataContainer\ModuleContainer;

$dca = &$GLOBALS['TL_DCA']['tl_module'];

/*
 * Palettes
 */
$dca['palettes']['__selector__'][] = 'statusMessageScopeKeyMode';

$dca['palettes'][StatusMessageQueueModuleController::TYPE] =
    '{title_legend},name,headline,type;{config_legend},statusMessageScopeKeyMode;{template_legend:hide},statusMessageQueueTemplate,customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

/*
 * Subpalettes
 */
$dca['subpalettes']['statusMessageScopeKeyMode_'.ModuleContainer::FLASH_BAG_KEY_TYPE_STANDARD] = 'statusMessageScopeType,statusMessageScopeContext';
$dca['subpalettes']['statusMessageScopeKeyMode_'.ModuleContainer::SCOPE_KEY_TYPE_MANUAL] = 'statusMessageScopeTypeTextual';

/**
 * Fields.
 */
$fields = [
    'statusMessageScopeKeyMode' => [
        'exclude' => true,
        'filter' => true,
        'inputType' => 'select',
        'options' => ModuleContainer::FLASH_BAG_KEY_TYPES,
        'reference' => &$GLOBALS['TL_LANG']['tl_module']['reference']['huhStatusMessageBundle'],
        'eval' => ['tl_class' => 'w50', 'mandatory' => true, 'includeBlankOption' => true, 'submitOnChange' => true],
        'sql' => "varchar(16) NOT NULL default 'standard'",
    ],
    'statusMessageScopeType' => [
        'exclude' => true,
        'filter' => true,
        'inputType' => 'select',
        'options' => \HeimrichHannot\StatusMessageBundle\Manager\StatusMessageManager::SCOPE_TYPES,
        'reference' => &$GLOBALS['TL_LANG']['tl_module']['reference']['huhStatusMessageBundle'],
        'eval' => ['tl_class' => 'w50', 'mandatory' => true, 'includeBlankOption' => true, 'submitOnChange' => true],
        'sql' => "varchar(16) NOT NULL default ''",
    ],
    'statusMessageScopeContext' => [
        'exclude' => true,
        'filter' => true,
        'inputType' => 'select',
        'eval' => ['tl_class' => 'w50', 'mandatory' => true, 'includeBlankOption' => true, 'chosen' => true],
        'sql' => "varchar(64) NOT NULL default ''",
    ],
    'statusMessageQueueTemplate' => [
        'exclude' => true,
        'filter' => true,
        'inputType' => 'select',
        'eval' => ['tl_class' => 'w50', 'includeBlankOption' => true, 'chosen' => true],
        'sql' => "varchar(64) NOT NULL default ''",
    ],
];

$dca['fields'] = array_merge(is_array($dca['fields']) ? $dca['fields'] : [], $fields);
