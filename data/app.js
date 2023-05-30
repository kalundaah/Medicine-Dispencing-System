const mysql = require('mysql');
const fs = require('fs');

// MySQL database connection configuration
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'neville',
  password: '1234',
  database: 'mda',
});

// Connect to the MySQL database
connection.connect((error) => {
  if (error) {
    console.error('Error connecting to the database:', error);
    return;
  }
  console.log('Connected to the database');
  
  // Perform the database query
  const query = 'SELECT * FROM doctor';
  connection.query(query, (error, results) => {
    if (error) {
      console.error('Error executing the query:', error);
      return;
    }
    console.log('Retrieved data from the table');
    
    // Save the data to a JSON file
    const jsonData = JSON.stringify(results);
    fs.writeFile('data/json/doctor.json', jsonData, (error) => {
      if (error) {
        console.error('Error writing to JSON file:', error);
        return;
      }
      console.log('Data saved to doctor.json');
    });
    
    // Close the database connection
    connection.end((error) => {
      if (error) {
        console.error('Error closing the database connection:', error);
        return;
      }
      console.log('Disconnected from the database');
    });
  });
});
