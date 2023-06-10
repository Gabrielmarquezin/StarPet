import { styled } from "styled-components";
import { theme } from "../../GlobalStyles";

export const StylesMenu = styled.div`
  width: 100%;
  margin-top: 100px;
  
  ul{
    display: flex;
    justify-content: space-between;
    width: 90%;
  }

  ul li{
    display: flex;
    text-align: center;
    align-items: flex-end;
    justify-content: center;
    width: 100%                    
  }

  ul li a{
    color: ${props => props.theme.color}
  }
`;
StylesMenu.defaultProps = {
    theme
};

export const StylesMenuProdutos = styled.div`
    margin-top: 30px; 
    ul{
      display: flex;
      gap: 30px;
    }

    ul li{
      background-color: #CAF0F8;
      border-radius: 5px;
      min-width: 100px;
    }

    ul li a{
      display: flex;
      justify-content: center;
      text-align: center;
      color: ${props => props.theme.color};
    }
`;
StylesMenuProdutos.defaultProps = {
  theme
}