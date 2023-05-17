import React from 'react'
import ReactDOM from 'react-dom/client'
import { createBrowserRouter, RouterProvider} from 'react-router-dom'
import { MenuH } from './component/menu/menu'
import { AuthContextProvider } from './hook/useAuth'
import Home from './routes/user/home'
import { Produto } from './routes/user/Produto'
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
        path: "/produto/:animal/:categoria",
        element: <ProdutoAmostra />
      }
    ]
  },
  {
    path: "/",
    element: <MenuH />,
    children: [
      {
        path: "/produto/:animal/:categoria/:id",
        element: <Produto />
      }
    ]
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
