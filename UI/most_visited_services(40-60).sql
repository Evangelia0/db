SELECT COUNT(*), Service_ID
FROM Client
INNER JOIN service_charge ON Client.NFC_ID = service_charge.NFC_ID
WHERE Client.date_of_birth BETWEEN date_add(CURDATE(), INTERVAL -60 YEAR) AND date_add(CURDATE(), INTERVAL -40 YEAR) 
GROUP BY Service_ID
ORDER BY COUNT(*) DESC
;
