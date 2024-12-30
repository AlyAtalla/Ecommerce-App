const express = require('express');
const cors = require('cors');
const app = express();

// Use the cors middleware
app.use(cors());

// Parse JSON bodies (as sent by API clients)
app.use(express.json());

// Define a simple POST endpoint
app.post('/your-endpoint', (req, res) => {
  // Your endpoint logic
  res.json({ message: 'Success', data: req.body });
});

// Start the server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});