import { styled } from "styled-components";

export const MainHome = styled.main`
    display: flex;
    gap: 40px;
  
`

export const Section = styled.section`
    width: 90%;
    position: relative;
    hr{
        width: 90%;
    }

    .line{
        position: relative;
    }

    .line div{
        position: absolute;
        background-color: blue;
        width: calc(20% - 20px);
        height: 100%;
        top: 0;
        transition: 0.3s ease-in-out;
        transform: translateX(0);
    }
`;

export const StylesProdutosCadastrados = styled.div`

    margin-top: 50px;

    p:last-child{
        margin-bottom: 50px;
    }
    .produto-group{
        margin-bottom: 100px;
    }

    .produto-group p,
    p:last-child{
        margin-left: 50px;
    }
`