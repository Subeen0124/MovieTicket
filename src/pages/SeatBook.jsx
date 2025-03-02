import React, { useState } from "react";
import { Film, DollarSign, Info } from "lucide-react";

function SeatBook() {
  const [selectedSeats, setSelectedSeats] = useState([]);
  const rows = ["A", "B", "C", "D", "E", "F", "G"];
  const seatsPerRow = 8;
  const pricePerSeat = 350;

  // Generate seats data
  const generateSeats = () => {
    return rows.flatMap((row) =>
      Array.from({ length: seatsPerRow }, (_, i) => ({
        id: `${row}${i + 1}`,
        row,
        number: i + 1,
        isBooked: Math.random() < 0.3, // Randomly mark some seats as booked
      }))
    );
  };

  const [seats] = useState(generateSeats());

  const handleSeatClick = (seatId) => {
    const seat = seats.find((s) => s.id === seatId);
    if (seat?.isBooked) return;

    setSelectedSeats((prev) =>
      prev.includes(seatId)
        ? prev.filter((id) => id !== seatId)
        : [...prev, seatId]
    );
  };

  const totalPrice = selectedSeats.length * pricePerSeat;

  return (
    <div className="min-h-screen bg-gray-900 text-white">
      {/* Header */}
      <header className="bg-gray-800 p-4">
        <div className="container mx-auto flex items-center justify-between">
          <div className="flex items-center gap-2">
            <Film className="h-6 w-6" />
            <h1 className="text-xl font-bold">MovieMax</h1>
          </div>
          <div className="text-sm">Now showing: Inception</div>
        </div>
      </header>

      <main className="container mx-auto px-4 py-8">
        {/* Screen */}
        <div className="mb-12">
          <div className="h-2 w-full bg-gray-300 rounded-lg mb-4"></div>
          <p className="text-center text-gray-400 text-sm">SCREEN</p>
        </div>

        {/* Seats */}
        <div className="max-w-3xl mx-auto mb-8">
          {rows.map((row) => (
            <div key={row} className="flex justify-center gap-2 mb-2">
              <div className="w-8 text-center text-gray-400">{row}</div>
              {seats
                .filter((seat) => seat.row === row)
                .map((seat) => (
                  <button
                    key={seat.id}
                    onClick={() => handleSeatClick(seat.id)}
                    disabled={seat.isBooked}
                    className={`
                      w-8 h-8 rounded-t-lg
                      ${
                        seat.isBooked
                          ? "bg-gray-600 cursor-not-allowed"
                          : selectedSeats.includes(seat.id)
                          ? "bg-green-500 hover:bg-green-600"
                          : "bg-gray-400 hover:bg-gray-500"
                      }
                      transition-colors duration-200
                    `}
                  >
                    <span className="sr-only">
                      Seat {seat.row}
                      {seat.number}
                    </span>
                  </button>
                ))}
            </div>
          ))}
        </div>

        {/* Legend */}
        <div className="flex justify-center gap-8 mb-8">
          <div className="flex items-center gap-2">
            <div className="w-6 h-6 bg-gray-400 rounded"></div>
            <span className="text-sm">Available</span>
          </div>
          <div className="flex items-center gap-2">
            <div className="w-6 h-6 bg-green-500 rounded"></div>
            <span className="text-sm">Selected</span>
          </div>
          <div className="flex items-center gap-2">
            <div className="w-6 h-6 bg-gray-600 rounded"></div>
            <span className="text-sm">Booked</span>
          </div>
        </div>

        {/* Booking Summary */}
        <div className="max-w-md mx-auto bg-gray-800 rounded-lg p-6">
          <h2 className="text-xl font-bold mb-4">Booking Summary</h2>
          <div className="space-y-4">
            <div className="flex justify-between items-center">
              <div className="flex items-center gap-2">
                <DollarSign className="h-5 w-5 text-green-500" />
                <span>Price per seat</span>
              </div>
              <span>Rs. {pricePerSeat.toFixed(2)}</span>
            </div>
            <div className="flex justify-between items-center">
              <div className="flex items-center gap-2">
                <Info className="h-5 w-5 text-blue-500" />
                <span>Selected seats</span>
              </div>
              <span>{selectedSeats.length}</span>
            </div>
            <div className="border-t border-gray-700 pt-4">
              <div className="flex justify-between items-center font-bold">
                <span>Total</span>
                <span>Rs. {totalPrice.toFixed(2)}</span>
              </div>
            </div>
            <button
              disabled={selectedSeats.length === 0}
              onClick={() => alert("Booking confirmed!")}
              className={`
                w-full py-3 rounded-lg font-bold
                ${
                  selectedSeats.length === 0
                    ? "bg-gray-600 cursor-not-allowed"
                    : "bg-green-500 hover:bg-green-600"
                }
                transition-colors duration-200
              `}
            >
              Book Tickets
            </button>
          </div>
        </div>
      </main>
    </div>
  );
}

export default SeatBook;
