const http = require('http');
const fs = require('fs');
const path = require('path');

const port = 1337;
const rootDir = __dirname;

const mimeTypes = {
    '.html': 'text/html',
    '.css': 'text/css',
    '.js': 'text/javascript',
    '.png': 'image/png',
    '.jpg': 'image/jpeg',
    '.jpeg': 'image/jpeg',
    '.webp': 'image/webp',
    '.xml': 'application/xml',

};

function serveStaticFile(res, filePath, contentType, responseCode = 200) {
    fs.readFile(filePath, (err, data) => {
        if (err) {
            if (err.code === 'ENOENT') {
                // File not found, serve 404 page
                serveStaticFile(res, path.join(rootDir, '404.html'), 'text/html', 404);
                return;
            }
            // Internal Server Error
            res.writeHead(500, { 'Content-Type': 'text/plain' });
            res.end('Internal Server Error');
            return;
        }
        res.writeHead(responseCode, { 'Content-Type': contentType });
        res.end(data);
    });
}

http.createServer((req, res) => {
    let urlPath = decodeURIComponent(req.url); // Decode URL to handle spaces and encoded characters
    if (urlPath === '/') {
        urlPath = '/home.html';
    }

    const filePath = path.join(rootDir, urlPath);
    const ext = path.extname(filePath).toLowerCase();
    const contentType = mimeTypes[ext] || 'application/octet-stream';

    serveStaticFile(res, filePath, contentType);
}).listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});
