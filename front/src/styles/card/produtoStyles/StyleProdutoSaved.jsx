import { styled } from "styled-components";

export const StyleCardProduto = styled.div`
   
     background: #CAF0F8;
     box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
     padding: 20px;
     height: 125px;
     border-radius: 20px;
     width: 100%;
     cursor: pointer;
     transition: 0.2s ease-in-out;

     input{
        width: 100%;
    }

    p{
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .ui-container-produto-saved{
        display: flex;
        gap: 30px;
        max-width: 90%;
        height: 100%;
        position: relative;
    }

    .ui-container-produto-saved .container-img{
        max-width: 120px;
        height: 100%;
    }
    
   .container-financas{
        display: flex;
        gap: 20px;
        align-items: center;
   }
   .input-group{
        max-width: 90px;
   }

   .input-group input{
        margin-top: 10px;
   }

   .container-img{
        position: relative;
        width: 200px;
   }

   .container-infor{
        width: 400px;
   }

   .container-infor p:first-child{
        max-width: 100%;
        color: #000000;
        font-size: 1.03rem;
   }
   .container-infor p:last-child{
        -webkit-line-clamp: 3;
        max-width: 100%;
        word-wrap: break-word;
        color: #6f6f6f;
   }

   &:hover{
     transform: scale(1.02);
   }
`;