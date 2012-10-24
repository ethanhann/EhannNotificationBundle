Add Notifications in a Controller
=
```php
   // Get your session service
   $session = $this->get('session');

   // Add a success notification
   $session->getFlashBag()->add('ehann.notice.success', 'Update successful!');

   // Add an informational notification
   $session->getFlashBag()->add('ehann.notice.info', 'btw, you're awesome');

   // Add an error notification
   $session->getFlashBag()->add('ehann.notice.error', 'You broke something!');
```

Show notification in a Twig template
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

{{ notification('error')|raw }}
```