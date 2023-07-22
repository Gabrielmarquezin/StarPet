import { styled } from "styled-components";
import { ContainerImageProduto } from "../../card/produtoStyles/produtoStyleCard";
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
    gap: 50px;
    min-height: 50vh;
    padding: 50px 20px 20px 20px;
`;

export const ContainerImage = styled.div.attrs(()=>({
    className: "container-img-produto"
}))`
    max-width: 700px;
    min-width: 450px;
    height: 457px;
`;

export const SectionMainImage = styled.section.attrs(()=>({
    className: "ui-container-main-img"
}))`
    display: flex;
    justify-content: space-between;
    width: 90%;
    align-self: center;
`;

export const ContainerDescricao = styled.div.attrs(()=>({
    className: "ui-container-info-produto"
}))`
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    max-width: 400px;
    padding: 30px 0px 0px;
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

    
`;

export const ContainerButton = styled.div`
    display: flex;
    flex-direction: column;
    gap: 10px;

    button{
        padding: 10px;
        font-size: 0.9rem;
    }

    button:first-child{
        background-color: #3483fa
    }
    button:last-child{
        background-color: #e2edfc;
        color: #3483fa;
    }

    button:disabled{
        cursor: not-allowed;
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

export const ContainerValor = styled.div.attrs(()=>({
    className: "container-cunt-produto"
}))`
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 30px;
`;

export const SectionCarrossel = styled.div`
   

`;

export const SectionOpt = styled.section`
    margin-top: 50px;
    width: 90%;
    align-self: center;
`;

export const Descricao = styled.div`
     width: 100%;
     word-wrap: break-word; overflow-wrap: break-word;

     p{
        margin-bottom: 30px;
     }
`;

export const ContainerTable = styled.div`
    table{
       width: 100%;
    }
    table tbody tr th,
    table tbody tr td{
        padding: 10px;
        font-size: 0.8rem;
    }
    table tbody tr th{
        background-color: rgba(0, 0, 0, 0.17);
        font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;
        font-weight: normal;
        -webkit-box-shadow: 0px 0px 0px 1px rgba(0,0,0,0.09); 
        box-shadow: 0px 0px 0px 1px rgba(0,0,0,0.09); 
    }
`;
ContainerTable.defaultProps = {
    theme
};

export const SectionComments = styled.section.attrs(props =>({
    
}))`
    width: 90%;
    min-height: 250px;
    align-self: center;
    position: relative;

    .ui-p-title{
        margin-bottom: 20px;
        color: rgba(0, 0, 0, 0.884);
        font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;
        font-size: min(calc(1vw + 12px), 1.2rem);
    }
`;

export const ContainerComment = styled.div`
    display: grid;
    grid-template-areas:
    "img nome"
    "img star"
    "comment comment";
    grid-template-columns: 40px minmax(auto, 60%);
    grid-template-rows: 20px 20px auto;
    grid-column-gap: 10px;

    img{
        border-radius: 50%;
        grid-area: img;
    }

    p{
        color: rgba(0, 0, 0, 0.884);
        font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;
        font-size: min(calc(1vw + 9px), 0.9rem);
    }

    .ui-p{
        grid-area: nome;
        align-self: center;
    }
    .stars-container{
        grid-area: star;
        align-self: center;
    }

    .comments-container{
        grid-area: comment;
        max-height: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-top: 10px;
    }
`

export const ContainerStar = styled.div.attrs(props => ({
    className: "stars-container"
}))`
    display: flex;
`;

export const BoxComments = styled.div.attrs(props =>({
    className: "comments-container"
}))`
    
`;

export const ContainerMaster = styled.div.attrs(props =>({
    id: "section-comment",
    className: "ui-section-comment"
}))`
    display: flex;
    flex-direction: column;
    gap: 50px;
    overflow: hidden;
`;

export const ContainerInput = styled.div`
    width: 90%;
    align-self: center;
   

    input{
        padding: 10px;
        border-radius: 5px;
    }
    span{
        display:none;
        font-size: 0.9rem;
    }

    .stars-group{
        cursor: pointer;
        display: flex
    }
    
    .input-group{
        display: flex;
        gap: 15px;
        padding: 10px 0px;
    }
    .input-group input:first-child{
        width: 50%;
        border-radius: 5px;
        border: 1px solid #0c0c0c85;
    }
    .input-group input:last-child{
        font-size: 0.9rem;
        color: #ffffff;
        background-color:  #3483fa;
        border: 1px solid #3483fa;
        cursor: pointer;
    }

/*  error*/ 
    .input-group input:first-child.input-error{
        border: 1px solid #ee3030;
    }

    .span-error{
        display: block;
        color: #ee3030;
    }
`;