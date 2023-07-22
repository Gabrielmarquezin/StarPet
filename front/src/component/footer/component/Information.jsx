import React from "react";
import { ContainerSocial } from "../../../styles/footer/footer";
import { StyledLink } from "../../../styles/menu/menu_styles";


export function Information(){
    return(
        <ContainerSocial className="footer-info">
            <StyledLink to={"/termos/sobre"}>Sobre nossa empresa</StyledLink>
            <StyledLink to={"/termos/privacidade"}> Politica de Privacidade</StyledLink>
            <StyledLink to={"/termos/uso"}>Termos de uso</StyledLink>
        </ContainerSocial>
    )
}