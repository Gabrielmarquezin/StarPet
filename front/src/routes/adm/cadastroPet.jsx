import React from "react";
import { ContainerFormPet } from "../../component/form/PetForm/form";
import { AdmMenuV } from "../../component/screens/adm/menu";
import { StyleFormProduto } from "../../styles/form/StyleAdm";
import { Div } from "../../styles/ui/uis";

export function CadastroPet(){
    return (
        <AdmMenuV>
            <StyleFormProduto>
                <Div className="container-form">
                    <ContainerFormPet />
                </Div>
            </StyleFormProduto>
        </AdmMenuV>
    )
}