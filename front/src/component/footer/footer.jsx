import React from "react";
import { FooterP } from "../../styles/footer/footer";
import { GiSittingDog } from "react-icons/gi";
import { Information } from "./component/Information";
import { SocialIcons } from "./component/SocialRedes";

export function Footer(){
    return(
        <FooterP>
            <SocialIcons />
            <Information />
            <GiSittingDog size={70}style={{color: "white"}}/>
        </FooterP>
    )
}

export function FooterMin(){
    return(
        <FooterP>
            <SocialIcons />
            <Information />
        </FooterP>
    )
}