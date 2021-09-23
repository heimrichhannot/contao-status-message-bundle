<?php

/*
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\StatusMessageBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\ServiceAnnotation\FrontendModule;
use Contao\ModuleModel;
use Contao\Template;
use HeimrichHannot\StatusMessageBundle\DataContainer\ModuleContainer;
use HeimrichHannot\StatusMessageBundle\Manager\StatusMessageManager;
use HeimrichHannot\TwigSupportBundle\Filesystem\TwigTemplateLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * @FrontendModule(StatusMessageQueueModuleController::TYPE,category="miscellaneous")
 */
class StatusMessageQueueModuleController extends AbstractFrontendModuleController
{
    const TYPE = 'huh_status_message_queue';

    protected StatusMessageManager $statusMessageManager;
    protected Environment          $twig;
    protected TwigTemplateLocator  $twigTemplateLocator;

    public function __construct(StatusMessageManager $statusMessageManager, Environment $twig, TwigTemplateLocator $twigTemplateLocator)
    {
        $this->statusMessageManager = $statusMessageManager;
        $this->twig = $twig;
        $this->twigTemplateLocator = $twigTemplateLocator;
    }

    protected function getResponse(Template $template, ModuleModel $module, Request $request): ?Response
    {
        $templateData = [];

        if (ModuleContainer::SCOPE_KEY_TYPE_MANUAL === $module->statusMessageScopeKeyMode) {
            $scopeKey = $module->statusMessageScopeKeyTextual;
        } else {
            $scopeKey = $this->statusMessageManager->getScopeKey(
                $module->statusMessageScopeType,
                $module->statusMessageScopeContext
            );
        }

        $templateData['scopeKey'] = $scopeKey;

        $templateName = $this->twigTemplateLocator->getTemplatePath(
            $module->statusMessageQueueTemplate ?: 'huh_status_message_queue_default.html.twig'
        );

        $template->content = $this->twig->render($templateName, $templateData);

        return $template->getResponse();
    }
}
