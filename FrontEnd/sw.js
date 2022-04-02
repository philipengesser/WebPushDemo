self.addEventListener('push', function(event) {
    console.log('[Service Worker] Push Received.');
  
    const title = 'It works!';
    const options = {
      body: 'This is a notification.',
      icon: 'images/AndGate.png'
    };
  
    event.waitUntil(self.registration.showNotification(title, options));
  });