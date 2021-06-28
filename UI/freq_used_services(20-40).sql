select count(*), dist_combs.Service_ID
FROM 
(SELECT distinct service_charge.NFC_ID, service_charge.Service_ID
from service_charge
INNER JOIN Client on Client.NFC_ID = service_charge.NFC_ID
WHERE Client.date_of_birth BETWEEN date_add(CURDATE(), INTERVAL -40 YEAR) AND date_add(CURDATE(), INTERVAL -20 YEAR) 
) as dist_combs
group by dist_combs.Service_ID
order by count(*) desc
 ;