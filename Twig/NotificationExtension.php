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

    public function notification($type = 'all', $showIcons = false)
    {
        $notificationTypes = array('info', 'error', 'warn', 'success');

        if (!in_array($type, $notificationTypes) && $type !== 'all') {
            throw new \Exception('Notification type does not exist.');
        }

        if ($type !== 'all') {
            $notificationTypes = array($type);
        }

        $notifications = '';
        $icon = '';


        $notificationIcons = array(
            'info' => 'icon-info-sign',
            'warn' => 'icon-warning-sign',
            'error' => 'icon-warning-sign',
            'success' => 'icon-ok',
        );

        foreach ($notificationTypes as $notificationType) {
            foreach ($this->session->getFlashBag()->get('ehann.notice.' . $notificationType, array()) as $message) {
                $escapedMessage = htmlspecialchars($message);

                if ($showIcons) {
                    $iconClass = $notificationIcons[$notificationType];
                    $icon = "<i class='$iconClass'></i>";
                }

                $notifications .= "<div class='ehann-notification alert alert-$notificationType'>$icon<span> $escapedMessage</span></div>";
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