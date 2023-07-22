import { styled } from "styled-components";

export const StylesAdocao = styled.div`
    max-width: 700px;
    margin: auto;
    margin-top: 50px;
    background-color: #CAF0F8;
    padding: 30px;

    .error{
        display: none;
    }
    .ui-span-erro{
        margin-top: 5px;
        font-size: 0.8rem;
        color: #ee4343;
    }
    
    .input-group:nth-child(2n) span,
    .input-group:nth-child(2n) div:nth-child(2){
        display: none;
    }

`