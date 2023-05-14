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

export const ContainerProfile = styled.div`
    display: flex;
    flex-direction: column;
    position: relative;

    .profile-event{
        outline: 4px solid #c0bdbdda;
        border-radius: 50%;
        padding: 2px;
    }
`;

export const Triangle = styled.div`
  width: 0;
  height: 0;
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-top: 10px solid #CAF0F8;
  rotate: 180deg;
  align-self: center;
`;

export const ProfileInfo = styled.div.attrs(()=>({
    className: "profile_info"
}))`
    display: flex;
    flex-direction: column;
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translate(-50%, 20%);
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.5s;
    z-index: 1;
`;

export const Info = styled.div`
    background-color: #CAF0F8;
    display: flex;
    flex-direction: column;
    border-radius: 5px;
    gap: 10px;
    padding: 5px;
`;

export const ContainerButtonSignin = styled.div`
    background-color: #CAF0F8;
    padding: 5px;
`


export const ImagePerfil = styled.div`
    border-radius: 50%;
    max-width: 32px;
    max-height: 32px;

    .profile-loading{
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 3px solid white;
        border-top: 3px solid transparent;
        border-bottom: 3px solid transparent;
        animation: rotate 0.7s linear infinite
    }

    @keyframes rotate{
        0%{
            transform: rotate(0);
        }
        100%{
            transform: rotate(360deg);
        }
    }
`;

export const Profile = styled.img.attrs((props)=>({
    src: props.src,
    alt: props.alt,
    className: "profile profile-loading"
}))`
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
`;


