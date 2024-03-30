const express = require('express');
const app = express();
const path = require('path');

// Define the port number
const port = 1337;

// Set the path to the public directory
const publicDirectoryPath = __dirname; 

// Serve static files (CSS, JS, images) 
app.use(express.static(publicDirectoryPath));

// Serve each web page
app.get('/', (req, res) => res.sendFile(path.join(publicDirectoryPath, 'home.html')));
app.get('/about', (req, res) => res.sendFile(path.join(publicDirectoryPath, 'about.html')));
// 

// Wildcard route for 404 - 
app.get('*', (req, res) => res.sendFile(path.join(publicDirectoryPath, '404.html')));

// Start the server
app.listen(port, () => {
  console.log(`Server is running at http://localhost:${port}/`);
});
