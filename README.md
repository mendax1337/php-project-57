### Hexlet tests and linter status:
[![Actions Status](https://github.com/mendax1337/php-project-57/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/mendax1337/php-project-57/actions)
[![CI](https://github.com/mendax1337/php-project-57/actions/workflows/ci.yml/badge.svg)](https://github.com/mendax1337/php-project-57/actions/workflows/ci.yml)

# Task Manager

## About the project

A simple task manager inspired by [Redmine](https://www.redmine.org/).  
It allows you to create tasks, assign performers, change statuses, and add labels to tasks.  
Registration and authentication are required to use the system.

### Features
- Task statuses (pre-seeded in the database)
- Tasks with fields: name, description, status, author, assignee
- Labels (many-to-many relation with tasks)
- Task filtering (by status, creator, assignee, labels) with pagination
- Authentication & registration (Laravel Breeze)
- Deletion protection:
    - Statuses cannot be deleted if they are used in tasks
    - Labels cannot be deleted if they are attached to tasks

## Requirements

- PHP **8.3**
- Composer **2.x**
- Node.js **18+** and npm **9+** (for frontend build)
- Laravel **11.x**
- Database: **SQLite** by default (PostgreSQL/MySQL supported via `.env`)

## Installation

> The project contains a `Makefile`. The commands below use `make`.  
> If you don’t have `make` installed, run the alternative commands shown in comments.

1. Clone the repository:

```bash
git clone git@github.com:mendax1337/php-project-57.git task-manager
cd task-manager```

2. 

#### Result [Ссылка на проект](https://task-manager-kpx5.onrender.com)
