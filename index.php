<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Generate Restaurant Chain</title>
</head>
<body>
    <div class="d-flex justify-content-center bg-dark vh-100 text-white p-5">
        
        <form action="download.php" method="post">
            <h1 class="mb-3">Input form</h1>

            <!-- 従業員の人数を選択 -->
            <div class="row mb-3">
                <label for="numberEmployees">Number of employees: </label>
                <div class="col-sm-6">
                    <input type="number" id="numberEmployees" name="numberEmployees" min="1" max="5" value="1">
                </div>
            </div>

            <!-- 従業員の給料 -->
            <div class="row mb-3">
                <label for="salaryEmployees">Salary of employees: </label>
                <div class="col">
                    <input type="number" id="minSalary" name="minSalary" min="1" max="100" value="10">
                </div>
                <div> ~ </div>
                <div class="col">
                    <input type="number" id="maxSalary" name="maxSalary" min="1" max="100" value="100">
                </div>
            </div>

            <!-- 場所の数を選択 -->
            <div class="row mb-3">
                <label for="numberLocations">Number of locations: </label>
                <div class="col-sm-6">
                    <input type="number" id="numberLocations" name="numberLocations" min="1" max="5" value="1">
                </div>
            </div>

            <!-- 郵便番号 -->
            <div class="row mb-3">
                <label for="zipcode">Zipcode: </label>
                <div class="col">
                    <input type="number" id="minZipcode" name="minZipcode" min="1" max="20" value="1">
                </div>
                <div> ~ </div>
                <div class="col">
                    <input type="number" id="maxZipcode" name="maxZipcode" min="1" max="20" value="10">
                </div>
            </div>

            <!-- 出力形式の選択 -->
            <div class="row mb-3">
                <label for="format">Download Format: </label>
                <div class="col-sm-6">
                    <select id="format" name="format">
                        <option value="html">HTML</option>
                        <option value="markdown">Markdown ~coming soon~</option>
                        <option value="json">JSON ~coming soon~</option>
                        <option value="txt">Text ~coming soon~</option>
                    </select>
                </div>
            </div>
            
            <div class="row mb-3 text-center">
                <button type="submit" class="btn btn-warning text-white m-2 btn-lg d-grid gap-s col-6 mx-auto" >Generate</button>
            </div>
        </form>
    </div>
    
</body>
</html>