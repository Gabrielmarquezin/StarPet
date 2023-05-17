import { createGlobalStyle } from "styled-components";

export const GlobalStyle = createGlobalStyle`

    @font-face {
        font-family: 'K2D';
        font-style: normal;
        font-weight: 600;
        src: url('https://fonts.googleapis.com/css2?family=K2D:wght@600&display=swap');
    }

    *{
        margin: 0;
        padding: 0;
        font-size: 16px;
        box-sizing: border-box;
    }
    
    body{
        min-height: 100vh;
        position: relative;
    }
`;

export const theme = {
    font: "'K2D', sans-serif",
    backgroundColor: "#00509D",
    color: "#03045E",
    fontPreco: "Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif"
}

