import React from "react";
import { ContainerProduto} from "../../component/form/ProdutoForm/form";
import { AdmMenuV } from "../../component/screens/adm/menu";
import { StyleFormProduto } from "../../styles/form/StyleAdm";
import { Div } from "../../styles/ui/uis";

export function AdmCadastro(){
    return(
       <AdmMenuV>
             <StyleFormProduto>
               <Div className="container-form">
                    <ContainerProduto />
               </Div>
            </StyleFormProduto>
       </AdmMenuV>
    )
}