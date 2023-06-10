import React from "react";
import { Li, StyledLink, Ul } from "../../../../styles/menu/menu_styles";
import { StyleMenuPerfil } from "../../../../styles/routes/perfil/PerfilStyles";
import { HiOutlineUserCircle } from 'react-icons/hi';
import {BsFillBasketFill} from 'react-icons/bs';
import {GiRainbowStar} from 'react-icons/gi';
import { AiOutlinePlusSquare } from 'react-icons/ai';
import { BsFillBasket2Fill } from "react-icons/bs";
import { BsCardChecklist, BsFillTrashFill} from "react-icons/bs";
import {BiEdit} from "react-icons/bi";

export function MenuPerfil(){
    return(
       <StyleMenuPerfil>
            <Ul>
                <Li>
                    <HiOutlineUserCircle size={35}/>
                    <StyledLink to={"/user/perfil"}>Meu Perfil</StyledLink>
                </Li>
                <Li>
                    <BsFillBasketFill size={30}/>
                    <StyledLink to={"/user/perfil"}>Meus Pedidos</StyledLink>
                </Li>
                <Li>
                    <GiRainbowStar size={30}/>
                    <StyledLink to={"/user/perfil"}>Meus Favoritos</StyledLink>
                </Li>
            </Ul>
       </StyleMenuPerfil>
    )
}

export function MenuAdm(){
    return(
       <StyleMenuPerfil>
            <Ul>
                <Li>
                    <HiOutlineUserCircle size={35}/>
                    <StyledLink to={"/adm/home/perfil"}>Perfil</StyledLink>
                </Li>
                <Li>
                    <AiOutlinePlusSquare size={30}/>
                    <StyledLink to={"/adm/home/cadastrar"}>Cadastrar Produto</StyledLink>
                </Li>
                <Li>
                    <AiOutlinePlusSquare size={30}/>
                    <StyledLink to={"/adm/home/cadastrar/pet"}>Cadastrar Pet</StyledLink>
                </Li>
                <Li>
                    <AiOutlinePlusSquare size={30}/>
                    <StyledLink to={"/adm/home/cadastrar/pet/adocao"}>Cadastrar Pet Adoção</StyledLink>
                </Li>
                <Li>
                    <BsFillBasket2Fill size={30}/>
                    <StyledLink to={"/user/perfil"}>Vendidos</StyledLink>
                </Li>
                <Li>
                    <BsCardChecklist size={30}/>
                    <StyledLink to={"/adm/home/show-produtos/cachorro/pet/todos"}>Produtos Cadastrados</StyledLink>
                </Li>
                <Li>
                    <BiEdit size={30}/>
                    <StyledLink to={"/adm/home/editproduct"}>Editar Produto</StyledLink>
                </Li>
                <Li>
                    <BsFillTrashFill size={25}/>
                    <StyledLink to={"/adm/home/excluir/produto"}>Excluir Produto/pet</StyledLink>
                </Li>
            </Ul>
       </StyleMenuPerfil>
    )
}