import React from "react";
import styles from "../../styles/carrossel/containers.module.css";
import {BoxCarrossel, CarrosselImage, ContainerCarrossel, Imagem } from "../../styles/carrossel/StylesCarrossel";
import { GrFormNext } from 'react-icons/gr';



export function Carrossel({img, widthCarrossel, heightCarrossel, widthImage}){
    return (
        <ContainerCarrossel widthCarrossel={widthCarrossel} heightCarrossel={heightCarrossel}>
            <GrFormNext size={35} id={styles.icon_moviment}/>
                <BoxCarrossel>
                    <CarrosselImage widthImage={widthImage}>
                        {img.map((src) =>(
                            <Imagem src={src} alt={"Imagem Carrossel"}/>
                        ))}
                    </CarrosselImage>
                </BoxCarrossel>
            <GrFormNext size={35} id={styles.icon_moviment}/>
        </ContainerCarrossel>
    );
}