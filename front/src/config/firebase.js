import { initializeApp } from "firebase/app";
import { getAuth } from "firebase/auth";

// TODO: Add SDKs for Firebase products that you want to use

// https://firebase.google.com/docs/web/setup#available-libraries


// Your web app's Firebase configuration

// For Firebase JS SDK v7.20.0 and later, measurementId is optional

const firebaseConfig = {

  apiKey: "AIzaSyCFtlksTOUq0p8wDSiWOzMAMdoJUZ_obG4",

  authDomain: "starpet-70f4b.firebaseapp.com",

  projectId: "starpet-70f4b",

  storageBucket: "starpet-70f4b.appspot.com",

  messagingSenderId: "1035959815244",

  appId: "1:1035959815244:web:cdcf068bd30d27c02cf8e9",

  measurementId: "G-0G9CKLXNVB"

};


// Initialize Firebase

export const app = initializeApp(firebaseConfig);
export const auth = getAuth(app)
