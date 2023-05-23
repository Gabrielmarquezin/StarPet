import { styled } from "styled-components";
import { theme } from "../GlobalStyles";

export const Table = styled.table`
    letter-spacing: 1px;
`;


export const Tr = styled.tr`
    background-color: rgb(235, 235, 235);
`;

export const Th = styled.th.attrs((props)=>({
    scope: props.scope
}))`
    border: 1px solid rgb(190, 190, 190);
    padding: 10px;
    color: 
    font-family: ${props => props.theme.font};
    font-size: 1rem;
`;
Th.defaultProps = {
    theme
};

export const Td = styled.td`
     border: 1px solid rgb(190, 190, 190);
     text-align: center;
`;

export const Tbody = styled.tbody`
    
`;