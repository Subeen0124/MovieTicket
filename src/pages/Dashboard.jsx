import React, { useState } from "react";
import {
  Film,
  Search,
  Filter,
  Clock,
  Calendar,
  ChevronDown,
} from "lucide-react";

function Dashboard() {
  const [selectedGenre, setSelectedGenre] = useState("All");
  const [selectedLanguage, setSelectedLanguage] = useState("All");
  const [selectedTime, setSelectedTime] = useState(null); // New state for selected time

  const genres = ["All", "Action", "Comedy", "Drama", "Horror", "Sci-Fi"];
  const languages = ["All", "English", "Spanish", "French", "Japanese"];

  const handleTimeClick = (time) => {
    setSelectedTime(time); // Set the selected time to the clicked one
  };

  const handleBookClick = (title) => {
    // Redirect to booking page
    window.location.href = `/seatbook/${title}`;
  };

  const movies = [
    {
      id: 1,
      title: "Inception",
      genre: "Sci-Fi",
      duration: "2h 28m",
      image:
        "https://images.unsplash.com/photo-1440404653325-ab127d49abc1?auto=format&fit=crop&q=80&w=400&h=600",
      showtimes: ["10:00 AM", "1:30 PM", "4:45 PM", "8:00 PM"],
    },
    {
      id: 2,
      title: "The Dark Knight",
      genre: "Action",
      duration: "2h 32m",
      image:
        "https://images.unsplash.com/photo-1478720568477-152d9b164e26?auto=format&fit=crop&q=80&w=400&h=600",
      showtimes: ["11:15 AM", "2:30 PM", "5:45 PM", "9:00 PM"],
    },
    {
      id: 3,
      title: "Pulp Fiction",
      genre: "Drama",
      duration: "2h 34m",
      image:
        "https://images.unsplash.com/photo-1594909122845-11baa439b7bf?auto=format&fit=crop&q=80&w=400&h=600",
      showtimes: ["10:30 AM", "1:45 PM", "5:00 PM", "8:15 PM"],
    },
    {
      id: 4,
      title: "Interstellar",
      genre: "Sci-Fi",
      duration: "2h 49m",
      image:
        "https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&q=80&w=400&h=600",
      showtimes: ["12:00 PM", "3:15 PM", "6:30 PM", "9:45 PM"],
    },
  ];

  return (
    <div className="min-h-screen bg-gray-900 text-white">
      {/* Navigation */}
      <nav className="bg-gray-800 border-b border-gray-700">
        <div className="container mx-auto px-4">
          <div className="flex items-center justify-between h-16">
            <div className="flex items-center space-x-2">
              <Film className="w-8 h-8 text-red-500" />
              <span className="text-2xl font-bold">CineBook</span>
            </div>
            <div className="flex items-center space-x-6">
              <a href="#profile" className="hover:text-red-500 transition">
                My Profile
              </a>
              <a href="#bookings" className="hover:text-red-500 transition">
                My Bookings
              </a>
              <button className="bg-red-500 px-4 py-2 rounded-full hover:bg-red-600 transition">
                Sign Out
              </button>
            </div>
          </div>
        </div>
      </nav>

      {/* Search and Filters */}
      <div className="bg-gray-800 py-6">
        <div className="container mx-auto px-4">
          <div className="flex flex-col md:flex-row items-center gap-4">
            <div className="flex-1 relative w-full">
              <Search className="absolute left-3 top-3 text-gray-400" />
              <input
                type="text"
                placeholder="Search movies..."
                className="w-full bg-gray-700 rounded-lg py-2 px-10 focus:outline-none focus:ring-2 focus:ring-red-500"
              />
            </div>
            <div className="flex gap-4 w-full md:w-auto">
              <div className="relative flex-1 md:flex-none">
                <select
                  value={selectedGenre}
                  onChange={(e) => setSelectedGenre(e.target.value)}
                  className="appearance-none bg-gray-700 rounded-lg py-2 px-4 pr-8 w-full focus:outline-none focus:ring-2 focus:ring-red-500"
                >
                  {genres.map((genre) => (
                    <option key={genre} value={genre}>
                      {genre}
                    </option>
                  ))}
                </select>
                <ChevronDown className="absolute right-3 top-3 text-gray-400 pointer-events-none" />
              </div>
              <div className="relative flex-1 md:flex-none">
                <select
                  value={selectedLanguage}
                  onChange={(e) => setSelectedLanguage(e.target.value)}
                  className="appearance-none bg-gray-700 rounded-lg py-2 px-4 pr-8 w-full focus:outline-none focus:ring-2 focus:ring-red-500"
                >
                  {languages.map((language) => (
                    <option key={language} value={language}>
                      {language}
                    </option>
                  ))}
                </select>
                <ChevronDown className="absolute right-3 top-3 text-gray-400 pointer-events-none" />
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Movies Grid */}
      <div className="container mx-auto px-4 py-8">
        <div className="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
          {movies.map((movie) => (
            <div
              key={movie.id}
              className="bg-gray-800 rounded-lg overflow-hidden"
            >
              <div className="relative">
                <img
                  src={movie.image}
                  alt={movie.title}
                  className="w-full h-[400px] object-cover"
                />
                <div className="absolute top-4 right-4 bg-black/60 px-2 py-1 rounded-full"></div>
              </div>
              <div className="p-4">
                <h3 className="text-xl font-semibold mb-2">{movie.title}</h3>
                <div className="flex items-center space-x-4 text-gray-400 text-sm mb-4">
                  <div className="flex items-center">
                    <Clock className="w-4 h-4 mr-1" />
                    {movie.duration}
                  </div>
                  <div className="flex items-center">
                    <Filter className="w-4 h-4 mr-1" />
                    {movie.genre}
                  </div>
                </div>
                <div className="space-y-3">
                  <div className="flex items-center text-sm">
                    <Calendar className="w-4 h-4 text-red-500 mr-2" />
                    <span>Today's Shows</span>
                  </div>
                  <div className="grid grid-cols-2 gap-2">
                    {movie.showtimes.map((time, index) => (
                      <button
                        key={index}
                        onClick={() => handleTimeClick(time)}
                        className={`bg-gray-700 hover:bg-red-500 transition py-1 px-2 rounded text-sm ${
                          time === selectedTime ? "bg-red-500" : ""
                        }`} // Add bg-red-500 if time is selected
                      >
                        {time}
                      </button>
                    ))}
                  </div>
                  <button
                    onClick={() => handleBookClick(movie.title)}
                    className="w-full bg-red-500 hover:bg-red-600 transition py-2 rounded-md mt-4"
                  >
                    Book Tickets
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}

export default Dashboard;
