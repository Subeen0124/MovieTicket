import React from "react";
import {
  AiOutlineShoppingCart,
  AiOutlineUser,
  AiOutlineDatabase,
} from "react-icons/ai";

const AdminDashboard = ({ totalMovies, totalOrders, totalUsers }) => {
  return (
    <div className="container">
      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-6">
        <div className="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
          <div>
            <h2 className="text-xl font-semibold mb-2">Total Movies</h2>
            <p className="text-3xl font-bold text-blue-500">
              {totalMovies}
            </p>
          </div>
          <div className="bg-blue-200 rounded-full p-3">
            <AiOutlineDatabase className="h-8 w-8 text-blue-500" />
          </div>
        </div>
        <div className="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
          <div>
            <h2 className="text-xl font-semibold mb-2">Total Bookings</h2>
            <p className="text-3xl font-bold text-green-500">{totalOrders}</p>
          </div>
          <div className="bg-green-200 rounded-full p-3">
            <AiOutlineShoppingCart className="h-8 w-8 text-green-500" />
          </div>
        </div>
        <div className="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
          <div>
            <h2 className="text-xl font-semibold mb-2">Total Users</h2>
            <p className="text-3xl font-bold text-purple-500">{totalUsers}</p>
          </div>
          <div className="bg-purple-200 rounded-full p-3">
            <AiOutlineUser className="h-8 w-8 text-purple-500" />
          </div>
        </div>
      </div>
    </div>
  );
};

export default AdminDashboard;
