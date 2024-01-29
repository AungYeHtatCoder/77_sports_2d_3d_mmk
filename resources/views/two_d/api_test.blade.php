<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
 <h1>hello world</h1>
 {{-- <div id="jsonDataDisplay"></div> --}}
 <div id="jsonDataDisplay" class="table-responsive"></div>

 
<script>
  // async function fetchData() {
  //   const url = 'https://shwe-2d-live-api.p.rapidapi.com/live';
  //   const options = {
  //     method: 'GET',
  //     headers: {
  //       'X-RapidAPI-Key': '4c6bcd02e8msh0665010fc0fab0fp1a2d33jsn173e389166b3',
  //       'X-RapidAPI-Host': 'shwe-2d-live-api.p.rapidapi.com'
  //     }
  //   };

  //   try {
  //     const response = await fetch(url, options);
  //     const result = await response.json(); // Parse the response as JSON
  //     displayData(result);
  //   } catch (error) {
  //     console.error(error);
  //   }
  // }

  // function displayData(data) {
  //   // Select the placeholder element
  //   const displayElement = document.getElementById('jsonDataDisplay');

  //   // Create a string to hold your HTML content
  //   let htmlContent = '';

  //   // Loop through the object properties and build the HTML content
  //   for (const key in data) {
  //     htmlContent += `<p><strong>${key}</strong>: ${data[key]}</p>`;
  //   }

  //   // Update the placeholder with the HTML content
  //   displayElement.innerHTML = htmlContent;
  // }

  // fetchData();
</script>

<script>
  async function fetchData() {
    const url = 'https://shwe-2d-live-api.p.rapidapi.com/holiday';
    const options = {
      method: 'GET',
      headers: {
        'X-RapidAPI-Key': '4c6bcd02e8msh0665010fc0fab0fp1a2d33jsn173e389166b3',
        'X-RapidAPI-Host': 'shwe-2d-live-api.p.rapidapi.com'
      }
    };

    try {
      const response = await fetch(url, options);
      const result = await response.json(); // Parse the response as JSON
      displayData(result);
      console.log(result);
    } catch (error) {
      console.error(error);
    }
  }

  function displayData(data) {
    // Select the placeholder element
    const displayElement = document.getElementById('jsonDataDisplay');

    // Start building the table
    let htmlContent = '<table class="table table-bordered">';
    htmlContent += '<thead><tr>';

    // Add table headers
    for (const key in data) {
      htmlContent += `<th>${key}</th>`;
    }
    htmlContent += '</tr></thead><tbody><tr>';

    // Add table data
    for (const key in data) {
      htmlContent += `<td>${data[key]}</td>`;
    }
    htmlContent += '</tr></tbody></table>';

    // Update the placeholder with the table
    displayElement.innerHTML = htmlContent;
  }
  fetchData();
</script>
</body>
</html>
