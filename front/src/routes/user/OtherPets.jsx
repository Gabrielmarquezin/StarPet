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

    const type = window.location.pathname.split("/").pop();
    try {
        const request = await fetch(dominio+`/StarPet/backend/products/categoria?name=passaro&tipo=${type}`);
        const response = await request.json();

        return response;
    } catch (error) {
        console.log(error);

    }
}
function ListOthersPets({data}){

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
                                    descricao={p.descricao}
                                    preco={p.preco}
                                    type={"pet"}
                                    key={i}
                    />
                ))}
            </Section>
        </Main>
        <Footer />
    </>
    )
}

export const OtherPets = withLoadingAndFetch(ListOthersPets, fetchData);