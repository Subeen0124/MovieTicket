import { Button } from "./ui/Button";
import { Calendar } from "lucide-react";

export const MovieCard = ({ title, image, rating }) => {
  return (
    <div className="movie-card">
      <img src={image} alt={title} className="h-[400px]" />
      <div className="movie-card-overlay">
        <h3 className="text-lg font-bold mb-2">{title}</h3>
        <div className="flex items-center justify-between">
          <span className="text-primary">{rating}</span>
          <Button size="sm" className="gap-2">
            <Calendar className="h-4 w-4" />
            Book Now
          </Button>
        </div>
      </div>
    </div>
  );
};