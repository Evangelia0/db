SELECT COUNT(*), ID_AREA
FROM Client
INNER JOIN Visits ON Client.NFC_ID = Visits.NFC_ID
WHERE Client.date_of_birth BETWEEN date_add(CURDATE(), INTERVAL -60 YEAR) AND date_add(CURDATE(), INTERVAL -40 YEAR) 
AND Visits.Visit_date > date_add(CURDATE(), INTERVAL -1 YEAR)
GROUP BY ID_AREA
ORDER BY COUNT(*) DESC
;