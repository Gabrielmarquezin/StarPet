import React from "react";
import { useEffect } from "react";
import { useState } from "react";
import { useLocation } from "react-router-dom";
import { ProdutoRender } from "../../component/cards/produto/ProdutoCard";
import { ErrorData } from "../../component/error/EmptyDataError";
import FilterProdutos from "../../component/menu/filter/FilterMenu";
import { MenuProdutos } from "../../component/menu/menu-h/adm/menuAdm";
import { AdmMenuV } from "../../component/screens/adm/menu";
import { Section } from "../../styles/routes/produto/stylesShowProdutos";
import { Div, Hr, P } from "../../styles/ui/uis";
import { ProdutoContext } from "../user/ProdutoAmostra";

const dominio = process.env.API_KEY;

export function ShowProdutos(){
    const [produto, setProduto] = useState([]);
    const [loading ,setLoading] = useState(true);
    const [empty, setEmpty] = useState(false)

    const path = useLocation().pathname;

    useEffect(()=>{
        
        setEmpty(false)
        fetchProdutos()
        .then((data) => {
            if(data.message){
                setEmpty(true)
                return;
            }
            setProduto(data)
            setLoading(false)
        })
        .catch((error)=>{
            setProduto("error")
        })

        return ()=>setProduto([]);
    }, [path])

    async function fetchProdutos(){
        const uris = path.split("/")
        const categoria = uris[4];
        const tipo = uris[6]

        let link;

        switch(uris[5]){
            case "pet":
                link = `/StarPet/backend/products/pet/categoria?nome=${categoria}`
                break;
            
            case "produto":
                link = `/StarPet/backend/products/categoria?name=${categoria}&tipo=${tipo}`
        }

        try {
            const request = await fetch(dominio+link);
            const response = await request.json();

            return response;
        } catch (error) {
            console.log(error);
        }
    }
    return(
        <AdmMenuV>
            <Section>
                <P style={{fontSize: "1.5rem"}}>PRODUTOS CADASTRADOS</P>
                <Hr />
                <MenuProdutos />

                <ProdutoContext.Provider value={{data: produto}}>
                    <Div className="container-show-produtos">
                        <FilterProdutos />
                       
                       <Div className="ui-produtos">
                            {empty ? <ErrorData message={"Nenhum produto encontrado"} /> : <ProdutoRender isloading={loading}/>}
                       </Div>
                    </Div>
                </ProdutoContext.Provider>
            </Section>
       </AdmMenuV>
    )
}