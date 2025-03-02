import React, { useState } from "react";
import { FormInput } from "./FormInput";
import { Button } from "../Button";

export function LoginForm() {
  const [formData, setFormData] = useState({
    email: "",
    password: "",
  });
  const [errors, setErrors] = useState({});
  const [loading, setLoading] = useState(false);

  // Handle form field changes
  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prev) => ({
      ...prev,
      [name]: value,
    }));

    // Clear the error for the specific field
    if (errors[name]) {
      setErrors((prev) => ({
        ...prev,
        [name]: "",
      }));
    }
  };

  // Validate form inputs
  const validateForm = () => {
    const newErrors = {};
    if (!formData.email) {
      newErrors.email = "Email is required";
    } else if (!/\S+@\S+\.\S+/.test(formData.email)) {
      newErrors.email = "Invalid email address";
    }
    if (!formData.password) {
      newErrors.password = "Password is required";
    }
    return newErrors;
  };

  // Handle form submission
  const handleSubmit = async (e) => {
    e.preventDefault();
    const newErrors = validateForm();
    console.log(formData.email, formData.password);


    if (Object.keys(newErrors).length === 0) {
      try {
        setLoading(true); // Show loading state during submission

        const response = await fetch("http://localhost/MovieTicket/login.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            logEmail: formData.email,
            logPassword: formData.password,
          }),
        });

        // Check if the response is ok (200)
        if (response.ok) {
          const data = await response.json();

          if (data.data) {
            // Store user data in localStorage
            localStorage.setItem("userId", JSON.stringify(data.data.user.id));
            localStorage.setItem(
              "userName",
              JSON.stringify(data.data.user.name)
            );
            window.location.href = "/dashboard"; // Redirect on success
          } else {
            setErrors({ form: "Login failed: Missing data" });
          }
        } else {
          const errorData = await response.json();
          setErrors({
            form: errorData.error || "Login failed. Please try again.",
          });
        }
      } catch (err) {
        console.error("Error during login:", err);
        setErrors({ form: "An unexpected error occurred. Please try again." });
      } finally {
        setLoading(false); // Reset loading state
      }
    } else {
      setErrors(newErrors);
    }
  };

  return (
    <form onSubmit={handleSubmit} className="space-y-6">
      {errors.form && (
        <div className="text-red-600 text-sm mb-4">{errors.form}</div>
      )}

      <FormInput
        id="email"
        name="email"
        type="email"
        label="Email address"
        autoComplete="email"
        value={formData.email}
        onChange={handleChange}
        error={errors.email}
      />

      <FormInput
        id="password"
        name="password"
        type="password"
        label="Password"
        autoComplete="current-password"
        value={formData.password}
        onChange={handleChange}
        error={errors.password}
      />

      <Button type="submit" className="w-full" disabled={loading}>
        {loading ? "Signing in..." : "Sign in"}
      </Button>
    </form>
  );
}
