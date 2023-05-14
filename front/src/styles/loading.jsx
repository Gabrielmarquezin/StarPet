import { styled } from "styled-components";

export const Loading = styled.div`
    width: 40px;
    height: 40px;
    border: 4px solid #00509D;
    border-top: 4px solid transparent;
    border-bottom: 4px solid transparent;
    border-radius: 50%;
    animation: rotate 0.5s linear infinite;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    
    @keyframes rotate{
        0%{
            transform: rotate(0);
        }
        100%{
            transform: rotate(360deg);
        }
    }
`