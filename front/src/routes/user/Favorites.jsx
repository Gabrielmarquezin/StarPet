import React from "react";
import { useEffect } from "react";
import { useState } from "react";
import { CardProduto } from "../../component/cards/favorite/favorite";
import { ErrorData } from "../../component/error/EmptyDataError";
import { withLoadingAndFetch } from "../../HOC/withLoadingAndFetch";
import { Section } from "../../styles/routes/produto/StyleProdutoSaved";
import { Span, P, Hr, Div} from "../../styles/ui/uis";

const dominio = process.env.API_KEY;

async function fetchData(){
    const favorites = JSON.parse(localStorage.getItem("favorites"))
    if(favorites.length == 0){
        return [];  
    }

    const requests = favorites.map(f => f.type == "pet" ? fetch(dominio+`/StarPet/backend/products/pet?id=${f.cod}`) : fetch(dominio+`/StarPet/backend/products?id=${f.cod}`))
    try {
        const responses =  await Promise.all(requests);
        let datas = await  Promise.all(responses.map(response => response.json()));
        datas = datas.flat()

        return datas;
    } catch (error) {
        console.log(error)
    }

}
function Favorites({data}){
    const [produto, setProduto] = useState([
        {
            src: "", 
            quantidade: "", 
            nome: "", preco: "", 
            descricao: ""
        }
    ]);


    useEffect(()=>{
        setProduto(data)
        console.log(data)
        return ()=> {setProduto({})}
    }, [data])

    return(
        <Section>
            <P>FAVORITES</P>
            <Hr />
            {produto.length == 0 && <ErrorData message={"nenhum produto favoritado"} />}
            <Div className="ui-container-all">
                {produto.length > 0 
                    && produto.map((d, i) => (
                        <CardProduto src={"data:image/jpeg;base64,"+d.photo} 
                                    quantidade={"1"} 
                                    nome={d.nome} 
                                    preco={d.preco} 
                                    descricao={d.descricao}
                                    navigation={true}
                                    type={d.fichatec ? "produto" : "pet"}
                                    cod={d.cod}
                                    key={i}  
                        />
                ))}
            </Div>
        </Section>
    )
}

export const FavoritesWithLoading = withLoadingAndFetch(Favorites, fetchData)