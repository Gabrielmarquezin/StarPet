import React from "react";
import { PetWithLoading } from "../user/Pet";
import { Produto } from "./produto";

export function PetFromAdm(){
    return(
        <Produto>
            <PetWithLoading />
        </Produto>
    )
}