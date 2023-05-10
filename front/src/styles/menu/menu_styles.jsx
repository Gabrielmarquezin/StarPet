import React from "react";
import { BsMapFill } from "react-icons/bs";
import { Link } from "react-router-dom";
import { styled } from "styled-components";


const theme = {
    font:  "'K2D', sans-serif",
    color: "#EDEBEB"
}

export const Input = styled.input.attrs(props => ({
    type: props.type || "text"
}))`
    background-color: transparent;
    outline: 0;
    border: none;
    padding: 7px;
    width: 100%;
    height: 100%;
`;

export const Ul = styled.ul`
    list-style-type: none;
    background-color: ${props => props.theme === 'pet-blue' ? '#CAF0F8' : ''};
`;

export const Li = styled.li`
    font-family: ${props => props.theme.font};
    color: ${props => props.color ? props.color : props.theme.color};
    padding: 10px
`;
Li.defaultProps = {
    theme,
}

export const StyledLink = styled(Link)`
    font-family: ${props => props.theme.font};
    color: ${props => props.color ? props.color : props.theme.color};
    text-decoration: none;
`;
StyledLink.defaultProps = {
    theme
}

export const Logo = styled.img.attrs(props => ({
    src: props.src,
    alt: props.alt
}))`
    width: 150px;
    height: 150px;
`;

export const Section = styled.section`
    background-color: #00509D;
    width: 100%;
`;

export const MenuTopInfoStyles = styled.div`
    display: flex;
    justify-content: space-between;
    align-items: center;
`;