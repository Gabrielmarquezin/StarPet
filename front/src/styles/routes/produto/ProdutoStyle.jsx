import { styled } from "styled-components";
import { theme } from "../../GlobalStyles";


/* produtos amostra */
export const Location = styled.span`
    color: ${props => props.theme.color};
    font-family: ${props => props.theme.font};
    font-size: 1rem;
`;
Location.defaultProps = {
    theme
}

export const Div = styled.div`
    padding-left: 20px;
    margin-top: 50px;
`;

export const Article = styled.article`
    padding: 30px 0px 0px 20px;
    display:flex;
    gap: 200px;
    position: relative;
`

/*produtos selecionados */

export const Main = styled.main`
    display: flex;
    flex-direction: column;
    min-height: 50vh;
    padding: 50px 20px 20px 20px;
`;

export const ContainerImage = styled.div`
    max-width: 100%;
    height: 457px;
`;

export const SectionMainImage = styled.section`
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    width: 80%;
    align-self: center;
    padding: 0px 50px
`;

export const ContainerDescricao = styled.div`
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    max-width: 400px;
`;

export const ProdutoName = styled.div`
    word-wrap: break-word; overflow-wrap: break-word;
    width: 300px;
    text-align: left;  
`;

export const ContainerPayment = styled.div`
    display: flex;
    flex-direction: column;
    gap: 10px;
`;

export const ContainerPay = styled.div`
    display: flex;
    flex-direction: column;

    button{
        padding: 10px;
        font-size: 1.2rem;
        background-color: #000000c5
    }
`;

export const ContainerContador = styled.div`
    display: flex;
    border: 1px solid #f6f6f6;
    width: 100px;

    input{
        text-align: center;
        width: 100%;
    }

    span{
        cursor: pointer;
        background-color: #f7f6f7;
        padding: 5px;
    }
`

export const ContainerValor = styled.div`
    display: flex;
    align-items: center;
    gap: 10px;
     margin-bottom: 30px;
`;

export const SectionCarrossel = styled.div`
   

`