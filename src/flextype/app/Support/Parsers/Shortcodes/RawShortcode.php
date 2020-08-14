<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Thunder\Shortcode\EventHandler\FilterRawEventHandler;
use Thunder\Shortcode\Events;

if ($flextype->container('registry')->get('flextype.settings.shortcode.shortcodes.raw.enabled')) {

    // Shortcode: [raw]
    $flextype->container('shortcode')->addHandler('raw', function (ShortcodeInterface $s) use ($flextype) {
        return $s->getContent();
    });

    $flextype->container('shortcode')->addEventHandler(Events::FILTER_SHORTCODES, new FilterRawEventHandler(['raw']));
}
