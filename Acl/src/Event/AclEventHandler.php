<?php
declare(strict_types=1);

namespace Croogo\Acl\Event;

use Cake\Core\Configure;
use Cake\Event\EventListenerInterface;

/**
 * AclEventHandler
 *
 * @package  Croogo.Acl.Event
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class AclEventHandler implements EventListenerInterface
{

    /**
     * implementedEvents
     */
    public function implementedEvents(): array
    {
        return [
            'Dispatcher.beforeDispatch' => [
                'callable' => 'onBeforeDispatch',
                'priority' => 11,
            ],
        ];
    }

    /**
     * Dispatcher.beforeDispatch handler
     */
    public function onBeforeDispatch($event)
    {
        if (!Configure::read('Access Control.splitSession')) {
            return;
        }
        $request = $event->data['request'];
        $cookiePath = $request->base . '/' . $request->param('prefix');
        ini_set('session.cookie_path', $cookiePath);
    }
}
