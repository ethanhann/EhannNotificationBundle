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
            'notification' => new Twig_Function_Method($this, 'notification')
        );
    }

    /**
     * @param string $type    The type of notification to display: all|info|error|warning|success
     * @param bool $showIcons Display icons before the notification's text.
     * @param bool $repeat    Show the same message more than once.
     *
     * @return string HTML notification elements.
     *
     * @throws \Exception
     */
    public function notification($type = 'all', $showIcons = false, $repeat = true)
    {
        $notificationTypes = array('info', 'error', 'warning', 'success');

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
            'warning' => 'icon-warning-sign',
            'error' => 'icon-warning-sign',
            'success' => 'icon-ok',
        );

        // This is used to keep track of repeated messages, with regard to the "repeat" flag
        $repeatedMessages = array(
            'info' => array(),
            'warning' => array(),
            'error' => array(),
            'success' => array(),
        );

        foreach ($notificationTypes as $notificationType) {
            $messagesByType = $this->session->getFlashBag()->get('ehann.notice.' . $notificationType, array());
            foreach ($messagesByType as $message) {
                // Do not show duplicate messages if the "repeat" flag is false.
                if ($repeat || !in_array($message, $repeatedMessages[$notificationType])) {
                    $repeatedMessages[$notificationType][] = $message;
                    $escapedMessage = htmlspecialchars($message);

                    if ($showIcons) {
                        $iconClass = $notificationIcons[$notificationType];
                        $icon = "<i class='$iconClass'></i>";
                    }

                    $notifications .= "<div class='ehann-notification alert alert-$notificationType'>$icon<span> $escapedMessage</span></div>";
                }
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