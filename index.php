<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <?php
        $loader = require 'vendor/autoload.php';
        $gitService = new GitService;
        $cacheService = new CacheService;

        if(array_key_exists('button_clear', $_POST)) { 
            $cacheService->clear();
            $organizations = array();
        }
        else if(array_key_exists('button_more', $_POST))
            $organizations = $gitService->GetMore();
        else
            $organizations = $gitService->GetOrganizations();
    ?>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Login</th>
            <th scope="col">Description</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($organizations as $organization):?>
        <tr>
            <td>
                <img style="-webkit-user-select: none;margin: auto;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;" src="<?php echo $organization->avatar_url; ?>">
            </td>
            <td>
                <?php echo $organization->login; ?>
            </td>
            <td>
                <?php echo $organization->description; ?>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
    </table>
    <form method="post">
        <input type="submit" name="button_clear" class="btn btn-danger m-3" value="Clear Cache" /> 
        <input type="submit" name="button_more" class="btn btn-primary m-3 float-right" value="I want more" /> 
    </form> 

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>