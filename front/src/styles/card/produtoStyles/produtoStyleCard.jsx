import { styled } from "styled-components";
import { theme } from "../../GlobalStyles";

export const Section = styled.section`
    display: flex;
    flex-wrap: wrap;
    width: 100%;
    gap: 50px;
`
export const ContainerCardProduto = styled.div`
    max-width: 180px;
    height: 250px;
    display: flex;
    flex-direction: column;
    border: 1px solid transparent;
    border-radius: 5px;
    -webkit-box-shadow: 0px 0px 0px 1px rgba(0,0,0,0.09); 
    box-shadow: 0px 0px 0px 1px rgba(0,0,0,0.09); 
`;

export const ContainerImageProduto = styled.div`
    width: 100%;
    max-height: 130px;
`;

export const ContainerInfoProduto = styled.div`
    width: 100%;
    height: 100%;
    padding: 10px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
`;

export const P = styled.p`
    max-height: 50px;
    overflow: hidden;
    text-overflow: ellipsis;
    color: rgba(0,0,0,.8);
    font-family: ${props=>props.theme.fontPreco};
`
P.defaultProps = {
    theme
}
