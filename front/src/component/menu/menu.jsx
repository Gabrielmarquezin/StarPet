import React from "react";
import { Logo, MenuTopInfoStyles, Section } from "../../styles/menu/menu_styles";
import { InfoIcon } from "./components/configIcons";
import { Lista, ListAdm } from "./components/lista";
import { Paws } from "./components/paws";
import { Search } from "./components/search";
import Imagem from "../../assets/starpet.png";
import { Outlet } from "react-router-dom";
import { ProdutoProvider } from "../../contexts/ProdutoContext";

export function MenuH(){
    return (
      <ProdutoProvider>
         <Section>
            <MenuTopInfoStyles>
               <Logo src={Imagem} alt="Logo" />
               <Search />
               <InfoIcon />
               <Paws />
            </MenuTopInfoStyles>
            <Lista />
         </Section>
         <Outlet />
      </ProdutoProvider>
    )
}

export function MenduAdm(){
   return (
      <>
         <Section>
            <MenuTopInfoStyles>
               <Logo src={Imagem} alt="Logo" />
               <Search />
               <InfoIcon />
               <Paws />
            </MenuTopInfoStyles>
            <ListAdm />
         </Section>
         <Outlet />
      </>
    )
}