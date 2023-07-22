import React from "react";
import { Footer } from "../../component/footer/footer";
import { Div, P } from "../../styles/ui/uis";

export function Sobre(){
    return(
        <>
            <Div style={{maxWidth: "80%", margin: "auto", textAlign: "-moz-initial", marginTop: "100px"}}>
            <P>
            <strong>Sobre a empresa</strong>
            <br />
            <br />
A Star Pet é uma empresa do ramo de PetShop que oferece serviços de banho, tosa, produtos de embelezamento, produtos de alimentação, acessórios, medicação e adoção de filhotes. Os produtos são comercializados para donos de cães, gatos, peixes ornamentais, pássaros e outros pequenos animais (como coelhos e hamsters). A empresa foi criada para atender as necessidades dos donos de animais que desejam um maior bem-estar para o seu pet. 

            </P>
        </Div>
        <Footer />
        </>
    )
}