import React from "react";
import { StylesMenu, StylesMenuProdutos } from "../../../../styles/menu/MenuAdm/menu";
import { Li, StyledLink, Ul } from "../../../../styles/menu/menu_styles";

export function AdmRoutes(){
    return(
        <StylesMenu>
            <Ul>
                <Li><StyledLink to={"quantidade-produto-cadastrado"}>Quantidade de <br/> produtos cadastrados</StyledLink></Li>
                <Li><StyledLink to={"produtos-cadastrados"}>Produtos cadastrados</StyledLink></Li>
                <Li><StyledLink to={"perfil"}>Perfil</StyledLink></Li>
                <Li><StyledLink to={"vendidos"}>Produtos <br /> vendidos</StyledLink></Li>
                <Li><StyledLink to={"vendidos_banho"}>Pedidos <br /> banho/tosa</StyledLink></Li>
            </Ul>
        </StylesMenu>
    )
}

export function MenuProdutos(){
    return(
        <StylesMenuProdutos>
             <Ul>
                <Li><StyledLink to={"/adm/home/show-produtos/cachorro/pet/todos"}>Cachorro</StyledLink></Li>
                <Li><StyledLink to={"/adm/home/show-produtos/passaro/pet/todos"}>Pássaros</StyledLink></Li>
                <Li><StyledLink to={"/adm/home/show-produtos/gato/pet/todos"}>Gatos</StyledLink></Li>
                <Li><StyledLink to={"/adm/home/show-produtos/peixe/pet/todos"}>Peixe</StyledLink></Li>
            </Ul>
        </StylesMenuProdutos>
    )
}