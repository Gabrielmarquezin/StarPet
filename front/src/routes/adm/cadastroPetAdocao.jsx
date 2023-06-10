import React from "react";
import { ContainerFormPetAdocao } from "../../component/form/PetForm/PetAdocao/form";
import { AdmMenuV } from "../../component/screens/adm/menu";
import { StyleFormProduto } from "../../styles/form/StyleAdm";
import { Div } from "../../styles/ui/uis";

export function CadastroPetAdocao(){
    return(
        <AdmMenuV>
            <StyleFormProduto>
                <Div className="container-form">
                   <ContainerFormPetAdocao />
                </Div>
            </StyleFormProduto>
        </AdmMenuV>
    )
}