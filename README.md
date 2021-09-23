# Contao Status Message Bundle

This bundle offers a status message queue for the frontend of the Contao CMS

## Features

- display status messages of various types (error, success, warning, ...) in the frontend
- works both synchronously and via ajax
- uses symfony's session flash bags internally (see the [symfony documentation](https://symfony.com/doc/4.4/components/http_foundation/sessions.html#flash-messages) for further detail)
- optional pre-styled template for bootstrap 4/5 is shipped within the bundle

## Impressions

![The status message queue in the frontend](docs/img/queue.png "The status message queue in the frontend")

The status message queue in the frontend

## Installation

1. Install via composer: `composer require heimrichhannot/contao-status-message-bundle`.
2. Update your database as usual via migration command or install tool.

## Concepts

### Message scopes

In order to add a new status message, you need to know the following things:

1. What's the **text** of the message you'd like to output?
2. What's the **type** of the message (success, error, ...)?
3. What's the **scope** of the message (general scope, a specific module or content element, ...)?

Particularly, the third parameter could be not obvious. In the context of this bundle, you can create not only one
"status message queue" but as many as you like. In order to distinguish these in the frontend where you output them,
you need to tell the `StatusMessageManager` the scope of the message, you'd like to add.

Currently, the scope can be:

1. **General** -> no specific context
2. **Module** -> a specific frontend module (id must be passed)
3. **Content element** -> a specific frontend content element (id must be passed)

Internally this bundle uses symfony's [session flash bag API](https://symfony.com/doc/4.4/components/http_foundation/sessions.html#flash-messages).
If you're not familiar with these, please take a look into the documentation.

Hence, the **scope** described above is described by the **flash bag key**. For the sake of ease, we call it **scope key** in the context of this bundle.

For example, if you like to bind your messages to a specific module, the scope key might be something like
`huh_status_message.module.1234` whereas `module` is the scope and `1234` is the module id.

## Usage

## Add status messages

```php
use HeimrichHannot\StatusMessageBundle\Manager\StatusMessageManager;

// ...
protected StatusMessageManager $statusMessageManager;
// ...

// use this scope key to output the messages after you've added them (see below)
$scopeKey = $this->statusMessageManager->getScopeKey(
    StatusMessageManager::SCOPE_TYPE_MODULE,
    $module->id
);

$this->statusMessageManager->addSuccessMessage(
    'Everything worked well :-)',
    $scopeKey
);
```

### Output messages via the frontend module "status message queue"

In order to output your status messages, you can create a "status message queue" frontend module and include it in your
article or layout, for example.

**IMPORTANT:** Please take care of the order of inclusion for this module. If you add messages before the queue module
is rendered, the messages are displayed after a site reload only (messages are stored in the session).

### Programmatically output messages in twig templates

Simply pass the scope key (which is the flash bag key internally) to your twig template and use symfony's flash message API to output the messages
(`scopeKey` might be something `huh_status_message.module.1234` whereas `module` is the scope and `1234` is the module id):

```twig
{% if app.session.flashBag.peek(scopeKey) is not empty %}
    {% for message in app.flashes(scopeKey) %}
        <div class="{{ message.type }}">
            {{ message.text }}
        </div>
    {% endfor %}
{% else %}
    {# do something else #}
{% endif %}
```

### Programmatically output messages in traditional html5 templates

At first, so the necessary logic in your module (or content element) controller:

```php
use HeimrichHannot\StatusMessageBundle\Manager\StatusMessageManager;

// ...
protected StatusMessageManager $statusMessageManager;
// ...

protected function getResponse(Template $template, ModuleModel $module, Request $request): ?Response {
    $scopeKey = $this->statusMessageManager->getScopeKey(
        $module->statusMessageScopeType,
        $module->statusMessageScopeContext
    );
    
    $template->hasMessages = $this->statusMessageManager->hasMessages($scopeKey);
    
    if ($template->hasMessages) {
        $template->messages = $this->statusMessageManager->getMessages($scopeKey);
    }
    
    return $template->getResponse();
}

```

Then in your template, use the data as follows:

```html
<?php if ($this->hasMessages): ?>
    <?php foreach ($this->messages as $message): ?>
        <div class="<?= $message['type'] ?>">
            <?= $message['text'] ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <!-- do something else -->
<?php endif; ?>
```

## Developer notes

### Why not use the Contao\Message class?

Of course, we use core classes if they're suiting our needs. One disadvantage is that the scope of a message is always
determined by the scope string **and the message type** (see `static::getFlashBagKey($strType, $strScope)`):

```php
public static function add($strMessage, $strType, $strScope=TL_MODE) {
    // ...

    System::getContainer()->get('session')->getFlashBag()->add(static::getFlashBagKey($strType, $strScope), $strMessage);
}
```

This way, we couldn't have message queues with messages of mixed types.
