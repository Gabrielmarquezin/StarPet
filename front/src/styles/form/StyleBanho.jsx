import { styled } from "styled-components";
import { theme } from "../GlobalStyles";

export const StylesBanhoForm = styled.main`
       margin-top: 60px;
      
      .container-all{
         background-color: #CAF0F8;
         padding: 30px;
         max-width: 660px;
         height: 820px;
         margin: auto;
         overflow: hidden;
      }

      .form-banho{
        transition: transform .3s ease-in-out;
        display: flex;
        gap: 31px;
      }

      .slide{
        flex: none;
        width: 600px;
        position: relative;
      }

      .slide .btn{
        justify-content: space-between;
      }

      .container-pix{
        min-width: 450px;
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

export const FormBanhoStyle = styled.div`
    
`;