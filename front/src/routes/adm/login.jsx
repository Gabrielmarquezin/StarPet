import React from "react";
import { LoginAdmWithLoading } from "../../component/form/login/loginAdm";
import { StyleForm } from "../../styles/form/StyleAdm";


export function LoginAdm(){
    return(
        <StyleForm>
            <LoginAdmWithLoading />
        </StyleForm>
    )
}