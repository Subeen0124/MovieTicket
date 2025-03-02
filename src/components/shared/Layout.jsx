import Footer from "./Footer";
import Header from "./Header";

const Layout = ({ children }) => {
  const token = localStorage.getItem("token");
  const isLoggedIn = token ? true : false;
  const userName = localStorage.getItem("userName");

  return (
    <>
      <Header isLoggedIn={isLoggedIn} userName={userName} />
      <main>{children}</main>
      <Footer />
    </>
  );
};

export default Layout;