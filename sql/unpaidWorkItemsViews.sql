DROP VIEW IF EXISTS v_unpaid_work_items;
CREATE VIEW v_unpaid_work_items AS
SELECT c.name                           as companyName,
       t.name                           as tariffName,
       sum(w.work_duration)             as workDurationTotal,
       t.price                          as pricePerUnit,
       (sum(w.work_duration) * t.price) as totalPrice
FROM work_inventory as w
         INNER JOIN tariff t on t.id = w.tariff_id
         left join company c on w.company_id = c.id
WHERE w.invoice_id is null
GROUP BY w.company_id, w.tariff_id;