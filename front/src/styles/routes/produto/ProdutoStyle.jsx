import { styled } from "styled-components";
import { theme } from "../../GlobalStyles";

export const Location = styled.span`
    color: ${props => props.theme.color};
    font-family: ${props => props.theme.font};
    font-size: 1rem;
`;
Location.defaultProps = {
    theme
}

export const Div = styled.div`
    padding-left: 20px;
    margin-top: 50px;
`;

export const Article = styled.article`
    padding: 30px 0px 0px 20px;
    display:flex;
    gap: 200px;
    position: relative;
`
