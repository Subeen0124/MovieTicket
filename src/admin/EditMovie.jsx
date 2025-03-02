import React, { useEffect, useState } from "react";
import { Navigate, useParams } from "react-router-dom";
import toast from "react-hot-toast";

const EditMovie = () => {
  const { id } = useParams();
  const [movie, setMovie] = useState(null);
  const [loading, setLoading] = useState(true);
  const [edited, setEdited] = useState(false);

  // Fetch movie data
  useEffect(() => {
    const fetchMovie = async () => {
      try {
        const response = await fetch(`http://localhost:3000/movies/${id}`);
        if (!response.ok) throw new Error("Failed to fetch movie data");
        const data = await response.json();
        setMovie(data);
      } catch (error) {
        toast.error(error.message);
      } finally {
        setLoading(false);
      }
    };

    fetchMovie();
  }, [id]);

  // Handle form input changes
  const handleChange = (e) => {
    const { name, value } = e.target;
    setMovie((prev) => ({
      ...prev,
      [name]: value,
    }));
  };

  // Edit the movie details
  const editMovie = async (e) => {
    e.preventDefault();
    try {
      const response = await fetch(`http://localhost:3000/movies/${id}`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(movie),
      });

      if (!response.ok) throw new Error("Failed to edit movie");
      toast.success("Movie updated successfully!");
      setEdited(true);
    } catch (error) {
      toast.error(error.message);
    }
  };

  if (loading) {
    return <div>Loading...</div>;
  }

  if (!movie) {
    return <div>Movie not found.</div>;
  }

  return edited ? (
    <Navigate to="/admin/movies" />
  ) : (
    <div className="container mx-auto p-8">
      <h1 className="text-3xl font-bold mb-4">Edit Movie</h1>
      <form onSubmit={editMovie} className="max-w-md">
        {["title", "genre", "releaseDate", "duration", "director"].map(
          (field) => (
            <div key={field} className="mb-4">
              <label
                htmlFor={field}
                className="block text-sm font-medium text-gray-700"
              >
                {field.charAt(0).toUpperCase() + field.slice(1)}
              </label>
              <input
                type={field === "releaseDate" ? "date" : "text"}
                id={field}
                name={field}
                value={movie[field] || ""}
                onChange={handleChange}
                className="mt-1 p-2 border rounded-md w-full"
              />
            </div>
          )
        )}
        <button
          type="submit"
          className="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        >
          Save Changes
        </button>
      </form>
    </div>
  );
};

export default EditMovie;
