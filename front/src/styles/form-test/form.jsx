import { styled } from "styled-components";
import { theme } from "../GlobalStyles";

export const Formm = styled.form.attrs(()=>({
    id: "form"
}))`
    display: flex;
    flex-direction: column;
    gap: 10px;
    background-Color: ${props => props.theme.backgroundColor};
    padding: 10px;
`;
Formm.defaultProps = {
    theme
}




export const StyleContainerForm = styled.div`
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 50px;

    button{
        margin-top: 10px;
        background-color: #37fd37;
    }
    .input-group{
        display: flex;
        flex-direction: column;
    }
`;

export const Label = styled.label.attrs(props => ({
    itemID: props.itemID
}))`
    font-size: 0.9rem;
    color: white;
    font-family: ${props => props.theme.font};
`;
Label.defaultProps = {
    theme
}