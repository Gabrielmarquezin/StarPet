import { styled } from "styled-components";

export const StyleVendidos = styled.div`
    margin-top: 30px;
    .search{
        display: flex;
        gap: 10px;
        margin-bottom: 30px;
    }
    .search select{
        border: 1px solid #c0c0c0;
        color: #525252;
    }
    .containaer-pet{
        width: 100%;
        max-height: 1242px;
        overflow: hidden;
    }

    .containaer-pet .pet-vendidos{
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    //buttons
    .buttons{
        display: flex;
        gap: 30px;
        width: 90%;
        justify-content: center;
        padding: 30px
        
    }
    button{
        border-radius: 0;
        padding: 15px;
    }
    .buttons button:first-child{
        background-color: #070707dc;
        border: 1px solid #070707dc;

    }

    .buttons button:last-child{
        background-color: transparent;
        border: 1px solid #686868;
        color: #686868;
    }
`;