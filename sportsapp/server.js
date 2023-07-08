const express = require('express');
const axios = require('axios');

const app = express();
const port = 3000;

// Define API endpoint for fetching sports data
app.get('/api/sports-data', async (req, res) => {
  try {
    const options = {
      method: 'GET',
      url: 'https://pinnacle-odds.p.rapidapi.com/kit/v1/betting-status',
      headers: {
        'X-RapidAPI-Key': '430bbd5628msh423c03d2058743cp1374d0jsn87393bc52466',
        'X-RapidAPI-Host': 'pinnacle-odds.p.rapidapi.com'
      }
    };
    
    // Make a request to the sports API endpoint
    const response = await axios.request(options);
    
    // Extract the relevant data from the API response
    const sportsData = response.data;
    
    // Process or transform the data as needed
    // ...
    
    // Return the processed data as a JSON response
    res.json(sportsData);
  } catch (error) {
    console.error('Error fetching sports data:', error);
    res.status(500).json({ error: 'Internal Server Error' });
  }
});

// Start the server
app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
