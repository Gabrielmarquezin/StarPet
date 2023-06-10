import React from "react";
import { AdmMenuV } from "../../component/screens/adm/menu";
import { StylesProdutoFromAdm } from "../../styles/routes/produto/stylesShowProdutos";
import { ProdutoWithLoading } from "../user/Produto";
import { AiOutlineClose } from "react-icons/ai";
import { Div } from "../../styles/ui/uis";
import { useNavigate } from "react-router-dom";

export function Produto({children}){
    const navigate = useNavigate();

    function handleNavigate(){
        navigate("/adm/home/show-produtos/cachorro/pet/todos")
    }
    
    return(
        <AdmMenuV>
            <StylesProdutoFromAdm>
                <Div className="close">
                    <AiOutlineClose size={35} style={{float: "right"}} onClick={handleNavigate} />
                </Div>
                {children}
            </StylesProdutoFromAdm>
        </AdmMenuV>
        
    )
}

export function ProdutoFromAdm(){
    return(
        <Produto>
            <ProdutoWithLoading />
        </Produto>
    )
}