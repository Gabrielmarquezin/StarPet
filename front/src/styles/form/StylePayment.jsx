import { styled } from "styled-components";
import { theme } from "../GlobalStyles";

export const StylePaymentForm = styled.main`
   
   max-width: 896px;
   overflow: hidden;
   margin: auto;
   margin-top: 50px;
   background-color: #CAF0F8;

    .container-all{
        padding: 30px;
        width: 100%;
        height: 100%;
        display: flex;
        transition: 0.5s ease-in-out;
    }

    .container-payment{
        display: flex;
        gap: 100px;
        flex: none;
    }

 
    //error
    .error{
        display: none;
    }
    .ui-span-erro{
        margin-top: 5px;
        font-size: 0.8rem;
        color: #ee4343;
    }
    
    //produto payment
    .ui-container-produto-payment{
        display: flex;
        justify-content: space-between;
        flex-direction: column;
    }
    .ui-container-produto-payment .info span{
        color: #6f6f6f;
        font-size: 1.1rem;
    }
    .ui-container-produto-payment .produto .desc{
        margin-top: 50px;
    }
    .ui-container-produto-payment .produto div span{
        color: ${props => props.theme.color};
        font-size: 1.5rem;
        margin-bottom: 10px;
    }
    .img-produto-payment{
        max-width: 300px;
        max-height: 300px;
    }

    .ui-container-produto-payment div p{
        display: -webkit-box;
        -webkit-line-clamp: 7; /* Número máximo de linhas */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 300px;
        color: #000000;
    }

    .info{
        margin-bottom: 50px;
    }

    //pix
    .container-pix{
        min-width: 450px;
        margin-left: 60px;
        display: flex;
        flex-direction: column;
        gap: 20px;
        justify-content: space-between;
        width: 850px;
        align-items: center;
        flex: none;
        width: 100%;
    }

    .imagem-pix{
        position: relative;
        min-width: 50%;
        max-width: 500px;
        max-height: 450px;
    }

    img:not(:defined) {
        border: none;
    }
`;
StylePaymentForm.defaultProps = {
    theme
}

export const StyleForm = styled.form`
    span{
        color: ${props => props.theme.color};
        display: block;
    }

    input,
    select{
        padding: 10px;
        border: 1px solid #ccc;
        line-height: 1.071em;
        -moz-box-shadow: 0 1px 2px #eee inset;
        -webkit-box-shadw: 0 1px 2px #eee inset;
        box-shadow: 0 1px 2px #eee inset;
    }

    label{
        color: #6f6f6f;
        font-size: 0.9rem;
    }

    button{
        padding: 15px;
        min-width: 100px;
    }

    .input-group{
        margin-bottom: 20px;
    }
    .input-group input{
        width: 100%;
    }

    .input-group div,
    .input-group span{
        margin-bottom: 10px;   
    }
    .input-group .box{
        max-width: 300px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 10px;
    }

    .input-group .box div{
        width: 125px;
    }
    .input-group .box div input,
    .input-group .box div select{
        width: 100%;
    }

    .btn{
        display: flex;
        justify-content: end;
        width: 100%;
    }  

    .error{
        display: none;
    }
    
    .ui-span-erro{
        margin-top: 5px;
        font-size: 0.8rem;
        color: #ee4343;
    }
`;
