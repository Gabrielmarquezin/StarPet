import { styled } from "styled-components";
import { theme } from "../../GlobalStyles";

export const SectionBody = styled.section`
    display: flex;
    flex-direction: column;
    gap: 80px;
    justify-content: center;

    p{
        padding-left: 51px;
    }
`;

export const ContainerProdutos = styled.div`
    display: flex;
    width: 100%;
    gap: 30px;
`;

export const Title = styled.p`
    font-family: ${props => props.theme.font};
    color: #03045E;
    letter-spacing: 1px;
    font-size: 1.2rem;
`;
Title.defaultProps = {
    theme
}

export const ProdutosRecomendados = styled.div`
    display: flex;
    flex-direction: column;
    width: 50%;
    gap: 20px;
`;

export const ProdutosAvaliados = styled.div`
     display: flex;
     flex-direction: column;
     width: 50%;
     gap: 20px;
`;