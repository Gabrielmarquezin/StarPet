import React from 'react'
import ReactDOM from 'react-dom/client'
import { createBrowserRouter, RouterProvider} from 'react-router-dom'
import { Form } from './component/form-test/form'
import { MenduAdm, MenuH } from './component/menu/menu'
import {AdmDatasWithLoading } from './component/screens/adm/perfil/adm'
import { AuthContextProvider } from './hook/useAuth'
import { AdmCadastro } from './routes/adm/cadastro'
import { CadastroPet } from './routes/adm/cadastroPet'
import { CadastroPetAdocao } from './routes/adm/cadastroPetAdocao'
import { EditProduto } from './routes/adm/EditProduto'
import { HomeAdm } from './routes/adm/home'
import { LoginAdm } from './routes/adm/login'
import { PetFromAdm } from './routes/adm/Pet'
import { ProdutoFromAdm } from './routes/adm/produto'
import { ProdutosCadastrados } from './routes/adm/ProdutoCadastrado'
import { QuantidadeProduto } from './routes/adm/quantidadeDeProdutos'
import { ShowProdutos } from './routes/adm/showProdutos'
import { TrashProduto } from './routes/adm/trashProduto'
import Home from './routes/user/home'
import { MyPerfilWithLoading } from './routes/user/Perfil'
import { PetWithLoading } from './routes/user/Pet'
import { Produto, ProdutoWithLoading } from './routes/user/Produto'
import { ProdutoAmostra } from './routes/user/ProdutoAmostra'
import { GlobalStyle } from './styles/GlobalStyles'

const router = createBrowserRouter([
  {
    path: "/",
    element: <Home />
  },
  {
    path: "/",
    element: <MenuH />,
    children: [
      {
        path: "/:produto/:animal/:categoria",
        element: <ProdutoAmostra />
      }
    ]
  },
  {
    path: "/",
    element: <MenuH />,
    children: [
      {
        path: "/:produto/produto/:categoria/:id",
        element: <ProdutoWithLoading />
      }
    ]
  },
  {
    path: "/",
    element: <MenuH />,
    children: [
      {
        path: "/:pet/pet/:categoria/:id",
        element: <PetWithLoading />
      }
    ]
  },
  {
    path: "/adm",
    element: <LoginAdm />
  }
  ,
  {
    path: "/adm/home",
    element: <HomeAdm />
  },
  {
    path: "/adm/home",
    element: <HomeAdm />,
    children: [
      {
        path: "/adm/home/perfil",
        element: <AdmDatasWithLoading />
      },
      {
        path: "/adm/home/quantidade-produto-cadastrado",
        element: <QuantidadeProduto />
      },
      {
        path: "/adm/home/quantidade-vendidos",
        element: <AdmDatasWithLoading />
      },
      {
        path: "/adm/home/produtos-cadastrados",
        element: <ProdutosCadastrados />
      }
    ]
  },
  {
    path: "/adm/home/show-produtos/:pet/:categoria/:type",
    element: <ShowProdutos />
  },
  {
    path: "/adm/home/show-produtos/:pet/produto/:type/:id",
    element: <ProdutoFromAdm />
  },
  {
    path: "/adm/home/show-produtos/:pet/pet/:type/:id",
    element: <PetFromAdm />
  },
  {
    path: "/adm/home/cadastrar",
    element: <AdmCadastro />
  },
  {
    path: "/adm/home/cadastrar/pet",
    element: <CadastroPet />
  },
  {
    path: "/adm/home/cadastrar/pet/adocao",
    element: <CadastroPetAdocao />
  },
  {
    path: "/adm/home/editproduct",
    element: <EditProduto />
  },
  {
    path: "/adm/home/excluir/produto",
    element: <TrashProduto />
  },
  {
    path: "/perfil/user",
    element: <MyPerfilWithLoading />
  }
])

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <GlobalStyle />
   <AuthContextProvider>
      <RouterProvider router={router} />
   </AuthContextProvider>
  </React.StrictMode>,
)
