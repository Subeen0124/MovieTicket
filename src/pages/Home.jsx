import React from 'react';
import { Film, Calendar, CreditCard, Star, Clock, MapPin } from 'lucide-react';
import Img from '../assets/bg.avif';

function Home() {
  return (
    <div className="min-h-screen bg-gray-900 text-white">
      {/* Hero Section */}
      <header className="relative h-[600px]">
        <div className="absolute inset-0">
          <img
            src={Img}
            alt="Cinema"
            className="w-full h-full object-cover opacity-40"
          />
        </div>
        <div className="relative z-10 container mx-auto px-4 h-full flex flex-col justify-center">
          <nav className="absolute top-0 left-0 right-0 p-6">
            <div className="flex items-center justify-between">
              <div className="flex items-center space-x-2">
                <Film className="w-8 h-8 text-red-500" />
                <span className="text-2xl font-bold">CineBook</span>
              </div>
              <div className="hidden md:flex space-x-8">
                <a href="#movies" className="hover:text-red-500 transition">Movies</a>
                <a href="#cinemas" className="hover:text-red-500 transition">Cinemas</a>
                <a href="#offers" className="hover:text-red-500 transition">Offers</a>
                <button className="bg-red-500 px-6 py-2 rounded-full hover:bg-red-600 transition">
                  Sign In
                </button>
                <button className="bg-red-500 px-6 py-2 rounded-full hover:bg-red-600 transition">
                  Sign Up
                </button>
              </div>
            </div>
          </nav>
          
          <div className="max-w-3xl">
            <h1 className="text-5xl md:text-6xl font-bold mb-6">
              Book Your Perfect Movie Experience
            </h1>
            <p className="text-xl mb-8 text-gray-300">
              Get the best seats for the latest blockbusters. Easy booking, instant confirmation.
            </p>
            <button className="bg-red-500 px-8 py-2 rounded-md hover:bg-red-600 transition whitespace-nowrap">
            <a href="/login">Book Now</a> 
            </button>
          </div>
        </div>
      </header>

      {/* Features Section */}
      <section className="py-20 bg-gray-800">
        <div className="container mx-auto px-4">
          <h2 className="text-3xl font-bold text-center mb-12">Why Choose CineBook?</h2>
          <div className="grid md:grid-cols-3 gap-8">
            <div className="text-center p-6">
              <Calendar className="w-12 h-12 text-red-500 mx-auto mb-4" />
              <h3 className="text-xl font-semibold mb-2">Easy Booking</h3>
              <p className="text-gray-400">Book your tickets in seconds with our intuitive interface</p>
            </div>
            <div className="text-center p-6">
              <CreditCard className="w-12 h-12 text-red-500 mx-auto mb-4" />
              <h3 className="text-xl font-semibold mb-2">Secure Payments</h3>
              <p className="text-gray-400">Multiple payment options with enhanced security</p>
            </div>
            <div className="text-center p-6">
              <Star className="w-12 h-12 text-red-500 mx-auto mb-4" />
              <h3 className="text-xl font-semibold mb-2">Exclusive Offers</h3>
              <p className="text-gray-400">Regular discounts and special promotions</p>
            </div>
          </div>
        </div>
      </section>

      {/* Now Showing Section */}
      <section className="py-20">
        <div className="container mx-auto px-4">
          <h2 className="text-3xl font-bold mb-12">Now Showing</h2>
          <div className="grid md:grid-cols-4 gap-6">
            {[1, 2, 3, 4].map((movie) => (
              <div key={movie} className="bg-gray-800 rounded-lg overflow-hidden group">
                <div className="relative">
                  <img
                    src={`https://images.unsplash.com/photo-1536440136628-849c177e76a1?auto=format&fit=crop&q=80&w=400&h=600`}
                    alt="Movie Poster"
                    className="w-full h-[400px] object-cover"
                  />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                    <div className="absolute bottom-0 p-4">
                      <div className="flex items-center space-x-2 mb-2">
                        <Clock className="w-4 h-4 text-red-500" />
                        <span className="text-sm">2h 35m</span>
                      </div>
                      <button className="w-full bg-red-500 px-4 py-2 rounded-md hover:bg-red-600 transition">
                       <a href="/login">Book Now</a> 
                      </button>
                    </div>
                  </div>
                </div>
                <div className="p-4">
                  <h3 className="font-semibold mb-1">Movie Title {movie}</h3>
                  <div className="flex items-center text-yellow-500">
                    <span className="ml-1 text-sm">Genre</span>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Footer */}
      
    </div>
  );
}

export default Home;