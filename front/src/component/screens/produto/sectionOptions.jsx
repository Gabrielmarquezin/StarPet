import React, { useState } from "react";
import { useEffect } from "react";
import { useContext } from "react";
import { PetContext } from "../../../routes/user/Pet";
import { ProdutoContext } from "../../../routes/user/Produto";
import { ContainerTable, Descricao, SectionOpt } from "../../../styles/routes/produto/ProdutoStyle";
import { P } from "../../../styles/ui/uis";

export function SectionOptions({children}){
    const {data} = useContext(ProdutoContext)
    const [produto, setProduto] = useState({})

    useEffect(()=>{
        if(data.length !== 0){
             setProduto(data[0])
        }
     }, [data])

    return(
        <SectionOpt>
            <Descricao>
                <P theme={{color: "#000000"}}>DESCRIÇÃO</P>
                <P theme={{color: "#00000092"}}>{produto.descricao}</P>
            </Descricao>
            <ContainerTable>
                {children}
            </ContainerTable>
        </SectionOpt>
    )
}

export function SectionOptionsPet({children}){
    const {data} = useContext(PetContext)
    const [produto, setProduto] = useState({})

    useEffect(()=>{
        if(data.length !== 0){
             setProduto(data[0])
        }
     }, [data])

    return(
        <SectionOpt>
            <Descricao>
                <P theme={{color: "#000000"}}>DESCRIÇÃO</P>
                <P theme={{color: "#00000092"}}>{produto.descricao}</P>
            </Descricao>
            <ContainerTable>
                {children}
            </ContainerTable>
        </SectionOpt>
    )
}

