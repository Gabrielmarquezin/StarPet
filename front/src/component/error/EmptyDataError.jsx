import React from "react";
import { ErrorContainer } from "../../styles/error/error";

export function ErrorData({message}){
    return(
        <ErrorContainer>
            {message}
        </ErrorContainer>
    )
}