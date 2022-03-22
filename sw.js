self.addEventListener('push', function(event) {
    console.log('[Service Worker] Push Received.');
    console.log(`[Service Worker] Push had this data: "${event.data.text()}"`);
  
    const title = 'It works!';
    const options = {
      body: 'This is a notification.',
      icon: 'images/AndGate.png',
      badge: 'images/AndGate.png'
    };
  
    event.waitUntil(self.registration.showNotification(title, options));
  });