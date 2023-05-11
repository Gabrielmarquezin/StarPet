import React from "react";
import { ContainerSocial } from "../../../styles/footer/footer";
import { StyledLink } from "../../../styles/menu/menu_styles";


export function Information(){
    return(
        <ContainerSocial>
            <StyledLink>Sobre nossa empresa</StyledLink>
            <StyledLink> Politica de Privacidade</StyledLink>
            <StyledLink>Termos de uso</StyledLink>
        </ContainerSocial>
    )
}