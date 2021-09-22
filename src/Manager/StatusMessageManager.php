<?php

/*
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\StatusMessageBundle\Util;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class StatusMessageManager
{
    protected SessionInterface $session;

    public function __construct(SessionInterface $session) {
        $this->session = $session;
    }
}
