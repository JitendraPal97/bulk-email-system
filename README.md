# Bulk Email Management System

A scalable Bulk Email Management System built using Laravel that allows users to manage contacts, create email templates, build campaigns, and send bulk emails using SendGrid API with queue-based processing.

---

# Project Overview

This project is designed to send bulk emails efficiently using a queue system. It supports contact management via CSV upload, dynamic email templates, campaign creation, and email delivery tracking.

The system is built with scalability in mind and can handle 10,000+ emails using asynchronous processing.

---

# Features

## Contact Management
- Upload contacts using CSV file
- Download CSV format template
- Edit contacts
- Delete contacts
- Prevent duplicate entries
- View all contacts

## Email Templates
- Create email templates
- Edit templates
- Delete templates
- Dynamic placeholders support like {{name}}

## Campaign Management
- Create email campaigns
- Link campaigns with templates
- Send bulk emails to all contacts
- Schedule emails using queue delay

## Bulk Email Sending
- Integrated with SendGrid API
- Queue-based email processing
- Handles 10,000+ emails efficiently
- Retry mechanism for failed emails

## Logs & Tracking
- Email delivery logs (Sent / Failed)
- Campaign-wise tracking
- Basic reporting dashboard (sent vs failed count)

## UI/UX Features
- Bootstrap-based responsive UI
- Flash success/error messages
- Auto-hide alerts (3 seconds)
- Clean navigation system

---

# Tech Stack

- Laravel Framework (PHP)
- MySQL Database
- Laravel Queue System
- SendGrid API (Email Service)
- Bootstrap (Frontend UI)
- JavaScript (UX improvements)

---

# System Workflow

```text
User Upload CSV → Contacts Stored → Create Template → Create Campaign → 
Queue Jobs Triggered → SendGrid API Sends Email → Logs Stored in DB