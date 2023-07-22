import { styled } from "styled-components";

export const Section = styled.section`
    margin-top: 50px;
    margin-left: 100px;
    min-width: 50%;
    position: relative;

    p:first-child{
        font-size: 1.5rem;
    }

    p:first-child,
    hr{
        margin-bottom: 10px;
    }

    .ui-container-all{
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

`;