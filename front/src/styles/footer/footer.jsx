import { styled } from "styled-components";
import { theme } from "../GlobalStyles";

export const FooterP = styled.footer`
    display: flex;
    background-color: ${props => props.theme.backgroundColor};
    justify-content: space-between;
    align-items: center;
    padding: 30px;
    margin-top: 60px;
`;
FooterP.defaultProps = {
    theme
}

export const ContainerSocial = styled.div`
    display: flex;
    gap: 30px;
`;
