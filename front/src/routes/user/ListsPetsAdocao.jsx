import React from "react";
import { CardProduto } from "../../component/cards/produto/components/card";
import NoImage from "../../assets/noimage.png";
import { withLoadingAndFetch } from "../../HOC/withLoadingAndFetch";
import { Section } from "../../styles/card/produtoStyles/produtoStyleCard";
import { Main } from "../../styles/routes/produto/stylesShowProdutos";
import { ErrorData } from "../../component/error/EmptyDataError";
import { Footer } from "../../component/footer/footer";

const dominio = process.env.API_KEY;
async function fetchData(){
    try {
        const request = await fetch(dominio+"/StarPet/backend/products/pet/adocao");
        const response = await request.json();

        return response;
    } catch (error) {
        console.log(error);

    }
}
function ListPetsAdocao({data}){

    if(data.message){
        return <ErrorData message={"nenhum pet disponivel para adotar"} />
    }

    return(
    <>
        <Main>
            <Section>
                {data.map((p, i) => (
                    <CardProduto src={p.photo == "" ? NoImage : "data:image/jpeg;base64,"+p.photo} 
                                    nome={p.nome}
                                    id={p.cod} 
                                    type={"adocao"}
                                    descricao={p.descricao}
                                    preco={p.adotado == 1 && "ADOTADO"}
                                    key={i}
                    />
                ))}
            </Section>
        </Main>
        <Footer />
    </>
    )
}


export const ListPetsAdocoaWithLoading = withLoadingAndFetch(ListPetsAdocao, fetchData);