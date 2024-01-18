// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { Loader } from "@googlemaps/js-api-loader";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyBm7gd-Z_d-t5J6f3akvqdHB7JGttEu4Z0",
    authDomain: "company-expo-8a6b0.firebaseapp.com",
    projectId: "company-expo-8a6b0",
    storageBucket: "company-expo-8a6b0.appspot.com",
    messagingSenderId: "978960378772",
    appId: "1:978960378772:web:9cc7992a04fd640cd0bd81",
    measurementId: "G-MHJHJEV5EL"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

const loader = new Loader({
    apiKey: 'AIzaSyBm7gd-Z_d-t5J6f3akvqdHB7JGttEu4Z0',
    version: 'weekly',
    libraries: ['places']
});

export { app, analytics, loader };
