# CivicFix

## Smart Complaint Reporting System

CivicFix is a web-based complaint reporting platform built using Laravel that helps citizens report public issues such as garbage problems, water leakage, damaged roads, broken street lights, and other civic complaints.

The system allows users to submit complaints with images, track complaint status, and receive updates, while administrators can manage, review, and resolve complaints efficiently.

---

# Problem Statement

In many cities and local areas, people face difficulties reporting public infrastructure and civic issues. Traditional complaint systems are often:

* Slow
* Difficult to track
* Non-transparent
* Offline/manual
* Hard to access

Citizens usually do not know:

* Where to report problems
* Whether their complaint is being processed
* Who is responsible for resolving the issue

This creates communication gaps between citizens and authorities.

---

# Solution

CivicFix provides a centralized digital platform where users can:

* Report civic issues online
* Upload proof images
* Track complaint progress
* Receive complaint status updates

Administrators can:

* View all complaints
* Update complaint status
* Manage users
* Resolve issues efficiently

The system improves transparency, accessibility, and complaint management.

---

# Tech Stack

## Backend

* Laravel 
* PHP 

## Frontend

* Blade Template Engine
* Bootstrap 5
* HTML5
* CSS3
* JavaScript

## Database

* MySQL

## Authentication

* Laravel Breeze

## Tools

* Composer
* Git & GitHub
* Laragon/XAMPP
* VS Code

---

# Features

## User Features

* User Registration & Login
* Secure Authentication
* Create Complaint
* Upload Complaint Images
* View Personal Complaints
* Edit/Delete Complaints
* Track Complaint Status
* Search & Filter Complaints
* Profile Management

## Admin Features

* Admin Dashboard
* View All Complaints
* Update Complaint Status
* Manage Users
* Delete Spam Complaints
* Complaint Analytics

---

# Complaint Status Flow

Pending
↓
In Review
↓
Resolved

---

# Project Workflow

## Step 1 — User Registration/Login

Users create an account and log in securely.

## Step 2 — Submit Complaint

Users submit complaints by:

* Adding title
* Adding description
* Selecting complaint category
* Uploading images

## Step 3 — Complaint Stored

Laravel validates the data and stores it in the MySQL database.

## Step 4 — Admin Review

Admin views submitted complaints in dashboard.

## Step 5 — Status Update

Admin updates complaint status:

* Pending
* In Review
* Resolved

## Step 6 — User Tracking

Users can track complaint progress from their dashboard.

---

# Future Enhancements

* Email Notifications
* Real-Time Complaint Updates
* Google Maps Integration
* Mobile App API
* Complaint Voting System
* Nearby Complaint Search

---

# Project Goal

The goal of CivicFix is to create a transparent and efficient complaint reporting system that improves communication between citizens and local authorities.

---


