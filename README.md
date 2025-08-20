### Hexlet tests and linter status:
[![Actions Status](https://github.com/mendax1337/php-project-57/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/mendax1337/php-project-57/actions)
[![CI](https://github.com/mendax1337/php-project-57/actions/workflows/ci.yml/badge.svg)](https://github.com/mendax1337/php-project-57/actions/workflows/ci.yml)

 Task Manager

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
- Composer **2.6.6**
- Laravel **10.10**
- PostgreSQL **16**

## Installation

> The project contains a `Makefile`. The commands below use `make`.  

1. Clone the repository:

```bash
git clone git@github.com:mendax1337/php-project-57.git task-manager
cd task-manager
```

Prepare the .env file:

```bash
make env
```

Install PHP dependencies:

```bash
make install
```

Generate the application key:

```bash
make key
```

Prepare the database::

```bash
make db
```

Make frontend::
```bash
make frontend
```

Start the development server:

```bash
make start
```

Open in browser:

http://localhost:8000

Run tests:
```bash
make test
```

The project is deployed on Render:

#### Result [Link on project](https://task-manager-kpx5.onrender.com)
