import React from "react";
import { LoadingVersio2 } from "../../../styles/loading";

export function Loading2Version(){
    return(
        <LoadingVersio2>
            <div className="lds-ring">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </LoadingVersio2>
    )
}