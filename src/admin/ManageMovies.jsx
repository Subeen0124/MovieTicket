import { useState, useEffect } from "react";
import toast from "react-hot-toast";
import { Link } from "react-router-dom";

const ManageMovies = () => {
  const [movies, setMovies] = useState([]);
  const [loading, setLoading] = useState(true);

  const fetchMovies = async () => {
    try {
      const response = await fetch("http://localhost:3000/movies");
      if (!response.ok) {
        throw new Error("Failed to fetch movies");
      }
      const data = await response.json();
      setMovies(data);
    } catch (error) {
      console.error("Error fetching movies:", error);
      toast.error("Failed to load movies.");
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchMovies();
  }, []);

  return (
    <div className="container mx-auto p-8">
      <h1 className="text-3xl font-bold mb-4">Manage Movies</h1>
      <div className="mb-4">
        <Link to="/admin/addmovie">
          <button className="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            Add Movie
          </button>
        </Link>
      </div>
      {loading ? (
        <p className="text-gray-600">Loading...</p>
      ) : (
        <table className="min-w-full divide-y divide-gray-200">
          <thead className="bg-gray-50">
            <tr>
              <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                ID
              </th>
              <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Title
              </th>
              <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Genre
              </th>
              <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Release Date
              </th>
              <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Duration
              </th>
              <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Now Showing
              </th>
              <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Poster
              </th>
            </tr>
          </thead>
          <tbody className="bg-white divide-y divide-gray-200">
            {movies.map((movie) => (
              <tr key={movie.movieid}>
                <td className="px-6 py-4 whitespace-nowrap">{movie.movieid}</td>
                <td className="px-6 py-4 whitespace-nowrap">{movie.title}</td>
                <td className="px-6 py-4 whitespace-nowrap">{movie.genre}</td>
                <td className="px-6 py-4 whitespace-nowrap">
                  {movie.release_date}
                </td>
                <td className="px-6 py-4 whitespace-nowrap">
                  {movie.duration} min
                </td>
                <td className="px-6 py-4 whitespace-nowrap">
                  {movie.now_showing ? "Yes" : "No"}
                </td>
                <td className="px-6 py-4 whitespace-nowrap">
                  <img
                    src={movie.poster_url}
                    alt={movie.title}
                    className="w-16 h-24 object-cover rounded"
                  />
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      )}
    </div>
  );
};

export default ManageMovies;
