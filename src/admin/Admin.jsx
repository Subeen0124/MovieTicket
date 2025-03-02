//All products are registered trademarks of Foodish Land.
import React from 'react'
import { Outlet, useOutlet } from 'react-router-dom'
import Dashboard from './AdminDashboard';

const Admin = () => {
  const outletContent = useOutlet();
  return (
    <>
    { outletContent ? <Outlet/> : <Dashboard totalProfessionals={10} totalOrders={5} totalUsers={3} />}
    </> 
  )
}

export default Admin