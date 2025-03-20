E-Commerce Website
This project is an interactive e-commerce website that allows users to manage their cart and wishlist seamlessly. It is built using PHP, MySQL, HTML, CSS, and JavaScript, with AJAX to handle instant updates without reloading the page.

Features
Add to Cart: Instantly add products to the cart without refreshing the page. The cart supports:
Adding products with or without specifying quantity.
Incrementing or decrementing product quantity in the cart.
Removing products from the cart.
Wishlist Management:
Save products to the wishlist for later.
Remove products from the wishlist instantly.
AJAX Integration: Provides a smooth user experience by dynamically updating content without requiring page reloads.
Responsive Design: The website is optimized for both desktop and mobile devices.
Setup Instructions
Clone the Repository
Open your terminal and navigate to the directory where you want to clone the project:
bash
Copy
Edit
cd /path/to/your/directory
Clone the repository:
bash
Copy
Edit
git clone https://github.com/your-username/your-repo-name.git
Navigate into the project folder:
bash
Copy
Edit
cd your-repo-name
Configure the Database
Open your database management tool (e.g., phpMyAdmin).
Create a new database for the project (e.g., ecommerce).
Import the database file:
Go to the Import tab in your database tool.
Select the project_database.sql file located in the /database folder.
Click Go to import the structure and data.
Set Up Database Connection
Open the connection.php file in the project directory.
Update the following variables with your database credentials:
php
Copy
Edit
$host = 'localhost';         // Host of your database server
$username = 'your_username'; // Your database username
$password = 'your_password'; // Your database password
$database = 'ecommerce';     // Name of your database
Run the Project
Place the project folder in your web server’s root directory (e.g., htdocs for XAMPP or www for WAMP).
Start your local server (XAMPP/WAMP).
Open your browser and go to:
arduino
Copy
Edit
http://localhost/your-project-folder
Usage
Browse products on the homepage.
Add products to your cart or wishlist.
Manage quantities directly in the cart.
Instantly remove items from the cart or wishlist without page reloads.
Technologies Used
Frontend: HTML, CSS, JavaScript, AJAX
Backend: PHP, MySQL
Database: MySQL (included in the /database folder)
Contributions
Contributions are welcome! Feel free to fork this repository, make improvements, and submit pull requests.

License
This project is open-source and available under the MIT License.

