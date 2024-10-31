<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Bar</title>
  <style>
    .search {
      padding-left: 2px;
      background: #E8EBF3;
      font-family: 'Varela Round', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;

      background: #ffffff;
      border-radius: 15px;
      display: flex;
      align-items: center;
      box-shadow: 0 10px 30px rgba(65, 72, 86, .05);
    }

    .search input[type="text"] {
      font: 400 16px 'Varela Round', sans-serif;
      color: #414856;
      border: none;
      outline: none;
      padding: 10px 20px 10px 10px ;
      border-radius: 15px 0 0 15px;
      width: 230px;
      /* border: 1px solid red; */
    }

    .search button {
      background: #EC7224;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 0 15px 15px 0;
      cursor: pointer;
      font: 400 16px 'Varela Round', sans-serif;
      transition: background 0.3s ease;
    }

    .search button:hover {
      background: #ca6118;
    }

    #searchInput:-webkit-autofill,
    #searchInput:-webkit-autofill:hover,
    #searchInput:-webkit-autofill:focus,
    #searchInput:-webkit-autofill:active {
      -webkit-box-shadow: 0 0 0 30px white inset !important;
      -webkit-text-fill-color: #000 !important;
    }
  </style>
</head>

<body>
  <div class="search">
    <form id="searchForm" action="searchProduct.php" method="GET">
      <input type="text" id="searchInput" name="search" placeholder="press Enter to view all products" />
      <button type="submit" id="searchButton">Search</button>
    </form>
  </div>
</body>

</html>