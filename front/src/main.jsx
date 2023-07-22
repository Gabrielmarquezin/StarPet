import React from 'react'
import ReactDOM from 'react-dom/client'
import { createBrowserRouter, RouterProvider} from 'react-router-dom'
import { Form } from './component/form-test/form'
import { MenduAdm, MenuH } from './component/menu/menu'
import {AdmDatasWithLoading } from './component/screens/adm/perfil/adm'
import { AuthContextProvider } from './hook/useAuth'
import { BanhoVendidosWithLoading } from './routes/adm/BanhoPedidos'
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
import { Vendidos } from './routes/adm/vendidos'
import { PassarosAcessorios } from './routes/user/Acessorios'
import { AdotarPet } from './routes/user/AdotarPet'
import { BanhoTosa } from './routes/user/BanhoTosa'
import { CarrinhoWithLoading } from './routes/user/Carrinho'
import { FavoritesWithLoading } from './routes/user/Favorites'
import Home from './routes/user/home'
import { ListPetsAdocoaWithLoading } from './routes/user/ListsPetsAdocao'
import { MyPedidos } from './routes/user/MyPedidos'
import { OtherPets } from './routes/user/OtherPets'
import { Payment, PaymentWihtLoading } from './routes/user/payment'
import { MyPerfilWithLoading, Perfil } from './routes/user/Perfil'
import { PetWithLoading } from './routes/user/Pet'
import { PetAdocaoWithLoading } from './routes/user/PetAdocao'
import { PetPeixeAmostra } from './routes/user/PetPeixeAmostra'
import { PoliticaPrivacidade } from './routes/user/Privacidade'
import { Produto, ProdutoWithLoading } from './routes/user/Produto'
import { ProdutoAmostra } from './routes/user/ProdutoAmostra'
import { ProdutoSelectedSearch } from './routes/user/produtoSearchSelected'
import { SearchProdutos } from './routes/user/search'
import { Sobre } from './routes/user/Sobre'
import { TermosDeUso } from './routes/user/TermosDeUso'
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
      },
      {
        path: "/:produto/produto/:categoria/:id",
        element: <ProdutoWithLoading />
      },
      {
        path: "/:pet/pet/:categoria/:id",
        element: <PetWithLoading />
      },
      {
        path: "/home/search",
        element: <SearchProdutos />
      },
      {
        path: "/produto/payment",
        element: <PaymentWihtLoading   />
      },
      {
        path: "/produto/payment/adocao",
        element: <AdotarPet   />
      },
      {
        path: "/home/search/:id",
        element: <ProdutoSelectedSearch />
      },
      {
        path: "/carrossel/produto/:id",
        element: <ProdutoWithLoading />
      },
      {
        path: "/carrossel/pet/:id",
        element: <PetWithLoading />
      },
      {
        path: "/perfil/favorite/user/pet/:cod",
        element: <PetWithLoading />
      },
      {
        path: "/perfil/favorite/user/produto/:cod",
        element: <ProdutoWithLoading />
      },
      {
        path: "/perfil/vendidos/user/produto/:cod",
        element: <ProdutoWithLoading />
      },
      {
        path: "/perfil/vendidos/user/pet/:cod",
        element: <PetWithLoading />
      },
      {
        path: "/perfil/carrinho/user/pet/:cod",
        element: <PetWithLoading />
      },
      {
        path: "/perfil/carrinho/user/produto/:cod",
        element: <ProdutoWithLoading />
      },
      {
        path: "/pet/adocao",
        element: <ListPetsAdocoaWithLoading />
      },
      {
        path: "/pet/adocao/:id",
        element: <PetAdocaoWithLoading />
      },
      {
        path: "/peixe/pet/:type",
        element: <PetPeixeAmostra />
      },
      {
        path: "/passaro/pet/:type",
        element: <PassarosAcessorios />
      },
      {
        path: "/passaro/pet/gaiolas",
        element: <OtherPets/>
      },
      {
        path: "/passaro/pet/racao",
        element: <OtherPets/>
      },
      {
        path: "/pedido/banho_tosa",
        element: <BanhoTosa />
      },
      {
        path: "/termos/privacidade",
        element: <PoliticaPrivacidade />
      },
      {
        path: "/termos/sobre",
        element: <Sobre />
      },
      {
        path: "/termos/uso",
        element: <TermosDeUso />
      },
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
      },
      {
        path: "/adm/home/vendidos",
        element: <Vendidos />
      },
      {
        path: "/adm/home/vendidos_banho",
        element: <BanhoVendidosWithLoading />
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
    path: "/perfil",
    element: <MyPerfilWithLoading />,
    children: [
      {
        path: "/perfil/user",
        element: <Perfil />
      },
      {
        path: "/perfil/favorite/user",
        element: <FavoritesWithLoading />
      },
      {
        path: "/perfil/vendidos/user",
        element: <MyPedidos />
      },
      {
        path: "/perfil/carrinho/user",
        element: <CarrinhoWithLoading />
      },
    ]
  },
])  

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <GlobalStyle />
   <AuthContextProvider>
      <RouterProvider router={router} />
   </AuthContextProvider>
  </React.StrictMode>,
)
