import { useContext, createContext } from "react";
import {signInWithRedirect, GoogleAuthProvider, getRedirectResult, signOut, signInWithPopup, onAuthStateChanged } from "firebase/auth";
import { auth, app} from "../config/firebase";
import { useState } from "react";
import { useEffect } from "react";


const AuthContext = createContext();

export function AuthContextProvider({children}){
    const [user, setUser] = useState({})

    const signInWithPopUp = ()=>{
       return new Promise((resolve, reject)=>{
            signInWithPopup(auth, new GoogleAuthProvider())
            .then((result) => {
                // This gives you a Google Access Token. You can use it to access the Google API.
                const credential = GoogleAuthProvider.credentialFromResult(result);
                const token = credential.accessToken;
                // The signed-in user info.
                const user = result.user;
                resolve(user)
            }).catch((error) => {
                // Handle Errors here.
                const errorCode = error.code;
                const errorMessage = error.message;
                // The email of the user's account used.
                const email = error.customData.email;
                // The AuthCredential type that was used.
                const credential = GoogleAuthProvider.credentialFromError(error);
                reject(error)
            });
       })
    }

    const SignOutGoogle = ()=>{
        return  new Promise((resolve, reject) => {
            signOut(auth).then(() => {
               resolve("saiu")
            }).catch((error) => {
               reject(error)
            });
          })
    }

    useEffect(()=>{
        const onesubscrive = onAuthStateChanged(auth, (currentUser)=>{
            setUser(currentUser)
        })

        return () => onesubscrive()
    }, [])

    return (
        <AuthContext.Provider value = {{signInWithPopUp, SignOutGoogle, user}}>
            {children}
        </AuthContext.Provider>
    )
}

export function useAuth(){
    return useContext(AuthContext);
}

