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
    cursor: pointer;
    transition: 0.2s ease-in-out;

    &:hover{
       transform: scale(1.1);
    }
`;

export const ContainerImageProduto = styled.div`
    width: 100%;
    max-height: 130px;
    min-height: 100px;
`;

export const ContainerInfoProduto = styled.div`
    width: 100%;
    height: 100%;
    padding: 10px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    .ui-preco-cod-group{
        display: flex;
        justify-content: space-between;

        p:first-child{
            max-width: 90px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

      
    }

    .ui-preco-cod-group p:last-child{
        padding-left: 10px;
    }

    span{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    #desc{
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 0.9rem;
        color: #6f6f6f;
    }
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

export const StyleCardVendido = styled.div.attrs(props => ({
    className: "card-vendido"
}))`
    background-color: #CAF0F8;
    width: 90%;
    max-height: 160px;
    overflow: hidden;
    transition: max-height 0.3s ease-in-out;
    cursor: pointer;

    &:hover{
        transform: scale(1.01);
    }

    //user card
    .container-user{
        display: flex;
        width: 100%;
        justify-content: space-between;
        padding: 30px;
        align-items: center;
    }

    .container-user .user-informations{
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .container-user .img-user{
        width: 100px;
        height: 100px;
    }

    //produto

    .container-card-produto{
        display: flex;
        justify-content: space-between;
        padding: 30px;
    }

    .container-card-produto .group{
        margin-top: 10px;
    }

    .container-card-produto .group .g{
        margin-top: 5px;
    }
    .container-card-produto .group .g{
        display: flex;
        flex-direction: column;
    }

    .container-card-produto .group > span{
        color: ${props => props.theme.color};
    }
    .container-card-produto .img-produto{
        width: 300px;
        height: 300px;
    }

    .container-card-produto .group .produto-information{
        display: flex;
        flex-direction: column;
    }
`;
StyleCardVendido.defaultProps ={
    theme
}
