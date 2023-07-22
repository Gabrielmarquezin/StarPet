import React from "react";
import { AiOutlineInstagram } from 'react-icons/ai';
import { BsFacebook } from 'react-icons/bs';
import { AiOutlineWhatsApp } from 'react-icons/ai';
import { ContainerSocial } from "../../../styles/footer/footer";
import { Link } from "react-router-dom";

export function SocialIcons(){
    return(
        <ContainerSocial className="social-icons">
            <Link to={"/facebook"}>
                <BsFacebook size={38} style={{color: "#ffffff"}}/>
            </Link>
            <Link to={"/whatzapp"}>
                <AiOutlineWhatsApp size={40} style={{color: "#25D366"}}/>
            </Link>
            <Link to={"https://www.instagram.com/starpett_/"}>
                <AiOutlineInstagram size={40} style={{ background: 'radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%)', color: "white", borderRadius: "5px"}}/>
            </Link>
        </ContainerSocial>
    )
}