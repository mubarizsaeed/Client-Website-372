const express = require('express');
const path = require('path');
const { engine } = require('express-handlebars');
const app = express();
const port = 1337;

// Set up Handlebars view engine
app.engine('handlebars', engine({
  defaultLayout: 'main',
  extname: 'handlebars',
  layoutsDir: path.join(__dirname, 'views/layouts')
}));
app.set('view engine', 'handlebars');
app.set('views', path.join(__dirname, 'views'));

// Serve static files from the root directory
app.use(express.static(path.join(__dirname)));

// Serve home.handlebars using Handlebars on the home route
app.get('/', (req, res) => {
  res.render('home');
});

app.get('/about', (req, res) => {
    res.render('about');
  });
  
app.get('/virtual-gallery', (req, res) => {
res.render('virtual-gallery');
});

app.get('/login', (req, res) => {
res.render('login');
});   
// Start the server
app.listen(port, () => {
  console.log(`Server is running at http://localhost:${port}/`);
});