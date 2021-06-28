CREATE INDEX IX_Visited_areas
ON Visits(Start_time,End_time,ID_area);

CREATE INDEX IX_firstname
ON Client(first_name)

CREATE INDEX IX_lastname
ON Client(last_name)

CREATE INDEX IX_age  
ON Client(date_of_birth)

CREATE INDEX IX_money
ON service_charge(amount,NFC_ID)

CREATE INDEX IX_per_access
ON has_access(area,ID_area)