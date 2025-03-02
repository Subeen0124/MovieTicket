import { Button } from "./ui/Button";
import { Input } from "./ui/Input";
import { useState } from "react";
import toast from "react-hot-toast";

export const Newsletter = () => {
  const [email, setEmail] = useState("");

  const handleSubmit = (e) => {
    e.preventDefault();
    toast.success("Thanks for subscribing!");
    setEmail("");
  };

  return (
    <div className="py-16 px-4">
      <div className="max-w-md mx-auto text-center">
        <h2 className="text-2xl font-bold mb-4">Never Miss a Show</h2>
        <p className="text-muted-foreground mb-6">
          Subscribe to our newsletter for exclusive movie updates and special offers.
        </p>
        <form onSubmit={handleSubmit} className="flex gap-2">
          <Input
            type="email"
            placeholder="Enter your email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
            className="flex-1"
          />
          <Button type="submit">Subscribe</Button>
        </form>
      </div>
    </div>
  );
};