Add Notifications in a Controller
=
```php
   // Get your session service
   $session = $this->get('session');

   // Add a success notification
   $session->getFlashBag()->add('ehann.notice.success', 'Update successful!');

   // Add an informational notification
   $session->getFlashBag()->add('ehann.notice.info', 'btw, you\'re awesome');

   // Add an error notification
   $session->getFlashBag()->add('ehann.notice.error', 'You broke something!');
```

Show Notification in a Twig Template
=

Show all notifications...

```twig
{{ notification()|raw }}
```
or 
```twig
{{ notification('all')|raw }}
```

Show notifications individually...
```twig
{{ notification('success')|raw }}

{{ notification('info')|raw }}

{{ notification('warning')|raw }}

{{ notification('error')|raw }}
```

Show all notifications with icons...
```twig
{{ notification('all', true)|raw }}
```

Show notifications individually with icons...
```twig
{{ notification('success', true)|raw }}

{{ notification('info', true)|raw }}

{{ notification('warning', true)|raw }}

{{ notification('error', true)|raw }}
```