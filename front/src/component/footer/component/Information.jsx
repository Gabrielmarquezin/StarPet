import React from "react";
import { ContainerSocial } from "../../../styles/footer/footer";
import { StyledLink } from "../../../styles/menu/menu_styles";


export function Information(){
    return(
        <ContainerSocial className="footer-info">
            <StyledLink>Sobre nossa empresa</StyledLink>
            <StyledLink> Politica de Privacidade</StyledLink>
            <StyledLink>Termos de uso</StyledLink>
        </ContainerSocial>
    )
}