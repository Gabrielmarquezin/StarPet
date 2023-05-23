import React from "react";
import styles from "../../styles/carrossel/containers.module.css";
import {BoxCarrossel, CarrosselImage, ContainerCarrossel, Imagem } from "../../styles/carrossel/StylesCarrossel";
import { GrFormNext } from 'react-icons/gr';
import { useRef } from "react";
import { useState } from "react";
import { useEffect } from "react";
import { useLocation, useNavigate } from "react-router-dom";



export function Carrossel({img, widthcarrossel, heightcarrossel, autoscroll, sizebutton, id}){
    
    const carrosselEl = useRef(null);
    const Navigate = useNavigate();
    const path = useLocation();
    
    useEffect(()=>{
        if(autoscroll){
           const interval = setInterval(()=>{
                if(carrosselEl.current.scrollLeft == carrosselEl.current.scrollLeftMax){
                    carrosselEl.current.scrollLeft = 0;
                    return;
                 }
                carrosselEl.current.scrollLeft += carrosselEl.current.offsetWidth;
                console.log("render carrossel")
            }, 3500)

            return ()=>{clearInterval(interval)}
        }
    }, [autoscroll])

    function NavigateProduto(){
        const location = path.pathname;

        Navigate(location+`produto/home/search/${id}`)
    }

    function handleNext(){     
        carrosselEl.current.scrollLeft += carrosselEl.current.offsetWidth;
    }

    function handleBack(){
        carrosselEl.current.scrollLeft -= carrosselEl.current.offsetWidth;
    }

    
    return (
        <ContainerCarrossel widthcarrossel={widthcarrossel} heightcarrossel={heightcarrossel}>
            <GrFormNext size={sizebutton || 35} id={styles.icon_moviment} onClick={handleBack}/>
                <BoxCarrossel>
                    <CarrosselImage ref={carrosselEl} onClick={NavigateProduto}>
                        {img.map((src, i) =>(
                            <Imagem src={src} alt={"Imagem Carrossel"} key={i}/>
                        ))}
                    </CarrosselImage>
                </BoxCarrossel>
            <GrFormNext size={sizebutton || 35} id={styles.icon_moviment} style={{rotate: "360deg"}} onClick={handleNext}/>
        </ContainerCarrossel>
    );
}