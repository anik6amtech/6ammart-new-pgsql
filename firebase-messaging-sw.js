importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyB6SaAO8pfZaqLCqvAQ6T1_dCXMG16q_Sc",
    authDomain: "ammart-test-85433.firebaseapp.com",
    projectId: "ammart-test-85433",
    storageBucket: "ammart-test-85433.firebasestorage.app",
    messagingSenderId: "924571058618",
    appId: "1:924571058618:web:68284aff1eae35b90e1d83",
    measurementId: ""
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    return self.registration.showNotification(payload.data.title, {
        body: payload.data.body ? payload.data.body : '',
        icon: payload.data.icon ? payload.data.icon : ''
    });
});