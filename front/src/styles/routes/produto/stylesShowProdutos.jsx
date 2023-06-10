import { styled } from "styled-components";

export const Section = styled.section`
    width: 100%;
    padding: 100px 20px 0px 30px;

    .container-show-produtos{
        display: flex;
        gap: 100px;
    }

    .container-show-produtos .ui-filter-section{
        min-width: 200px;
    }
    .container-show-produtos section{
        width: 100%;
    }
    .ui-produtos{
        position: relative;
        min-height: 100%;
        min-width: 60%;
    }

    .ui-produtos section{
        margin-top: 50px;
    }
`;

export const StylesProdutoFromAdm = styled.div`
    display: flex;
    flex-direction: column;
    max-width: 950px;
    
    .close{
        margin-top: 30px;
        cursor: pointer;
    }

    button,
    input,
    footer,
    .ui-carrossel,
    .stars-group,
    .container-cunt-produto{
        display: none;
    }

    .container-img-produto{
        min-width: 400px;
        max-height: 300px;
    }

   .ui-container-main-img{
        width: 100%;
        justify-content: initial;
        gap: 50px;
   }
`;