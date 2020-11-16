<html>
    <head>
        <title><?php echo $title ?></title>
        <link rel="stylesheet" href="../public/css/item.css"/>
        <meta charset="utf-8"/>
        <style>
            table {
				width: 600px;
			}
			table, th, td {
	  			border: 1px solid black;
	  			border-collapse: collapse;
			}
			td {
	  			padding: 15px;
	  			text-align: left;
	  			vertical-align: top;
			}
			.a {
				width: 150px;
                        }
        </style>
    </head>
    <body>
        <h1>Products</h1>
        <form action="../products/viewsearch" method="post">
            <input type="text" value="Search..." onclick="this.value = ''" name="value"> <input type="submit" value="search">
        </form>
        <br/><br/>
