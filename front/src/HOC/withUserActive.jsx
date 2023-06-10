import React from "react";
import { useAuth } from "../hook/useAuth";

export function withUserActive(component){
    return function withUserActiveComponent(){
        const {auth} = useAuth();

        if(auth == null){
            return <ErrorData message="Usuario nao logado, por favor faça seu login" /> 
        }else{
            return <Comment />
        }
    }
}