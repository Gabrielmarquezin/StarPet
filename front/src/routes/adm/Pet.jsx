import React from "react";
import { ProdutoProvider } from "../../contexts/ProdutoContext";
import { PetWithLoading } from "../user/Pet";
import { Produto } from "./produto";

export function PetFromAdm(){
    return(
        <ProdutoProvider>
            <Produto>
                <PetWithLoading />
            </Produto>
        </ProdutoProvider>
    )
}