<?php

use HeimrichHannot\StatusMessageBundle\Controller\FrontendModule\StatusMessageQueueModuleController;
use HeimrichHannot\StatusMessageBundle\DataContainer\ModuleContainer;

$dca = &$GLOBALS['TL_DCA']['tl_module'];

/**
 * Palettes
 */
$dca['palettes']['__selector__'][] = 'statusMessageFlashBagKeyMode';

$dca['palettes'][StatusMessageQueueModuleController::TYPE] =
    '{title_legend},name,headline,type;{config_legend},statusMessageFlashBagKeyMode;{template_legend:hide},statusMessageQueueTemplate,customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

/**
 * Subpalettes
 */
$dca['subpalettes']['statusMessageFlashBagKeyMode_' . ModuleContainer::FLASH_BAG_KEY_TYPE_STANDARD] = 'statusMessageFlashBagType,statusMessageContext';
$dca['subpalettes']['statusMessageFlashBagKeyMode_' . ModuleContainer::FLASH_BAG_KEY_TYPE_MANUAL]   = 'statusMessageFlashBagTypeTextual';

/**
 * Fields
 */
$fields = [
    'statusMessageFlashBagKeyMode' => [
        'exclude'   => true,
        'filter'    => true,
        'inputType' => 'select',
        'options'   => ModuleContainer::FLASH_BAG_KEY_TYPES,
        'reference' => &$GLOBALS['TL_LANG']['tl_module']['reference']['huhStatusMessageBundle'],
        'eval'      => ['tl_class' => 'w50', 'mandatory' => true, 'includeBlankOption' => true, 'submitOnChange' => true],
        'sql'       => "varchar(16) NOT NULL default 'standard'"
    ],
    'statusMessageFlashBagType'    => [
        'exclude'   => true,
        'filter'    => true,
        'inputType' => 'select',
        'options'   => \HeimrichHannot\StatusMessageBundle\Manager\StatusMessageManager::FLASH_BAG_TYPES,
        'reference' => &$GLOBALS['TL_LANG']['tl_module']['reference']['huhStatusMessageBundle'],
        'eval'      => ['tl_class' => 'w50', 'mandatory' => true, 'includeBlankOption' => true, 'submitOnChange' => true],
        'sql'       => "varchar(16) NOT NULL default ''"
    ],
    'statusMessageContext'         => [
        'exclude'   => true,
        'filter'    => true,
        'inputType' => 'select',
        'eval'      => ['tl_class' => 'w50', 'mandatory' => true, 'includeBlankOption' => true, 'chosen' => true],
        'sql'       => "varchar(64) NOT NULL default ''"
    ],
    'statusMessageQueueTemplate'                 => [
        'exclude'   => true,
        'filter'    => true,
        'inputType' => 'select',
        'eval'      => ['tl_class' => 'w50', 'includeBlankOption' => true, 'chosen' => true],
        'sql'       => "varchar(64) NOT NULL default ''",
    ],
];

$dca['fields'] = array_merge(is_array($dca['fields']) ? $dca['fields'] : [], $fields);
