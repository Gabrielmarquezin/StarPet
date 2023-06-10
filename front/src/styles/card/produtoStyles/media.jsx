import { styled } from "styled-components"

export const StyleDash = styled.div`
    position: absolute;
    top: 30%;
    left: 50%;
    transform: translateX(-50%);
    background-color: ${props => props.status == "baixa" ? "#ff7c80" : props.status == "media" ? "#ffd966" : "#a9d08e"};
    padding: 30px;
    border-radius: 10px;

    span{
        font-size: 8rem;
        display: flex;
        justify-content: center;
    }

    span,
    p{
        color: #ffffff;
    }
`