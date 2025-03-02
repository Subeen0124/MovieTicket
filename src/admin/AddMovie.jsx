import React, { useState } from "react";
import toast from "react-hot-toast";
import { Navigate } from "react-router-dom";

const AddMovie = () => {
  const [added, setAdded] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);

    // Ensure duration is a number
    data.duration = parseInt(data.duration, 10);
    data.now_showing = data.now_showing === "true";

    try {
      const response = await fetch("http://localhost:3000/movies", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      });

      if (!response.ok) {
        throw new Error("Failed to add movie");
      }

      toast.success("Movie added successfully");
      setAdded(true);
    } catch (error) {
      console.error("Error adding Movie:", error);
      toast.error("Failed to add Movie");
    }
  };

  if (added) {
    return <Navigate to="/admin/movies" />;
  }

  return (
    <div className="container mx-auto p-8">
      <h1 className="text-3xl font-bold mb-4">Add Movie</h1>
      <form onSubmit={handleSubmit} className="max-w-md">
        <div className="mb-4">
          <label
            className="block text-sm font-medium text-gray-700"
            htmlFor="movieid"
          >
            Movie ID
          </label>
          <input
            type="text"
            name="movieid"
            id="movieid"
            required
            className="mt-1 p-2 border border-gray-300 rounded w-full"
          />
        </div>

        <div className="mb-4">
          <label
            className="block text-sm font-medium text-gray-700"
            htmlFor="title"
          >
            Title
          </label>
          <input
            type="text"
            name="title"
            id="title"
            required
            className="mt-1 p-2 border border-gray-300 rounded w-full"
          />
        </div>

        <div className="mb-4">
          <label
            className="block text-sm font-medium text-gray-700"
            htmlFor="description"
          >
            Description
          </label>
          <textarea
            name="description"
            id="description"
            required
            className="mt-1 p-2 border border-gray-300 rounded w-full"
          ></textarea>
        </div>

        <div className="mb-4">
          <label
            className="block text-sm font-medium text-gray-700"
            htmlFor="genre"
          >
            Genre
          </label>
          <input
            type="text"
            name="genre"
            id="genre"
            required
            className="mt-1 p-2 border border-gray-300 rounded w-full"
          />
        </div>

        <div className="mb-4">
          <label
            className="block text-sm font-medium text-gray-700"
            htmlFor="release_date"
          >
            Release Date
          </label>
          <input
            type="date"
            name="release_date"
            id="release_date"
            required
            className="mt-1 p-2 border border-gray-300 rounded w-full"
          />
        </div>

        <div className="mb-4">
          <label
            className="block text-sm font-medium text-gray-700"
            htmlFor="duration"
          >
            Duration (minutes)
          </label>
          <input
            type="number"
            name="duration"
            id="duration"
            required
            className="mt-1 p-2 border border-gray-300 rounded w-full"
          />
        </div>

        <div className="mb-4">
          <label
            className="block text-sm font-medium text-gray-700"
            htmlFor="now_showing"
          >
            Now Showing
          </label>
          <select
            name="now_showing"
            id="now_showing"
            required
            className="mt-1 p-2 border border-gray-300 rounded w-full"
          >
            <option value="true">Yes</option>
            <option value="false">No</option>
          </select>
        </div>

        <div className="mb-4">
          <label
            className="block text-sm font-medium text-gray-700"
            htmlFor="poster_url"
          >
            Poster URL
          </label>
          <input
            type="text"
            name="poster_url"
            id="poster_url"
            required
            className="mt-1 p-2 border border-gray-300 rounded w-full"
          />
        </div>

        <button
          type="submit"
          className="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
        >
          Add Movie
        </button>
      </form>
    </div>
  );
};

export default AddMovie;
