USE gc200197303;

CREATE TABLE tlmProjects (
project_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL,
description VARCHAR(2000) NOT NULL,
url VARCHAR(200) NOT NULL,
timeStart VARCHAR(7) NOT NULL, /* example: 3:56pm */
timeFinish VARCHAR(7) NOT NULL, /* example: 3:56pm */
totalMins INT NOT NULL
);

SELECT * FROM tlmProjects; 

ALTER TABLE tlmProjects ADD COLUMN dateStart VARCHAR(10) AFTER url;