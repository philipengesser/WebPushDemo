
if ('serviceWorker' in navigator && 'PushManager' in window) {
    console.log('Service Worker and Push is supported');
  
    navigator.serviceWorker.register('sw.js')
    .then(function(swReg) {
        console.log('Service Worker is registered', swReg);
        
        swReg.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: "BM92XKYODFOd5Tmt2RAc-5u8s2sP9d1MbAZ5H2EqupdKhvge0mqqmStKDuaUU5dB0hEAzjmRWFQXdnlse4L8TFc"
        })
          .then(function (subscription) {
          console.log('User is subscribed.');
          console.log("json:" + JSON.stringify(subscription));
        });
    });
}