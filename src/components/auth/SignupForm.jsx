import React, { useState } from "react";
import { FormInput } from "./FormInput";
import { Button } from "../Button";

export function SignupForm() {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    password: "",
    confirmPassword: "",
  });
  const [errors, setErrors] = useState({});
  const [loading, setLoading] = useState(false); // Handle loading state

  // Handle form field changes
  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prev) => ({
      ...prev,
      [name]: value,
    }));

    // Clear error when user starts typing
    if (errors[name]) {
      setErrors((prev) => ({
        ...prev,
        [name]: "",
      }));
    }
  };

  // Validate form inputs
  const validateForm = (formData) => {
    const newErrors = {};

    // Name Validation
    if (!formData.name) {
      newErrors.name = "Name is required";
    } else if (!/^[a-zA-Z]+[a-zA-Z\s]*?[^0-9]$/.test(formData.name)) {
      newErrors.name = "Enter a valid name";
    }

    // Email Validation
    if (!formData.email) {
      newErrors.email = "Email is required";
    } else if (
      !/^[a-zA-Z0-9._%+-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$/.test(formData.email)
    ) {
      newErrors.email = "Invalid email address";
    }

    // Password Validation
    if (!formData.password) {
      newErrors.password = "Password is required";
    } else if (formData.password.length < 8) {
      newErrors.password = "Password must be at least 8 characters";
    } else if (
      !/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(
        formData.password
      )
    ) {
      newErrors.password =
        "Password must include at least one uppercase letter, one lowercase letter, one digit, and one special character.";
    }

    // Confirm Password Validation
    if (!formData.confirmPassword) {
      newErrors.confirmPassword = "Please confirm the password";
    } else if (formData.password !== formData.confirmPassword) {
      newErrors.confirmPassword = "Passwords do not match";
    }

    return newErrors;
  };

  // Handle form submission
  const handleSubmit = async (e) => {
    e.preventDefault();
    const newErrors = validateForm(formData);

    if (Object.keys(newErrors).length === 0) {
      try {
        setLoading(true); // Show loading state during form submission

        const response = await fetch(
          "http://localhost/MovieTicket/register.php",
          {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
              regName: formData.name,
              regEmail: formData.email,
              regPassword: formData.password,
            }),
          }
        );

        if (response.ok) {
          const data = await response.json();
          window.location.href = "/login"; // Redirect to login page
        } else {
          const errorData = await response.json();
          setErrors({ form: errorData.error || "Registration failed" });
        }
      } catch (err) {
        console.error("Error during registration:", err);
        setErrors({ form: "An unexpected error occurred" });
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
        id="name"
        name="name"
        type="text"
        label="Full Name"
        autoComplete="name"
        value={formData.name}
        onChange={handleChange}
        error={errors.name}
      />

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
        autoComplete="new-password"
        value={formData.password}
        onChange={handleChange}
        error={errors.password}
      />

      <FormInput
        id="confirmPassword"
        name="confirmPassword"
        type="password"
        label="Confirm password"
        autoComplete="new-password"
        value={formData.confirmPassword}
        onChange={handleChange}
        error={errors.confirmPassword}
      />

      <Button type="submit" className="w-full" disabled={loading}>
        {loading ? "Creating account..." : "Create account"}
      </Button>
    </form>
  );
}
