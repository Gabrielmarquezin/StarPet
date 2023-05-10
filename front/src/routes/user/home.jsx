import React from "react";
import { Carrossel } from "../../component/carrossel/carrossel";
import { MenuH } from "../../component/menu/menu";
import img from "../../assets/starpet.png";
import img1 from "../../assets/1.jpeg";
import img2 from "../../assets/2.jpg";

export default function Home(){
    return (
       <>
        <MenuH />
        <Carrossel img={[img1, img2, img1, img2]} widthCarrossel="900px" heightCarrossel="300px" widthImage="100%"/>
       </>
    )
}