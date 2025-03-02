import { createBrowserRouter, RouterProvider } from "react-router-dom";
import { Toaster } from "react-hot-toast";
import Layout from "./components/shared/Layout.jsx";
import Home from "./pages/Home.jsx";
import { Login } from "./pages/Login.jsx";
import { Signup } from "./pages/Signup.jsx";
import Protected from "./components/Protected.jsx";
import AdminNav from "./admin/AdminNav.jsx";
import Admin from "./admin/Admin.jsx";
import Editmovie from "./admin/Editmovie.jsx";
import Addmovie from "./admin/Addmovie.jsx";
import Managemovies from "./admin/Managemovies.jsx";
import ManageOrders from "./admin/ManageOrders.jsx";
import ManageUsers from "./admin/ManageUsers.jsx";
import NotFound from "./pages/NotFound.jsx";
import AdminDashboard from "./admin/AdminDashboard.jsx";
import AdminLogin from "./admin/AdminLogin.jsx";
import Dashboard from "./pages/Dashboard.jsx";
import SeatBook from "./pages/SeatBook.jsx";

const router = createBrowserRouter([
  {
    path: "/",
    element: (
      <Layout>
        <Home />
      </Layout>
    ),
  },

  {
    path: "/login",
    element: (
      <Layout>
        <Login />
      </Layout>
    ),
  },

  {
    path: "/signup",
    element: (
      <Layout>
        <Signup />
      </Layout>
    ),
  },

  {
    path: "/dashboard",
    element: (
      <Layout>
        <Dashboard />
      </Layout>
    ),
  },

  {
    path: "/seatbook/:title",
    element: (
      <Layout>
        <SeatBook />
      </Layout>
    ),
  },

  {
    path: "/admin/login",
    element: <AdminLogin />,
  },

  {
    path: "/admin",
    element: (
      <>
        <AdminNav />
        <Admin />
      </>
    ),
    children: [
      {
        path: "dashboard",
        element: (
          <AdminDashboard totalMovies={10} totalOrders={5} totalUsers={3} />
        ),
      },

      {
        path: "editmovies/:id",
        element: <Editmovie />,
      },

      {
        path: "addmovie",
        element: <Addmovie />,
      },

      {
        path: "movies",
        element: <Managemovies />,
      },

      {
        path: "orders",
        element: <ManageOrders />,
      },

      {
        path: "users",
        element: <ManageUsers />,
      },
    ],
    errorElement: <NotFound />,
  },

  // 404 page
  {
    path: "*",
    element: <NotFound />,
  },
]);

function App() {
  return (
    <>
      <Toaster />
      <RouterProvider router={router} />
    </>
  );
}

export default App;
