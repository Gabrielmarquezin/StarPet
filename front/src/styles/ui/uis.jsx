import { styled } from "styled-components";
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