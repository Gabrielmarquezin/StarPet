import React from "react";
import { Carrossel } from "../../component/carrossel/carrossel";
import { MenuH } from "../../component/menu/menu";
import anuncio1 from "../../assets/anuncio1.png";
import anuncio2 from "../../assets/anuncio2.png";
import anuncio3 from "../../assets/anuncio3.png";

import img1 from "../../assets/1.jpeg";
import img2 from "../../assets/2.jpg";
import { ContainerProdutos, ProdutosAvaliados, ProdutosRecomendados, SectionBody, Title } from "../../styles/routes/home/HomeStyles";
import { Footer } from "../../component/footer/footer";
import { useEffect } from "react";
import { useState } from "react";
import { getProducts } from "../../functions/FetchProdutos";

export default function Home(){
    const [produto, setProduto] = useState([]);
    const [pets, setPets] = useState([]);

    useEffect(()=>{
        getProducts("produto")
        .then(data => {
            if(data.message){
                setProduto([])
                return
            }
            setProduto(data.map(p => ({photo: "data:image/jpeg;base64,"+p.photo, id: p.cod})))
        })
        .catch(error => setProduto([]))

        getProducts("pet")
        .then(data => {
            if(data.message){
                setPets([])
                return
            }
        setPets(data.map(p => ({photo: "data:image/jpeg;base64,"+p.photo, id: p.cod})))
        })
        .catch(error => setPets([]));

    }, [])

    return (
       <>
        <MenuH />
        <SectionBody>
            <Carrossel  img={[{photo: anuncio1}, {photo: anuncio2}, {photo: anuncio3}]} 
                        widthcarrossel="100%" 
                        heightcarrossel="400px" 
                        autoscroll={true}
            />

            <ContainerProdutos>
                <ProdutosRecomendados>
                    <Title>Produtos Recomendados</Title>
                    <Carrossel  img={produto} 
                                widthcarrossel="100%" 
                                heightcarrossel="172px" 
                                autoscroll={false}
                                sizebutton={25}
                                navigate="produto"
                                id={7}
                    />
                    <Carrossel img={pets} 
                                widthcarrossel="100%" 
                                heightcarrossel="172px" 
                                autoscroll={false}
                                sizebutton={25}
                                navigate="pet"
                                id={7}
                    />
                </ProdutosRecomendados>
                
                <ProdutosAvaliados>
                    <Title>Mais bem avaliados</Title>
                    <Carrossel img={[{photo: img1}, {photo: img2}, {photo: img1}, {photo: img1}, {photo: img1}, {photo: img2}]} 
                            widthcarrossel="100%" 
                            heightcarrossel="172px" 
                            autoscroll={false}
                            sizebutton={25}
                            id={7}
                    />
                </ProdutosAvaliados>
            </ContainerProdutos>
        </SectionBody>
        <Footer />
       </>
    )
}