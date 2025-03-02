import React from "react";
import { Link } from "react-router-dom";
import notfound from "../assets/notfound.jpg";

function NotFound() {
  return (
    <div className="flex flex-col items-center justify-center h-screen">
      <h1 className="text-4xl font-bold text-gray-800 mb-4">404 Not Found</h1>
      <p className="text-lg text-gray-600 mb-8">
        Oops! The page you're looking for doesn't exist.
      </p>
      <img src={notfound} alt="Not Found" className="w-64 mb-8" />
      <p className="text-lg text-gray-600">
        Maybe try going back to the{" "}
        <Link to="/" className="text-blue-500 hover:underline">
          home page
        </Link>
        ?
      </p>
    </div>
  );
}

export default NotFound;
