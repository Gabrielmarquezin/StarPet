import { styled } from "styled-components";
import { theme } from "../../GlobalStyles";

export const StyleFile = styled.div`

      margin-top: 50px;
      align-self: center;

      input[type="file"]{
        display: none;
      }

      button[disabled]{
        opacity: .5;
        cursor: not-allowed;
      }

      span{
        display: block;
        max-width: 300px;
        height: 300px;
        cursor: pointer;
      }

      span:hover{
        opacity: 0.8;
      }

      img{
        border-radius: 50%;
      }

      button{
        padding: 10px;
        width: 100px;
      }

      .button-group{
        margin-top: 20px;
        display: flex;
        justify-content: space-around;
      }

      .button-group button:first-child{
         background-color: #6cea33e3;
      }

      .button-group button:last-child{
         background-color: #1eb9dde3;
      }
`;

export const StyleMenuPerfil = styled.div`
    height: 100%;
    align-self: center;

    li{
        display: flex;
        align-items: center;
        gap: 20px;
        cursor: pointer;
    }

    ul{
        min-width: 300px;
        align-self: center;
    }

    li a{
        font-size: 1.2rem;
        font-weight: 500;
    }
`;
StyleMenuPerfil.defaultProps = {
    theme
}

export const SectionMenu = styled.section`
     max-width: 500px;
     width: 30%;
     min-height: 100vh;
     background-color: ${props => props.theme.backgroundColor};
     display: flex;
     flex-direction: column;
     gap: 50px;
     padding-bottom: 30px;

     .social-icons{
        width: 100%;
        justify-content: space-around;
        font-size: 0.9rem;
        gap: 15px;
     }

     .footer-info{
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
     }

     footer{
        flex-direction: column;
        position: relative;
        transform: translate(0, 0);
        flex-wrap: wrap;
        padding: 0;
        max-width: 300px;
        align-self: center;
        gap: 30px;
        margin-top: 100px;
     }
`;
SectionMenu.defaultProps = {
    theme
};

export const SectionForm = styled.section`
    width: 100%;
    display: flex;
  
    p{
      font-size: 2rem;
    }

    a{
      padding: 30px;
    }
`;

export const MainPerfil = styled.main`
  display: flex;

`;

export const StyleForm = styled.div`
   width: 100%;
   display: flex;
   flex-direction: column;
   margin-top: 100px;
   margin-left: 100px;
   gap: 50px;
   
   input{
      background-color: #CAF0F8CC;
      border-radius: 10px;
   }

   input[type="text"]{
      padding: 15px;
      width: 100%;
   }

   input[disabled]{
    opacity: 0.5;
    cursor: not-allowed;
   }

   form{
     width: 50%;
     min-width: 400px;
   }

   label{
     color: #000000c0;
   }

   .ui-input-group{
    margin-bottom: 20px;
   }

   .ui-input-submit input{
      float: right;
      padding: 10px;
      background-color: #2968c8;
      color: #ffffff;
      cursor: pointer;
   }
`