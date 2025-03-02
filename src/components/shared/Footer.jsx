import React from 'react';
import { Facebook, Twitter, Instagram, Linkedin, Mail, Film } from 'lucide-react';

export default function Footer() {
  return (
    <footer className="bg-gray-800 py-12">
        <div className="container mx-auto px-4">
          <div className="flex items-center justify-center mb-8">
            <Film className="w-8 h-8 text-red-500" />
            <span className="text-2xl text-white font-bold ml-2">CineBook</span>
          </div>
          <div className="text-center text-gray-400">
            <p>&copy; 2024 CineBook. All rights reserved.</p>
          </div>
        </div>
      </footer>
  );
}