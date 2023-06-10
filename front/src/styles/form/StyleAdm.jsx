import { styled } from "styled-components";
import { theme } from "../GlobalStyles";

export const StyleForm = styled.div`
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

    input:first-child{
        padding: 10px;
    }

    input[type="submit"]{
        margin-top: 8px;
        width: 100%;
        border-radius: 5px;
        background-color: #ff4141f6;
        color: #ffffff;
        padding: 10px;
        cursor: pointer;
    }

    .input-group{
        border: 1px solid #5b5b5b91;
        margin-top: 10px;
        display: flex;
    }

    .icon-group{
        display: flex;
        justify-content: center;
        align-items: center;
        border-left: 1px solid #5b5b5b91;
        padding: 10px;
    }

    .icon{
        cursor: pointer;
    }
`;

export const StyleFormProduto = styled.section`
    position: relative;
    width: 90%;

    form{
        background-color: #CAF0F8;
        display: flex;
        width: 100%;
        transition: transform 0.5s ease-in-out;
    }

    input[type=number]::-webkit-inner-spin-button { 
    -webkit-appearance: none;
    }
    input[type=number] { 
        -moz-appearance: textfield;
        appearance: textfield;
    }

    .input-file{
        width: 90%;
        height: 20vw;
        max-height: 300px;
        min-height: 200px;
        min-width: 200px;
        overflow: hidden;
    }

    .input-file label{
        display: flex;
        max-width: 100%;
        height: 100%;
        justify-content: center;
        align-items: center;
        background-color: #ffffff;

    }

    .input-file span{
        max-width: 100%;
        max-height: 100%;
    }

    .input-file img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .container-form{
        position: absolute;
        top: 40%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60%;
        overflow: hidden;
        min-height: 100px;
    }

    .input-group{
        display: flex;
    }

    .input-group input,
    textarea,
    select{
        padding: 15px;
        width:100%;
    }

    .input-group,
    .input-group .input-box input,
    .input-group .input-box select{
        margin-bottom: 25px;
    }

    .input-group .input-box{
        display: flex;
        flex-direction: column;
    }

    .input-group .input-box input,
    .input-group .input-box select{
        width: 70%;
    }

    .input-group .ui-select{
        min-width: 180px;
    }

    .front,
    .back{
        flex: none;
        width: 100%;
        background-color: #CAF0F8;
        padding: 40px;
    }

    .buttons input{
        padding: 15px;
        color: white;
        cursor: pointer;
    }

    .buttons input:hover{
        opacity: 0.8;
    }

    .front .buttons input{
        float: right;
        background-color: ${props => props.theme.backgroundColor}
    }

    .back .buttons{
        display: flex;
        position: fixed;
        bottom: 0;
        transform: translateY(-40px);
        justify-content: space-between;
        width: calc(100% - 80px)
    }

    .back .buttons input{
        min-width: 100px;
    }

    .back .buttons input:first-child{
        background-color: ${props => props.theme.backgroundColor};
    }
    .back .buttons input:last-child{
        background-color: #39f239c7;
    }
`;
StyleFormProduto.defaultProps = {
    theme
}