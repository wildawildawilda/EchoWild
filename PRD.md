# Product Requirements Document (PRD)
**Project Name**: EchoWild
**Document Version**: 1.0
**Date**: July 2026

## 1. Product Vision & Objective
EchoWild is an aesthetic and highly private digital journaling web application. It aims to provide users with a beautifully designed, distraction-free environment to record their daily reflections, track their moods, and visualize their inner journey over time. The product prioritizes tranquility, ease of use, and visual appeal over complex feature sets.

## 2. Target Audience
- Individuals who maintain daily journals for self-reflection.
- Users seeking a private, secure, and visually pleasing alternative to physical notebooks.
- People who wish to track their mood patterns manually over time to better understand their mental well-being.

## 3. Core Features & Requirements

### 3.1. User Authentication & Security
- **Requirement**: Users must be able to securely register, log in, and manage their sessions.
- **Details**: 
  - Standard email and password authentication.
  - Password reset capabilities.
  - Complete isolation of user data (users can only access their own journals).

### 3.2. Dashboard & Analytics
- **Requirement**: A landing page post-login that gives users an overview of their journaling habit.
- **Details**:
  - Display the most recent journal entries (e.g., top 5).
  - Visual representation of mood patterns over recent entries (e.g., a simple chart or list).

### 3.3. Journal Management (CRUD)
- **Requirement**: Users must have full control over their journal entries.
- **Details**:
  - **Create**: Write a new journal with an optional title, mandatory content body, and a manual mood score (1 to 5, represented by emojis 😩 to 😁).
  - **Read**: View the full content of a past journal, including the date written and the selected mood.
  - **Update**: Edit the title, content, or mood score of an existing journal.
  - **Delete**: Permanently remove a journal entry (with a confirmation prompt).

### 3.4. UI/UX & Design Guidelines
- **Requirement**: The application must evoke a sense of calm, luxury, and modernity.
- **Details**:
  - **Theme**: "Glassmorphism" — utilizing semi-transparent, blurred backgrounds over vibrant abstract shapes.
  - **Color Palette**: Emerald, Sage Green, Teal, and neutral gray/white/dark tones.
  - **Typography**: The *Outfit* font family for a modern, rounded, and highly readable look.
  - **Responsiveness**: The UI must function flawlessly on desktop, tablet, and mobile browsers.

## 4. Technical Specifications

- **Backend Framework**: Laravel 11.x (PHP 8.x)
- **Frontend Technologies**: Laravel Blade, Tailwind CSS, Alpine.js
- **Database**: MySQL / SQLite
- **Authentication**: Laravel Breeze
- **Asset Compilation**: Vite

---
*End of Document*
