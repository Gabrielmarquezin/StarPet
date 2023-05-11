import React from "react";
import { Carrossel } from "../../component/carrossel/carrossel";
import { MenuH } from "../../component/menu/menu";
import img1 from "../../assets/1.jpeg";
import img2 from "../../assets/2.jpg";
import { ContainerProdutos, ProdutosAvaliados, ProdutosRecomendados, SectionBody, Title } from "../../styles/routes/home/HomeStyles";
import { Footer } from "../../component/footer/footer";

export default function Home(){
    return (
       <>
        <MenuH />
        <SectionBody>
            <Carrossel img={[img1, img2, img1, img2, img1, img2, img1, img2]} 
                        widthcarrossel="100%" 
                        heightcarrossel="300px" 
                        autoscroll={true}
            />
            <ContainerProdutos>
                <ProdutosRecomendados>
                    <Title>Produtos Recomendados</Title>
                    <Carrossel img={[img1, img2, img2, img2, img1]} 
                                widthcarrossel="100%" 
                                heightcarrossel="172px" 
                                autoscroll={false}
                                sizebutton={25}
                    />
                    <Carrossel img={[img1, img2, img2, img2, img1]} 
                                widthcarrossel="100%" 
                                heightcarrossel="172px" 
                                autoscroll={false}
                                sizebutton={25}
                    />
                </ProdutosRecomendados>
                
                <ProdutosAvaliados>
                    <Title>Mais bem avaliados</Title>
                    <Carrossel img={[img1, img2, img1, img1, img1, img2]} 
                            widthcarrossel="100%" 
                            heightcarrossel="172px" 
                            autoscroll={false}
                            sizebutton={25}
                    />
                </ProdutosAvaliados>
            </ContainerProdutos>
        </SectionBody>
        <Footer />
       </>
    )
}