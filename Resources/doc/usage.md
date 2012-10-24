Add Notifications in a Controller
=
   // Get your session service

   $session = $this->get('session');

   // Add a success notification

   $session->getFlashBag()->add('ehann.notice.success', 'Update successful!');

   // Add an informational notification
   $session->getFlashBag()->add('ehann.notice.info', 'btw, you're awesome');

   // Add an error notification
   $session->getFlashBag()->add('ehann.notice.error', 'You broke something!');


Show notification in a Twig template
=
Add this line somewhere in your template. A good place is usually below your header, and above your content.

{{ notification()|raw }}