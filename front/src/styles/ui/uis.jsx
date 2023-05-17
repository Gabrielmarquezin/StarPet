import { styled } from "styled-components";
import { Produto } from "../../routes/user/Produto";
import { theme } from "../GlobalStyles";

export const P = styled.p`
    color: ${props => props.theme.color};
    font-family: ${props => props.theme.font}
`;
P.defaultProps = {
    theme
}

export const ButtonSignin = styled.button.attrs((props)=>({
    id: "button-sgnin",
    type: props.type
}))`
    background-color: #32cd32;
    font-family: ${props => props.theme.font};
    color:  white;
    border: none;
    padding: 5px;
    font-size: 0.9rem;
    border-radius: 5px;
    cursor: pointer;
`;
ButtonSignin.defaultProps = {
    theme
};

export const Image = styled.img.attrs((props)=>({
    src: props.src,
    alt: props.alt,
}))`
    width: 100%;
    height: 100%;
    object-fit: cover;
`

export const Span = styled.span`
    font-family: ${props => props.theme.font};
    color: ${props => props.color};
    font-size: ${props => props.size || "1rem"};
`;
Span.defaultProps={
    theme
}

export const Input = styled.input.attrs((props)=>({
    type: props.type,
    value: props.value,
    id: props.id
}))`
    padding: 5px;
    border: none;
    outline: 0;
`;

export const Button = styled.button.attrs((props)=>({
    type: props.type,
    id: props.id,
    value: props.value
}))`
    font-family: ${props => props.theme.font};
    color:  white;
    border: none;
    padding: 5px;
    font-size: 0.9rem;
    border-radius: 5px;
    cursor: pointer;
    background-color: ${props => props.theme.backgroundColor};
    transition: .2s,border-color,.2s,color .2s;

    &:hover{
        opacity: 0.9;
    }
`;
Button.defaultProps = {
    theme
}