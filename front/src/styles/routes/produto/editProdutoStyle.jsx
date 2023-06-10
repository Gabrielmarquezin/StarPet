import { styled } from "styled-components";
import { theme } from "../../GlobalStyles";

export const Section = styled.section`
    margin: 100px auto 25% auto;
    max-width: 650px;
    overflow: hidden;
    background-color: #CAF0F8;

    input[disabled],
    button[disabled]{
        opacity: 0.5;
        cursor: not-allowed;
    }

    span{
        display: none;
    }
    
    .ui-container-codigo{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px;
        width: calc(100% + 20px);
        flex: none;    
    }
    .ui-container-codigo .box{
        display: flex;
        flex-direction: column;
        gap: 10px;
        width: 90%;
    }

    .ui-container-codigo button,
    .ui-container-codigo input,
    .ui-container-codigo select{
        padding: 15px;
    }

    .ui-container-codigo button{
        width: 90%;
    }

    .ui-container-codigo .box input{
        width: 100%;
    }

    .ui-container-product{
        padding: 20px;
        border-radius: 10px;
        display: flex;
        transition: transform 0.4s ease-in-out;
    }

    .ui-container-product .input-group{
        margin-bottom: 20px;
    }
   
    .ui-container-product .input-box{
        display: flex;
        gap: 10px;
    }
    .ui-container-product .input-box .ui-preco{
        width: 20%;
        min-width: 100px;
    }
    .ui-container-product .input-box input{
        margin-bottom: 15px;
    }

    .ui-container-product .input-group input,
    textarea{
        padding: 10px;
        width: 100%;
    }
    .ui-container-product .input-file {
        width: 90%;
        height: 100%;
    }
    .ui-container-product .input-file label{
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #ffffff;
        min-width: 350px;
        max-width: 100%;
        min-height: 350px;
    }

    .ui-container-product .input-file span{
        max-width: 500px;
        height: 350px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .ui-container-product .input-file img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .buttons-input{
        display: flex;
        margin-top: 20px;
        justify-content: space-between;
    }
   .buttons-input input{
        padding: 15px;
        background-color: ${props => props.theme.backgroundColor};
        color: #ffffff;
        cursor: pointer;
        min-width:  100px;
        border-radius: 5px;
    }

    .buttons-input button{
        padding: 15px;
        min-width:  100px;
    }

    form{
        width: calc(100% - 20px);
        flex: none;
    }

    //error

    .error-span{
        color: #f34141;
        display: block;
        font-size: 0.9rem;
    }

    .error-input{
        border: 1px solid #f34141;
        display: block;
    }
`;
Section.defaultProps = {
    theme
}