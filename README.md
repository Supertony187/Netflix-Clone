# Netflix-Clone
This PHP script powers a movie streaming website, allowing registered users to access premium content. 

Description:

This PHP script is responsible for displaying detailed information about a specific movie on a streaming website. Here's a breakdown of its functionality:

Session Management:
» The script starts a session to manage user login status.
» It checks if the user is logged in. If yes, it retrieves the username; otherwise, it sets the username to "Gast" (guest).

Movie Information Retrieval:
» The script checks if a movie ID (film_id) is provided via the URL parameters.
» If a movie ID is provided, it connects to a MySQL database to fetch detailed information about the movie, including its title, image, description, and directors.
» If no movie ID is provided, the script redirects the user to the homepage or performs error handling.

Header Section:
» Displays the website's logo and navigation buttons.
» If the user is logged in, it shows links to the user's profile and a logout button. If not logged in, it shows links to login and registration pages.
» Additionally, it provides a dropdown menu with links to the homepage, user profile, and a placeholder link for logout functionality.

Main Content:
» Displays the movie details including its banner image, title, and description.
» If available, it lists the directors of the movie along with their images.


CSS and External Resources:
» The script includes CSS stylesheets for visual presentation.
» It utilizes Google Fonts for typography enhancement.

Note:
» The script relies on a MySQL database for storing movie information, including titles, descriptions, images, and director details.
» Users are differentiated by their login status, and their username is displayed accordingly.
» JavaScript is used for toggling the dropdown menu's visibility, though the logout functionality is not implemented.
» Proper error handling for database connection issues and missing movie IDs is commented out but can be implemented as needed.
» This script provides a dynamic way to display detailed movie information based on the provided movie ID, enriching the user experience of the streaming website.
