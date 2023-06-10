import { styled } from "styled-components";
import { theme } from "../GlobalStyles";

export const Label = styled.label.attrs(()=>({
    className: "ui-label"
}))`
    font-size: 1rem; 
    font-family: ${props => props.theme.font};
`;
Label.defaultProps = {
    theme
}

export const Form = styled.form.attrs((props)=>({
    id: props.id,
    encType: props.encType,
    method: props.method,
    action: props.action
}))`
    

`;

export const TextArea = styled.textarea.attrs(props => ({
    className: props.className,
    cols: props.cols,
    rows: props.rows
}))`
    padding: 5px;
    border: none;
    outline: 0;
`

export const Select = styled.select`
    background-color: #ffffff;
    border: none;
    cursor: pointer;
    padding: 5px;
`;

export const Option = styled.option.attrs((props) =>({
    value: props.value,
}))`
     font-size: 1rem; 
     font-family: ${props => props.theme.font};
`;
Option.defaultProps = {
    theme
}