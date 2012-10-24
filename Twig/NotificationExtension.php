<?php

namespace Ehann\NotificationBundle\Twig;

use Twig_Extension;
use Twig_Function_Method;

/**
 * Twig Extension for front-end notifications
 *
 */
class NotificationExtension extends Twig_Extension
{
    private $session;

    public function __construct($session)
    {
        $this->session = $session;
    }

    /**
     * Returns all the defined functions
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            'notification' => new Twig_Function_Method($this, 'notification'));
    }

    public function notification($type = 'all')
    {
        $notificationTypes = array('info', 'error', 'success');

        if (!in_array($type, $notificationTypes) && $type !== 'all') {
            throw new \Exception('Notification type does not exist.');
        }

        if ($type !== 'all') {
            $notificationTypes = array($type);
        }

        $notifications = '';

        foreach ($notificationTypes as $notificationType) {
            foreach ($this->session->getFlashBag()->get('ehann.notice.' . $notificationType, array()) as $message) {
                $notifications .= sprintf("<div class='alert alert-%s'>$message</div>", $notificationType);
            }
        }

        return $notifications;
    }

    /**
     * Gets name of this extension
     *
     * @return string Name of extension
     */
    public function getName()
    {
        return 'notification_extension';
    }
}