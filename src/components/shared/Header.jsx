import React from "react";
import { Film, Menu } from "lucide-react";
import {
  HiArrowRightOnRectangle,
} from "react-icons/hi2";
import { Button } from "../Button";
import { Link } from "react-router-dom";

const userMenuItems = { content: "Logout", href: "#", Icon: HiArrowRightOnRectangle };

export default function Header({ isLoggedIn, userName }) {
  const handleLogout = () => {
    localStorage.removeItem("token");
    localStorage.removeItem("rememberMe");
    window.location.href = "/";
  };

  return (
    <header className="fixed w-full bg-gray-800 backdrop-blur-sm shadow-sm z-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center h-16">
          <div className="flex items-center justify-center">
            <Link to="/">
            <div className="flex items-center justify-center mb-2">
            <Film className="w-8 h-8 text-red-500" />
            <span className="text-2xl text-white font-bold ml-2">CineBook</span>
            </div>
            </Link>
          </div>


          <div className="flex items-center space-x-4">
            {isLoggedIn ? (
              <Button onClick={handleLogout}>{userMenuItems.content}</Button>
            ) : (
              <>
                <Link to="/login">
                  <Button variant="outline">Log In</Button>
                </Link>
                <Link to="/signup">
                  <Button>Sign Up</Button>
                </Link>
              </>
            )}
            <button className="md:hidden">
              <Menu className="w-6 h-6 text-white" />
            </button>
          </div>
        </div>
      </div>
    </header>
  );
}
