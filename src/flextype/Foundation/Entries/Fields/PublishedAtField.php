<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

use Flextype\Component\Filesystem\Filesystem;

if (flextype('registry')->get('flextype.settings.entries.fields.published_at.enabled')) {
    flextype('emitter')->addListener('onEntryAfterInitialized', static function (): void {
        if (flextype('entries')->getStorage('fetch_single.data.published_at') == null) {
            flextype('entries')->setStorage('fetch_single.data.published_at', (int) Filesystem::getTimestamp(flextype('entries')->getFileLocation(flextype('entries')->getStorage('fetch_single.id'))));
        } else {
            flextype('entries')->setStorage('fetch_single.data.published_at', (int) strtotime(flextype('entries')->getStorage('fetch_single.data.published_at')));
        }
    });

    flextype('emitter')->addListener('onEntryCreate', static function (): void {
        if (flextype('entries')->getStorage('create.data.published_at') == null) {
            flextype('entries')->setStorage('create.data.published_at', date(flextype('registry')->get('flextype.settings.date_format'), time()));
        }
    });
}
