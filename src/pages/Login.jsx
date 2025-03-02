import React from "react";
import { AuthLayout } from "../components/auth/AuthLayout";
import { LoginForm } from "../components/auth/LoginForm";

export function Login() {
  return (
    <AuthLayout
      title="Welcome back"
      subtitle={
        <>
          Don't have an account?{" "}
          <a
            href="/signup"
            className="font-medium text-red-600 hover:text-red-500"
          >
            Sign up
          </a>
        </>
      }
    >
      <LoginForm />
    </AuthLayout>
  );
}
