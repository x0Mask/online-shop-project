# Online Shop

This project is an online shop application built with Docker, PHP, MySQL, HTML, CSS, and JavaScript.

## Getting Started

### Requirements

- Docker
- Docker Compose

### Setup

1. **Clone the Repository**

   ```bash
   git clone https://github.com/x0Mask/online-shop-project.git
   cd online-shop-project
   ```

2. **Start the Application**

   ```bash
   docker-compose up --build
   ```

### Access

- **Shop Application**: [http://localhost:8082](http://localhost:8082)
- **phpMyAdmin**: [http://localhost:8083](http://localhost:8083)
  - **Username**: `sql_user`
  - **Password**: `sql_password`

### Project Structure

- `docker-compose.yml`: Manages Docker containers.
- `Dockerfile`: Sets up the PHP environment.
- `admin/`: Contains the PHP, HTML, CSS, and JS files for the admin.


### Usage

- **Homepage**: Displays products and shopping cart.
- **Admin Panel**: Manage products and users.
- **Product Pages**: View and edit products.
- **User Login/Register**: User authentication.

### Troubleshooting

- **Port Issues**: Modify ports in `docker-compose.yml` if needed.
- **Docker Problems**: Check Docker logs for errors.
