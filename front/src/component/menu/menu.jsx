import React from "react";
import { Logo, MenuTopInfoStyles, Section } from "../../styles/menu/menu_styles";
import { InfoIcon } from "./components/configIcons";
import { Lista } from "./components/lista";
import { Paws } from "./components/paws";
import { Search } from "./components/search";
import Imagem from "../../assets/starpet.png";

export function MenuH(){
    return (
      <Section>
         <MenuTopInfoStyles>
            <Logo src={Imagem} alt="Logo" />
            <Search />
            <InfoIcon />
            <Paws />
         </MenuTopInfoStyles>
         <Lista />
      </Section>
    )
}