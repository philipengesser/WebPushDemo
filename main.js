
if ('serviceWorker' in navigator && 'PushManager' in window) {
    console.log('Service Worker and Push is supported');
  
    navigator.serviceWorker.register('sw.js')
    .then(function(swReg) {
        console.log('Service Worker is registered', swReg);
        
        swReg.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: urlBase64ToUint8Array("BM92XKYODFOd5Tmt2RAc-5u8s2sP9d1MbAZ5H2EqupdKhvge0mqqmStKDuaUU5dB0hEAzjmRWFQXdnlse4L8TFc")
        })
          .then(function (subscription) {
          console.log('User is subscribed.');
          console.log("json:" + JSON.stringify(subscription));
          //updateSubscriptionOnServer(subscription);
        });
    });
}
  
// Web-Push
// Public base64 to Uint
function urlBase64ToUint8Array(base64String) {
  var padding = '='.repeat((4 - base64String.length % 4) % 4);
  var base64 = (base64String + padding)
      .replace(/\-/g, '+')
      .replace(/_/g, '/');

  var rawData = window.atob(base64);
  var outputArray = new Uint8Array(rawData.length);

  for (var i = 0; i < rawData.length; ++i) {
      outputArray[i] = rawData.charCodeAt(i);
  }
  return outputArray;
}