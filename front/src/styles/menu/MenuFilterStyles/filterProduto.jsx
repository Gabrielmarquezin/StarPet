import { styled } from "styled-components";
import { theme } from "../../GlobalStyles";

export const Section = styled.section.attrs(()=>({
    className: "ui-filter-section"
}))`
    display: flex;
    flex-direction: column;
    gap: 50px;
    max-width: 250px;
    width: 200px;
`;

export const UiFilter = styled.div`
   margin-top: 50px;
`;

export const Ul = styled.ul`
    display: flex;
    flex-direction: column;
`;

export const Li = styled.li`
    color: ${props => props.theme.color};
    font-family: ${props => props.theme.font};
    padding: 5px 5px 5px 0px;
    list-style: none;
`;
Li.defaultProps = {
    theme
}

