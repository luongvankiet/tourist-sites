-- DROP DATABASE IF EXISTS toursites;

-- Since DROP DATABASE, by default, has been disabled by phpMyAdmin,
-- one has to remove a database manually via the "Databases" tab there.
--
-- Or modify (with caution) phpMyAdmin\libraries\config.default.php by
-- replacing $cfg['AllowUserDropDatabase'] = false; with
-- $cfg['AllowUserDropDatabase'] = true;


-- you may have to replace "toursites" below by "db_zhuhan"
-- if this database is to be placed on the School's database server,
-- where "zhuhan" should be replaced by your own username on the server
CREATE DATABASE toursites;
USE toursites;

-- DROP TABLE Booking;
-- DROP TABLE Visitor;
-- DROP TABLE Site;

CREATE TABLE Site 
(
   -- this is the format for MySQL
   siteID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   
   -- this is the format for MS SQL SERVER
   -- start from 1 with increment 1 every time
   -- siteID INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
   
   siteName VARCHAR(100) NOT NULL,
   location VARCHAR(512),
   feature VARCHAR(512),
   contact VARCHAR(512) NOT NULL,
   priceFrom NUMERIC(6,2) DEFAULT 0
);

CREATE TABLE Visitor
(
   -- this is the format for MySQL
   visitorID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   
   -- this is the format for MS SQL SERVER
   -- start from 1 with increment  every time
   -- visitorID INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
   
   visitorName VARCHAR(100) NOT NULL,
   visitorContact VARCHAR(200) NOT NULL
);

CREATE TABLE Booking
(
   -- this is the format for MySQL
   ticketID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   
   -- this is the format for MS SQL SERVER
   -- start from 1 with increment  every time
   -- bookingID INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
   
   -- time set to 0:0:0 if irrelevant
   entryDateTime DATETIME,
   
   siteID INT NOT NULL,
   visitorID INT NOT NULL,
   FOREIGN KEY(siteID) REFERENCES Site(siteID),
   FOREIGN KEY(visitorID) REFERENCES Visitor(visitorID)
);


INSERT INTO Site(siteName,location,feature,contact,priceFrom) VALUES
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
  40.36)
;

INSERT INTO Visitor(visitorName,visitorContact) VALUES
('David Smith', 
 'Mobile: 0412345678, email:d.smith@gmail.com'),
('Rose Dowson',
 'Email: r.dowson@gmail.com')
;
 
INSERT INTO Booking(entryDateTime,siteID,visitorID) VALUES
('2022-10-1 10:0:0', 3, 1),  -- entry time: 10am
('2022-11-20',1, 2 ),        -- entry time doesn't apply
('2022-11-20',1, 1)          -- entry time doesn't apply
;

  
