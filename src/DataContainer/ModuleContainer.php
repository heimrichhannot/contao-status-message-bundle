<?php

/*
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\StatusMessageBundle\DataContainer;

use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;
use HeimrichHannot\StatusMessageBundle\Manager\StatusMessageManager;
use HeimrichHannot\TwigSupportBundle\Filesystem\TwigTemplateLocator;
use HeimrichHannot\UtilsBundle\Choice\ModelInstanceChoice;
use HeimrichHannot\UtilsBundle\Model\ModelUtil;

class ModuleContainer
{
    const SCOPE_KEY_TYPE_STANDARD = 'standard';
    const SCOPE_KEY_TYPE_MANUAL = 'manual';

    const SCOPE_KEY_TYPES = [
        self::SCOPE_KEY_TYPE_STANDARD,
        self::SCOPE_KEY_TYPE_MANUAL,
    ];

    protected ModelInstanceChoice $modelInstanceChoice;
    protected TwigTemplateLocator $twigTemplateLocator;
    protected ModelUtil           $modelUtil;

    public function __construct(ModelInstanceChoice $modelInstanceChoice, TwigTemplateLocator $twigTemplateLocator, ModelUtil $modelUtil)
    {
        $this->modelInstanceChoice = $modelInstanceChoice;
        $this->twigTemplateLocator = $twigTemplateLocator;
        $this->modelUtil = $modelUtil;
    }

    /**
     * @Callback(table="tl_module", target="fields.statusMessageContext.options")
     */
    public function getStatusMessageContextAsOptions(DataContainer $dc)
    {
        if (null === ($module = $this->modelUtil->findModelInstanceByPk('tl_module', $dc->id)) || !$module->statusMessageScopeType) {
            return [];
        }

        switch ($module->statusMessageScopeType) {
            case StatusMessageManager::SCOPE_TYPE_MODULE:
                $table = 'tl_module';

                break;

            case StatusMessageManager::SCOPE_TYPE_CONTENT_ELEMENT:
                $table = 'tl_content';

                break;

            default:
                // TODO event
                break;
        }

        return $this->modelInstanceChoice->getChoices([
            'dataContainer' => $table,
        ]);
    }

    /**
     * @Callback(table="tl_module", target="fields.statusMessageQueueTemplate.options")
     */
    public function getModuleTemplatesAsOptions(DataContainer $dc)
    {
        return $this->twigTemplateLocator->getPrefixedFiles(
            'huh_status_message_queue_'
        );
    }
}
