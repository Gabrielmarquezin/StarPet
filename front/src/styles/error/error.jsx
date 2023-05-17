import { styled } from "styled-components";
import { theme } from "../GlobalStyles";

export const ErrorContainer = styled.p`
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-family: ${props => props.theme.font};
    color: ${props => props.theme.color};
`;
ErrorContainer.defaultProps = {
    theme
}