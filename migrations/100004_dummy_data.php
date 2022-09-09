<?php

use App\Core\Application;

class DummyData
{
    public function up()
    {
        $db = Application::$app->db;

        $insertSiteSql = "INSERT INTO sites(site_name,location,feature,contact,price_from) VALUES
        ('Skyfeast at Sydney Tower',
         'Westfield Sydney, Level 5/108 Market St, Sydney NSW 2000',
         'Great overview of Sydney, and fantastic food',
         'priceguarantee@viator.com',
          90.00),
        ('Bondi Beach',
         'Bondi Beach, Queen Elizabeth Dr, Sydney NSW 2026',
         'Most beautiful beach in Sydney, with many shops, restaurants and bars',
         'https://hellobondi.com.au/',
          0.00),
        ('Sydney Opera House',
         'Bennelong Point, Sydney NSW 2000',
         'Iconic symbol of Australian architecture, a must-visit',
         'Phone: (02) 9250 7111; Site: https://www.sydneyoperahouse.com/visit-us/tours-and-experiences.html',
          40.36);";

        $password = '$2y$10$AHopA..7NApfBfNHyUfCXeLeQDGTTA5Eh83zjUx3yUqDIEV3BKjLm';

        $insertUserSql = "INSERT INTO users(first_name,last_name,email,phone,password) VALUES
        ('David', 'Smith', 'd.smith@gmail.com', '0412345678', '$password'),
        ('Rose', 'Dowson', 'r.dowson@gmail.com', '0412345678', '$password')";

        $insertBookingSql = "INSERT INTO bookings(entry_date_time,site_id,user_id) VALUES
        ('2022-10-1 10:0:0', 3, 1),  -- entry time: 10am
        ('2022-11-20',1, 2 ),        -- entry time doesn't apply
        ('2022-11-20',1, 1)          -- entry time doesn't apply
        ;";

        $db->pdo->exec($insertSiteSql);
        $db->pdo->exec($insertUserSql);
        $db->pdo->exec($insertBookingSql);
    }

    public function down()
    {
        //
    }
}
